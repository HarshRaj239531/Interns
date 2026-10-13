<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Inquiry;
use App\Models\InternshipStream;
use App\Models\School;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminPortalController extends Controller
{
    /**
     * Admin Command Center & Applications Management Dashboard
     */
    public function dashboard(Request $request)
    {
        $query = StudentProfile::with('user');

        // Tab selection filters
        $tab = $request->input('tab', 'overview');
        if ($tab === 'enrolled') {
            $query->whereIn('status', ['APPROVED', 'ACTIVE', 'COMPLETED']);
        } elseif ($tab === 'pending_cert') {
            $query->whereIn('status', ['APPROVED', 'ACTIVE', 'COMPLETED'])
                ->where('certificate_issued', false);
        } elseif ($tab === 'issued_cert') {
            $query->where('certificate_issued', true);
        }

        // Status filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Degree filter
        if ($request->filled('degree') && $request->degree !== 'all') {
            $query->where('degree', $request->degree);
        }

        // Stream / Domain filter
        if ($request->filled('domain') && $request->domain !== 'all') {
            $query->where('program_domain', $request->domain);
        }

        // Global search
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('application_number', 'like', "%{$search}%")
                    ->orWhere('college', 'like', "%{$search}%")
                    ->orWhere('program_domain', 'like', "%{$search}%")
                    ->orWhere('certificate_number', 'like', "%{$search}%")
                    ->orWhere('lor_number', 'like', "%{$search}%")
                    ->orWhere('mentor_name', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    });
            });
        }

        if ($tab === 'all') {
            $query->orderByRaw("CASE WHEN status = 'PENDING' THEN 0 ELSE 1 END")->latest();
        } else {
            $query->latest();
        }

        $applications = $query->paginate(15)->withQueryString();

        $stats = [
            'total' => StudentProfile::count(),
            'enrolled' => StudentProfile::whereIn('status', ['APPROVED', 'ACTIVE', 'COMPLETED'])->count(),
            'pending' => StudentProfile::where('status', 'PENDING')->count(),
            'pending_cert' => StudentProfile::whereIn('status', ['APPROVED', 'ACTIVE', 'COMPLETED'])->where('certificate_issued', false)->count(),
            'approved' => StudentProfile::where('status', 'APPROVED')->count(),
            'active' => StudentProfile::where('status', 'ACTIVE')->count(),
            'completed' => StudentProfile::where('status', 'COMPLETED')->count(),
            'certificates_issued' => StudentProfile::where('certificate_issued', true)->count(),
            'lor_issued' => StudentProfile::where('lor_issued', true)->count(),
            'total_inquiries' => Inquiry::count(),
            'new_inquiries' => Inquiry::where('status', 'NEW')->count(),
            'total_streams' => InternshipStream::count(),
            'total_degrees' => Degree::count(),
            'total_schools' => School::count(),
        ];

        $streams = InternshipStream::orderBy('title')->get();
        $degrees = Degree::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get();
        $schools = School::where('is_active', true)->orderBy('name')->get();
        $streamDistribution = InternshipStream::withCount('studentProfiles')->orderBy('title')->get();
        $recentApplications = StudentProfile::with('user')->latest()->take(6)->get();
        $recentCertificates = StudentProfile::with('user')->where('certificate_issued', true)->latest('certificate_date')->take(6)->get();

        return view('admin.dashboard', compact(
            'applications',
            'stats',
            'streams',
            'degrees',
            'schools',
            'tab',
            'streamDistribution',
            'recentApplications',
            'recentCertificates'
        ));
    }

    /**
     * Update Application Status
     */
    public function updateStatus($id, Request $request)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:PENDING,APPROVED,ACTIVE,COMPLETED,REJECTED'],
        ]);

        $profile = StudentProfile::findOrFail($id);
        $updateData = ['status' => $validated['status']];

        if ($validated['status'] === 'APPROVED') {
            if (! $profile->offer_letter_issued) {
                $updateData['offer_letter_issued'] = true;
                $updateData['offer_letter_date'] = now();
            }
            if (! $profile->consent_letter_issued) {
                $updateData['consent_letter_issued'] = true;
                $updateData['consent_letter_date'] = now();
            }
            if ($profile->attendance_rate == 0) {
                $updateData['attendance_rate'] = 90;
            }
            if ($profile->mentor_name === 'Pending Assignment' || empty($profile->mentor_name)) {
                $updateData['mentor_name'] = 'Faculty Advisory Board';
            }
        }

        $profile->update($updateData);

        $statusLabel = match ($validated['status']) {
            'APPROVED' => 'Approved & Enrolled as Intern',
            'REJECTED' => 'Rejected',
            'ACTIVE' => 'Active Intern',
            'COMPLETED' => 'Completed',
            default => 'Pending Review',
        };

        return back()->with('success', "Application {$profile->application_number} is now marked as {$statusLabel}.");
    }

    /**
     * Issue Offer & Acceptance Letter
     */
    public function issueOfferLetter($id)
    {
        $profile = StudentProfile::findOrFail($id);
        $profile->update([
            'offer_letter_issued' => true,
            'offer_letter_date' => now(),
            'status' => $profile->status === 'PENDING' ? 'APPROVED' : $profile->status,
        ]);

        return back()->with('success', "Offer & Acceptance Letter released for {$profile->application_number}!");
    }

    /**
     * Issue Consent Letter
     */
    public function issueConsentLetter($id)
    {
        $profile = StudentProfile::findOrFail($id);
        $profile->update([
            'consent_letter_issued' => true,
            'consent_letter_date' => now(),
        ]);

        return back()->with('success', "Official Consent Letter generated and released for {$profile->application_number}!");
    }

    /**
     * Issue Completion Certificate (Approval Access)
     */
    public function issueCertificate($id, Request $request)
    {
        $profile = StudentProfile::findOrFail($id);

        $certNumber = $request->filled('certificate_number')
            ? trim($request->certificate_number)
            : 'UGC-INF-'.rand(100000, 999999);

        // Ensure unique
        while (StudentProfile::where('certificate_number', $certNumber)->where('id', '!=', $profile->id)->exists()) {
            $certNumber = 'UGC-INF-'.rand(100000, 999999);
        }

        $certDate = $request->filled('certificate_date')
            ? $request->certificate_date
            : now();

        $profile->update([
            'certificate_issued' => true,
            'certificate_number' => $certNumber,
            'certificate_date' => $certDate,
            'status' => 'COMPLETED',
        ]);

        return back()->with('success', "UGC Certificate {$certNumber} approved and issued successfully!");
    }

    /**
     * Issue Letter of Recommendation (LOR)
     */
    public function issueLor($id, Request $request)
    {
        $profile = StudentProfile::findOrFail($id);

        $lorNumber = $request->filled('lor_number')
            ? trim($request->lor_number)
            : 'INF-LOR-2026-'.rand(1000, 9999);

        // Ensure unique
        while (StudentProfile::where('lor_number', $lorNumber)->where('id', '!=', $profile->id)->exists()) {
            $lorNumber = 'INF-LOR-2026-'.rand(1000, 9999);
        }

        $lorDate = $request->filled('lor_date')
            ? $request->lor_date
            : now();

        $profile->update([
            'lor_issued' => true,
            'lor_number' => $lorNumber,
            'lor_date' => $lorDate,
            'lor_remarks' => $request->input('lor_remarks', 'Demonstrated exceptional technical aptitude and commitment to academic excellence.'),
        ]);

        return back()->with('success', "Official Letter of Recommendation (LOR {$lorNumber}) released for {$profile->application_number}!");
    }

    /**
     * Issue Academic Marksheet
     */
    public function issueMarksheet($id, Request $request)
    {
        $profile = StudentProfile::findOrFail($id);

        $validated = $request->validate([
            'marksheet_grade' => ['nullable', 'string', 'max:10'],
            'marksheet_marks' => ['nullable', 'integer', 'min:0', 'max:100'],
        ]);

        $profile->update([
            'marksheet_issued' => true,
            'marksheet_grade' => $validated['marksheet_grade'] ?: 'A+',
            'marksheet_marks' => $validated['marksheet_marks'] ?? 92,
            'marksheet_date' => now(),
        ]);

        return back()->with('success', "Official Evaluation Marksheet generated for {$profile->application_number}!");
    }

    /**
     * Update Details (Inline / Quick)
     */
    public function updateDetails($id, Request $request)
    {
        $validated = $request->validate([
            'attendance_rate' => ['required', 'integer', 'min:0', 'max:100'],
            'mentor_name' => ['required', 'string', 'max:255'],
            'project_title' => ['required', 'string', 'max:255'],
        ]);

        $profile = StudentProfile::findOrFail($id);
        $profile->update($validated);

        return back()->with('success', "Student record details updated for {$profile->application_number}");
    }

    /**
     * Comprehensive Dynamic Applicant Edit
     */
    public function updateFullApplicant($id, Request $request)
    {
        $profile = StudentProfile::with('user')->findOrFail($id);
        $user = $profile->user;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.($user ? $user->id : 0)],
            'phone' => ['required', 'string', 'max:50'],
            'college' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:50'],
            'semester' => ['required', 'string', 'max:50'],
            'program_domain' => ['required', 'string', 'max:255'],
            'mentor_name' => ['required', 'string', 'max:255'],
            'project_title' => ['required', 'string', 'max:255'],
            'attendance_rate' => ['required', 'integer', 'min:0', 'max:100'],
            'status' => ['required', 'string', 'in:PENDING,APPROVED,ACTIVE,COMPLETED,REJECTED'],
            'offer_letter_issued' => ['nullable'],
            'consent_letter_issued' => ['nullable'],
            'certificate_issued' => ['nullable'],
            'certificate_number' => ['nullable', 'string', 'max:100'],
            'lor_issued' => ['nullable'],
            'lor_number' => ['nullable', 'string', 'max:100'],
        ]);

        if ($user) {
            $user->update([
                'name' => trim($validated['name']),
                'email' => strtolower(trim($validated['email'])),
                'phone' => trim($validated['phone']),
            ]);
        }

        $profile->update([
            'college' => trim($validated['college']),
            'degree' => $validated['degree'],
            'semester' => $validated['semester'],
            'program_domain' => $validated['program_domain'],
            'mentor_name' => trim($validated['mentor_name']),
            'project_title' => trim($validated['project_title']),
            'attendance_rate' => $validated['attendance_rate'],
            'status' => $validated['status'],
            'offer_letter_issued' => $request->has('offer_letter_issued'),
            'offer_letter_date' => $request->has('offer_letter_issued') ? ($profile->offer_letter_date ?? now()) : null,
            'consent_letter_issued' => $request->has('consent_letter_issued'),
            'consent_letter_date' => $request->has('consent_letter_issued') ? ($profile->consent_letter_date ?? now()) : null,
            'certificate_issued' => $request->has('certificate_issued'),
            'certificate_number' => $request->filled('certificate_number') ? trim($request->certificate_number) : ($profile->certificate_number ?? 'UGC-INF-'.rand(100000, 999999)),
            'certificate_date' => $request->has('certificate_issued') ? ($profile->certificate_date ?? now()) : null,
            'lor_issued' => $request->has('lor_issued'),
            'lor_number' => $request->filled('lor_number') ? trim($request->lor_number) : ($profile->lor_number ?? 'INF-LOR-2026-'.rand(1000, 9999)),
            'lor_date' => $request->has('lor_issued') ? ($profile->lor_date ?? now()) : null,
        ]);

        return back()->with('success', "Candidate profile & document records updated successfully for {$profile->application_number}!");
    }

    /**
     * Store New Student Applicant (Admin Direct Action)
     */
    public function storeApplicant(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'college' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:50'],
            'semester' => ['required', 'string', 'max:50'],
            'program_domain' => ['required', 'string', 'max:255'],
            'mentor_name' => ['nullable', 'string', 'max:255'],
            'project_title' => ['nullable', 'string', 'max:255'],
            'attendance_rate' => ['nullable', 'integer', 'min:0', 'max:100'],
            'status' => ['required', 'string', 'in:PENDING,APPROVED,ACTIVE,COMPLETED'],
        ]);

        $user = User::firstOrCreate(
            ['email' => strtolower(trim($validated['email']))],
            [
                'name' => trim($validated['name']),
                'phone' => trim($validated['phone']),
                'password' => Hash::make('Student@123'),
                'role' => 'STUDENT',
            ]
        );

        $appNumber = 'INF-2026-'.rand(1000, 9999);
        while (StudentProfile::where('application_number', $appNumber)->exists()) {
            $appNumber = 'INF-2026-'.rand(1000, 9999);
        }

        $profile = StudentProfile::create([
            'user_id' => $user->id,
            'application_number' => $appNumber,
            'college' => trim($validated['college']),
            'degree' => $validated['degree'],
            'semester' => $validated['semester'],
            'program_domain' => $validated['program_domain'],
            'mentor_name' => ! empty($validated['mentor_name']) ? $validated['mentor_name'] : 'Faculty Advisory Board',
            'project_title' => ! empty($validated['project_title']) ? $validated['project_title'] : 'Capstone Research Evaluation',
            'attendance_rate' => $validated['attendance_rate'] ?? 85,
            'status' => $validated['status'],
            'offer_letter_issued' => in_array($validated['status'], ['APPROVED', 'ACTIVE', 'COMPLETED']),
            'offer_letter_date' => in_array($validated['status'], ['APPROVED', 'ACTIVE', 'COMPLETED']) ? now() : null,
            'consent_letter_issued' => in_array($validated['status'], ['ACTIVE', 'COMPLETED']),
            'consent_letter_date' => in_array($validated['status'], ['ACTIVE', 'COMPLETED']) ? now() : null,
        ]);

        return back()->with('success', "New student applicant {$user->name} ({$appNumber}) enrolled successfully!");
    }

    /**
     * Revoke Issued Certificate
     */
    public function revokeCertificate($id)
    {
        $profile = StudentProfile::findOrFail($id);
        $oldCert = $profile->certificate_number;
        $profile->update([
            'certificate_issued' => false,
            'certificate_date' => null,
            'status' => 'ACTIVE',
        ]);

        return back()->with('success', "Certificate {$oldCert} for {$profile->application_number} has been revoked.");
    }

    /**
     * Export Filtered Applications as CSV
     */
    public function exportApplications(Request $request)
    {
        $query = StudentProfile::with('user');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        if ($request->filled('degree') && $request->degree !== 'all') {
            $query->where('degree', $request->degree);
        }
        if ($request->filled('domain') && $request->domain !== 'all') {
            $query->where('program_domain', $request->domain);
        }

        $profiles = $query->latest()->get();

        $filename = 'infinity_interns_applications_'.date('Ymd_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($profiles) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'Application Number',
                'Candidate Name',
                'Email',
                'Phone',
                'College',
                'Degree',
                'Semester',
                'Program Domain',
                'Status',
                'Attendance %',
                'Mentor',
                'Project Title',
                'Certificate Issued',
                'Certificate Number',
            ]);

            foreach ($profiles as $p) {
                fputcsv($file, [
                    $p->application_number,
                    $p->user->name ?? '',
                    $p->user->email ?? '',
                    $p->user->phone ?? '',
                    $p->college,
                    $p->degree,
                    $p->semester,
                    $p->program_domain,
                    $p->status,
                    $p->attendance_rate.'%',
                    $p->mentor_name,
                    $p->project_title,
                    $p->certificate_issued ? 'YES' : 'NO',
                    $p->certificate_number ?? '',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Delete Application and Student User Account
     */
    public function deleteApplication($id)
    {
        $profile = StudentProfile::findOrFail($id);
        $appNo = $profile->application_number;
        $user = $profile->user;

        if ($user) {
            $user->delete();
        } else {
            $profile->delete();
        }

        return back()->with('success', "Application {$appNo} deleted successfully.");
    }

    /**
     * Inquiries Desk
     */
    public function inquiries(Request $request)
    {
        $inquiries = Inquiry::latest()->paginate(20);

        return view('admin.inquiries', compact('inquiries'));
    }

    /**
     * Update Inquiry Status
     */
    public function updateInquiryStatus($id, Request $request)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->update([
            'status' => $request->input('status', 'REVIEWED'),
        ]);

        return back()->with('success', 'Inquiry marked as '.$inquiry->status);
    }

    /**
     * View Student Offer Letter
     */
    public function viewStudentOfferLetter($id)
    {
        $profile = StudentProfile::with('user')->findOrFail($id);
        $user = $profile->user;

        return view('documents.offer-letter', compact('user', 'profile'));
    }

    /**
     * View Student Consent Letter
     */
    public function viewStudentConsentLetter($id)
    {
        $profile = StudentProfile::with('user')->findOrFail($id);
        $user = $profile->user;

        return view('documents.consent-letter', compact('user', 'profile'));
    }

    /**
     * View Student Certificate
     */
    public function viewStudentCertificate($id)
    {
        $profile = StudentProfile::with('user')->findOrFail($id);
        $user = $profile->user;

        return view('documents.certificate', compact('user', 'profile'));
    }

    /**
     * View Student LOR
     */
    public function viewStudentLor($id)
    {
        $profile = StudentProfile::with('user')->findOrFail($id);
        $user = $profile->user;

        return view('documents.lor', compact('user', 'profile'));
    }

    /**
     * View Student Marksheet
     */
    public function viewStudentMarksheet($id)
    {
        $profile = StudentProfile::with('user')->findOrFail($id);
        $user = $profile->user;

        return view('documents.marksheet', compact('user', 'profile'));
    }

    /**
     * Manual Certificate Generator View
     */
    public function certificateGenerator(Request $request)
    {
        $students = StudentProfile::with('user')
            ->whereIn('status', ['APPROVED', 'ACTIVE', 'COMPLETED'])
            ->latest()
            ->get();

        $streams = InternshipStream::where('is_active', true)->orderBy('title')->get();

        $recentCertificates = StudentProfile::with('user')
            ->where('certificate_issued', true)
            ->latest('certificate_date')
            ->take(8)
            ->get();

        $selectedStudent = null;
        if ($request->filled('student_id')) {
            $selectedStudent = StudentProfile::with('user')->find($request->student_id);
        }

        return view('admin.certificate-generator', compact('students', 'streams', 'recentCertificates', 'selectedStudent'));
    }

    /**
     * Generate & Save Manual Certificate
     */
    public function generateManualCertificate(Request $request)
    {
        $validated = $request->validate([
            'mode' => ['required', 'string', 'in:existing,custom'],
            'student_id' => ['nullable', 'required_if:mode,existing', 'exists:student_profiles,id'],
            'candidate_name' => ['nullable', 'required_if:mode,custom', 'string', 'max:255'],
            'candidate_email' => ['nullable', 'email', 'max:255'],
            'college' => ['nullable', 'required_if:mode,custom', 'string', 'max:255'],
            'degree' => ['nullable', 'required_if:mode,custom', 'string', 'max:50'],
            'semester' => ['nullable', 'string', 'max:50'],
            'program_domain' => ['required', 'string', 'max:255'],
            'certificate_number' => ['nullable', 'string', 'max:100'],
            'certificate_date' => ['required', 'date'],
            'mentor_name' => ['nullable', 'string', 'max:255'],
            'project_title' => ['nullable', 'string', 'max:255'],
            'marksheet_grade' => ['nullable', 'string', 'max:10'],
        ]);

        if ($validated['mode'] === 'existing') {
            $profile = StudentProfile::findOrFail($validated['student_id']);
            $certNumber = $validated['certificate_number'] ?: ($profile->certificate_number ?: 'UGC-INF-'.rand(100000, 999999));

            $profile->update([
                'certificate_issued' => true,
                'certificate_number' => $certNumber,
                'certificate_date' => $validated['certificate_date'],
                'status' => 'COMPLETED',
                'mentor_name' => $validated['mentor_name'] ?: $profile->mentor_name,
                'project_title' => $validated['project_title'] ?: $profile->project_title,
                'marksheet_grade' => $validated['marksheet_grade'] ?: $profile->marksheet_grade,
            ]);

            return redirect()->route('admin.application.view-certificate', $profile->id)
                ->with('success', "Certificate {$certNumber} successfully updated and generated for {$profile->user->name}!");
        }

        // Mode: custom candidate - create student account and certified profile
        $email = $validated['candidate_email'] ?: 'manual.'.Str::slug($validated['candidate_name']).'.'.rand(100, 999).'@infinityinterns.local';
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => trim($validated['candidate_name']),
                'phone' => '+91 9000000000',
                'password' => Hash::make('Student@123'),
                'role' => 'STUDENT',
            ]
        );

        $appNumber = 'INF-2026-'.rand(1000, 9999);
        $certNumber = $validated['certificate_number'] ?: 'UGC-INF-'.rand(100000, 999999);

        $profile = StudentProfile::create([
            'user_id' => $user->id,
            'application_number' => $appNumber,
            'degree' => $validated['degree'] ?? 'BSc',
            'college' => trim($validated['college']),
            'semester' => $validated['semester'] ?? '6th Semester',
            'program_domain' => $validated['program_domain'],
            'status' => 'COMPLETED',
            'attendance_rate' => 95,
            'mentor_name' => $validated['mentor_name'] ?: 'Faculty Advisory Board',
            'project_title' => $validated['project_title'] ?: 'Undergraduate Capstone Research Report',
            'offer_letter_issued' => true,
            'offer_letter_date' => now(),
            'consent_letter_issued' => true,
            'consent_letter_date' => now(),
            'certificate_issued' => true,
            'certificate_number' => $certNumber,
            'certificate_date' => $validated['certificate_date'],
            'marksheet_issued' => true,
            'marksheet_grade' => $validated['marksheet_grade'] ?: 'A+',
            'marksheet_marks' => 94,
            'marksheet_date' => $validated['certificate_date'],
        ]);

        return redirect()->route('admin.application.view-certificate', $profile->id)
            ->with('success', "Manual certificate {$certNumber} generated successfully for {$user->name}!");
    }

    /**
     * Dedicated Degrees Management Page
     */
    public function degrees(Request $request)
    {
        $query = Degree::withCount('studentProfiles');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $degrees = $query->orderBy('sort_order')->orderBy('name')->paginate(15)->withQueryString();
        $stats = [
            'total' => Degree::count(),
            'active' => Degree::where('is_active', true)->count(),
            'inactive' => Degree::where('is_active', false)->count(),
            'students' => Degree::withCount('studentProfiles')->get()->sum('student_profiles_count'),
        ];

        return view('admin.degrees', compact('degrees', 'stats'));
    }

    /**
     * Dedicated Schools & Colleges Management Page
     */
    public function schools(Request $request)
    {
        $query = School::withCount('studentProfiles');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            });
        }

        $schools = $query->orderBy('name')->paginate(15)->withQueryString();
        $stats = [
            'total' => School::count(),
            'active' => School::where('is_active', true)->count(),
            'inactive' => School::where('is_active', false)->count(),
            'students' => School::withCount('studentProfiles')->get()->sum('student_profiles_count'),
        ];

        return view('admin.schools', compact('schools', 'stats'));
    }

    /**
     * Academic Setup Hub Dispatcher
     */
    public function academicSetup(Request $request)
    {
        $tab = $request->input('tab', 'degrees');

        if ($tab === 'schools') {
            return $this->schools($request);
        }

        if ($tab === 'domains' || $tab === 'streams') {
            return $this->streams($request);
        }

        return $this->degrees($request);
    }

    /**
     * Store New Degree
     */
    public function storeDegree(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:degrees,code'],
            'duration' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable'],
        ]);

        Degree::create([
            'name' => trim($validated['name']),
            'code' => strtoupper(trim($validated['code'])),
            'duration' => trim($validated['duration']),
            'description' => ! empty($validated['description']) ? trim($validated['description']) : null,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.academic-setup', ['tab' => 'degrees'])
            ->with('success', "New degree '{$validated['name']} ({$validated['code']})' created successfully!");
    }

    /**
     * Update Degree
     */
    public function updateDegree($id, Request $request)
    {
        $degree = Degree::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:degrees,code,'.$degree->id],
            'duration' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable'],
        ]);

        $degree->update([
            'name' => trim($validated['name']),
            'code' => strtoupper(trim($validated['code'])),
            'duration' => trim($validated['duration']),
            'description' => ! empty($validated['description']) ? trim($validated['description']) : null,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.academic-setup', ['tab' => 'degrees'])
            ->with('success', "Degree '{$degree->name}' updated successfully!");
    }

    /**
     * Toggle Degree Active Status
     */
    public function toggleDegreeStatus($id)
    {
        $degree = Degree::findOrFail($id);
        $degree->update(['is_active' => ! $degree->is_active]);

        $statusText = $degree->is_active ? 'Activated' : 'Deactivated';

        return redirect()->route('admin.academic-setup', ['tab' => 'degrees'])
            ->with('success', "Degree '{$degree->name}' has been {$statusText}.");
    }

    /**
     * Delete Degree
     */
    public function deleteDegree($id)
    {
        $degree = Degree::findOrFail($id);
        $name = $degree->name;

        if ($degree->studentProfiles()->count() > 0) {
            return redirect()->route('admin.academic-setup', ['tab' => 'degrees'])
                ->with('error', "Cannot delete degree '{$name}' because registered students are currently mapped to it. Consider deactivating it instead.");
        }

        $degree->delete();

        return redirect()->route('admin.academic-setup', ['tab' => 'degrees'])
            ->with('success', "Degree '{$name}' removed successfully.");
    }

    /**
     * Store New School / College
     */
    public function storeSchool(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:schools,name'],
            'code' => ['nullable', 'string', 'max:50'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'type' => ['required', 'string', 'max:50'],
            'is_active' => ['nullable'],
        ]);

        School::create([
            'name' => trim($validated['name']),
            'code' => ! empty($validated['code']) ? strtoupper(trim($validated['code'])) : null,
            'city' => ! empty($validated['city']) ? trim($validated['city']) : null,
            'state' => ! empty($validated['state']) ? trim($validated['state']) : 'Bihar',
            'type' => strtoupper(trim($validated['type'])),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.academic-setup', ['tab' => 'schools'])
            ->with('success', "Institution / School '{$validated['name']}' added successfully!");
    }

    /**
     * Update School / College
     */
    public function updateSchool($id, Request $request)
    {
        $school = School::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:schools,name,'.$school->id],
            'code' => ['nullable', 'string', 'max:50'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'type' => ['required', 'string', 'max:50'],
            'is_active' => ['nullable'],
        ]);

        $school->update([
            'name' => trim($validated['name']),
            'code' => ! empty($validated['code']) ? strtoupper(trim($validated['code'])) : null,
            'city' => ! empty($validated['city']) ? trim($validated['city']) : null,
            'state' => ! empty($validated['state']) ? trim($validated['state']) : 'Bihar',
            'type' => strtoupper(trim($validated['type'])),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.academic-setup', ['tab' => 'schools'])
            ->with('success', "Institution / School '{$school->name}' updated successfully!");
    }

    /**
     * Toggle School Active Status
     */
    public function toggleSchoolStatus($id)
    {
        $school = School::findOrFail($id);
        $school->update(['is_active' => ! $school->is_active]);

        $statusText = $school->is_active ? 'Activated' : 'Deactivated';

        return redirect()->route('admin.academic-setup', ['tab' => 'schools'])
            ->with('success', "Institution '{$school->name}' has been {$statusText}.");
    }

    /**
     * Delete School / College
     */
    public function deleteSchool($id)
    {
        $school = School::findOrFail($id);
        $name = $school->name;

        if ($school->studentProfiles()->count() > 0) {
            return redirect()->route('admin.academic-setup', ['tab' => 'schools'])
                ->with('error', "Cannot delete institution '{$name}' because enrolled students are currently associated with it. Consider deactivating it instead.");
        }

        $school->delete();

        return redirect()->route('admin.academic-setup', ['tab' => 'schools'])
            ->with('success', "Institution '{$name}' removed successfully.");
    }

    /**
     * Internship Streams Management View
     */
    public function streams(Request $request)
    {
        $query = InternshipStream::withCount('studentProfiles');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $streams = $query->orderBy('title')->paginate(15)->withQueryString();

        return view('admin.streams', compact('streams'));
    }

    /**
     * Store New Internship Stream / Domain
     */
    public function storeStream(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:internship_streams,code'],
            'category' => ['required', 'string', 'max:100'],
            'duration' => ['required', 'string', 'max:100'],
            'credits' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'is_active' => ['nullable'],
        ]);

        InternshipStream::create([
            'title' => trim($validated['title']),
            'code' => strtoupper(trim($validated['code'])),
            'category' => strtoupper(trim($validated['category'])),
            'duration' => trim($validated['duration']),
            'credits' => trim($validated['credits']),
            'description' => trim($validated['description']),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', "New internship domain stream '{$validated['title']}' added successfully!");
    }

    /**
     * Update Internship Stream / Domain
     */
    public function updateStream($id, Request $request)
    {
        $stream = InternshipStream::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:internship_streams,code,'.$stream->id],
            'category' => ['required', 'string', 'max:100'],
            'duration' => ['required', 'string', 'max:100'],
            'credits' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'is_active' => ['nullable'],
        ]);

        $stream->update([
            'title' => trim($validated['title']),
            'code' => strtoupper(trim($validated['code'])),
            'category' => strtoupper(trim($validated['category'])),
            'duration' => trim($validated['duration']),
            'credits' => trim($validated['credits']),
            'description' => trim($validated['description']),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', "Internship domain stream '{$stream->title}' updated successfully!");
    }

    /**
     * Toggle Internship Stream Active Status
     */
    public function toggleStreamStatus($id)
    {
        $stream = InternshipStream::findOrFail($id);
        $stream->update(['is_active' => ! $stream->is_active]);

        $statusText = $stream->is_active ? 'Activated' : 'Deactivated';

        return back()->with('success', "Domain stream '{$stream->title}' has been {$statusText}.");
    }

    /**
     * Delete Internship Stream
     */
    public function deleteStream($id)
    {
        $stream = InternshipStream::findOrFail($id);
        $title = $stream->title;

        // Check if students are enrolled
        if ($stream->studentProfiles()->count() > 0) {
            return back()->with('error', "Cannot delete stream '{$title}' because students are currently mapped to this domain. Consider deactivating it instead.");
        }

        $stream->delete();

        return back()->with('success', "Stream '{$title}' removed successfully.");
    }

    /**
     * Track Application Visual Lifecycle Stepper
     */
    public function trackApplication(Request $request, $appNumber = null)
    {
        $search = $appNumber ?? $request->input('search');

        $profile = null;
        if ($search) {
            $search = trim($search);
            $profile = StudentProfile::with('user')
                ->where('application_number', $search)
                ->orWhere('certificate_number', $search)
                ->orWhere('lor_number', $search)
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('email', $search)->orWhere('name', 'like', "%{$search}%");
                })
                ->first();
        }

        if (! $profile) {
            $profile = StudentProfile::with('user')->latest()->first();
        }

        $recentStudents = StudentProfile::with('user')->latest()->take(10)->get();

        return view('admin.track', compact('profile', 'recentStudents', 'search'));
    }
}
