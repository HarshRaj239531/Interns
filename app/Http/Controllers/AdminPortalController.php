<?php

namespace App\Http\Controllers;

use App\Models\CertificateSetting;
use App\Models\ConsentLetterSetting;
use App\Models\Degree;
use App\Models\Inquiry;
use App\Models\InternshipStream;
use App\Models\OfferLetterSetting;
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

        // College filter
        if ($request->filled('college') && $request->college !== 'all') {
            $query->where('college', $request->college);
        }

        // Document Status filter
        if ($request->filled('doc_status') && $request->doc_status !== 'all') {
            match ($request->doc_status) {
                'cert_pending' => $query->where('certificate_issued', false),
                'cert_issued' => $query->where('certificate_issued', true),
                'offer_pending' => $query->where('offer_letter_issued', false),
                'offer_issued' => $query->where('offer_letter_issued', true),
                'lor_pending' => $query->where('lor_issued', false),
                'lor_issued' => $query->where('lor_issued', true),
                default => null,
            };
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

        $perPage = in_array((int) $request->input('per_page', 15), [10, 15, 25, 50, 100], true)
            ? (int) $request->input('per_page', 15)
            : 15;

        $applications = $query->paginate($perPage)->withQueryString();

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
     * Perform Bulk Operations on Selected Applications / Enrolled Students
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => ['required', 'string', 'in:certificate,offer_letter,consent_letter,lor,status,delete'],
            'selected_ids' => ['required', 'array', 'min:1'],
            'selected_ids.*' => ['integer', 'exists:student_profiles,id'],
            'status' => ['nullable', 'string', 'in:PENDING,APPROVED,ACTIVE,COMPLETED,REJECTED'],
            'internship_start_date' => ['nullable', 'date'],
            'internship_end_date' => ['nullable', 'date'],
            'certificate_date' => ['nullable', 'date'],
            'certificate_prefix' => ['nullable', 'string', 'max:30'],
            'lor_date' => ['nullable', 'date'],
            'lor_remarks' => ['nullable', 'string', 'max:500'],
        ]);

        $profiles = StudentProfile::with('user')->whereIn('id', $validated['selected_ids'])->get();
        $count = $profiles->count();

        if ($count === 0) {
            return back()->with('error', 'No valid students selected for bulk operation.');
        }

        return match ($validated['action']) {
            'certificate' => $this->handleBulkCertificate($profiles, $request),
            'offer_letter' => $this->handleBulkOfferLetter($profiles),
            'consent_letter' => $this->handleBulkConsentLetter($profiles),
            'lor' => $this->handleBulkLor($profiles, $request),
            'status' => $this->handleBulkStatus($profiles, $validated['status'] ?? 'ACTIVE'),
            'delete' => $this->handleBulkDelete($profiles),
            default => back()->with('error', 'Invalid bulk action requested.'),
        };
    }

    /**
     * Batch Issue Certificates
     */
    protected function handleBulkCertificate($profiles, Request $request)
    {
        $prefix = trim($request->input('certificate_prefix', 'UGC-INF-')) ?: 'UGC-INF-';
        $certDate = $request->filled('certificate_date') ? $request->certificate_date : now();
        $startDate = $request->input('internship_start_date');
        $endDate = $request->input('internship_end_date');

        $issuedCount = 0;
        foreach ($profiles as $profile) {
            $certNum = $profile->certificate_number;
            if (empty($certNum)) {
                do {
                    $certNum = $prefix.rand(100000, 999999);
                } while (StudentProfile::where('certificate_number', $certNum)->where('id', '!=', $profile->id)->exists());
            }

            $sDate = $startDate ?: ($profile->internship_start_date ? $profile->internship_start_date->format('Y-m-d') : null);
            $eDate = $endDate ?: ($profile->internship_end_date ? $profile->internship_end_date->format('Y-m-d') : now()->format('Y-m-d'));

            $profile->update([
                'certificate_issued' => true,
                'certificate_number' => $certNum,
                'certificate_date' => $certDate,
                'internship_start_date' => $sDate,
                'internship_end_date' => $eDate,
                'status' => 'COMPLETED',
            ]);
            $issuedCount++;
        }

        return back()->with('success', "Batch Certificate Issuance complete! Generated & approved UGC certificates for {$issuedCount} student(s).");
    }

    /**
     * Batch Issue Offer Letters
     */
    protected function handleBulkOfferLetter($profiles)
    {
        $issuedCount = 0;
        foreach ($profiles as $profile) {
            $profile->update([
                'offer_letter_issued' => true,
                'offer_letter_date' => now(),
                'status' => $profile->status === 'PENDING' ? 'APPROVED' : $profile->status,
            ]);
            $issuedCount++;
        }

        return back()->with('success', "Batch Offer Letter release complete! Successfully released for {$issuedCount} student(s).");
    }

    /**
     * Batch Issue Consent Letters
     */
    protected function handleBulkConsentLetter($profiles)
    {
        $issuedCount = 0;
        foreach ($profiles as $profile) {
            $profile->update([
                'consent_letter_issued' => true,
                'consent_letter_date' => now(),
            ]);
            $issuedCount++;
        }

        return back()->with('success', "Batch Consent Undertakings released for {$issuedCount} student(s).");
    }

    /**
     * Batch Issue Letters of Recommendation
     */
    protected function handleBulkLor($profiles, Request $request)
    {
        $lorDate = $request->filled('lor_date') ? $request->lor_date : now();
        $remarks = $request->input('lor_remarks') ?: 'Demonstrated exceptional technical aptitude and commitment to academic excellence.';
        $issuedCount = 0;

        foreach ($profiles as $profile) {
            $lorNum = $profile->lor_number;
            if (empty($lorNum)) {
                do {
                    $lorNum = 'INF-LOR-2026-'.rand(1000, 9999);
                } while (StudentProfile::where('lor_number', $lorNum)->where('id', '!=', $profile->id)->exists());
            }

            $profile->update([
                'lor_issued' => true,
                'lor_number' => $lorNum,
                'lor_date' => $lorDate,
                'lor_remarks' => $remarks,
            ]);
            $issuedCount++;
        }

        return back()->with('success', "Batch Letter of Recommendation (LOR) issuance complete for {$issuedCount} student(s).");
    }

    /**
     * Batch Change Status
     */
    protected function handleBulkStatus($profiles, string $newStatus)
    {
        $count = 0;
        foreach ($profiles as $profile) {
            $update = ['status' => $newStatus];
            if ($newStatus === 'APPROVED') {
                if (! $profile->offer_letter_issued) {
                    $update['offer_letter_issued'] = true;
                    $update['offer_letter_date'] = now();
                }
                if (! $profile->consent_letter_issued) {
                    $update['consent_letter_issued'] = true;
                    $update['consent_letter_date'] = now();
                }
            }
            $profile->update($update);
            $count++;
        }

        return back()->with('success', "Application status successfully changed to {$newStatus} for {$count} student(s).");
    }

    /**
     * Batch Delete
     */
    protected function handleBulkDelete($profiles)
    {
        $count = $profiles->count();
        foreach ($profiles as $profile) {
            $profile->delete();
        }

        return back()->with('success', "Successfully deleted {$count} student record(s) from registry.");
    }

    /**
     * Export applications / enrolled students to CSV
     */
    public function exportApplications(Request $request)
    {
        $query = StudentProfile::with('user');

        if ($request->filled('selected_ids')) {
            $ids = is_array($request->selected_ids) ? $request->selected_ids : explode(',', $request->selected_ids);
            $query->whereIn('id', array_filter($ids));
        } elseif ($request->filled('ids')) {
            $ids = is_array($request->ids) ? $request->ids : explode(',', $request->ids);
            $query->whereIn('id', array_filter($ids));
        } else {
            $tab = $request->input('tab', 'overview');
            if ($tab === 'enrolled') {
                $query->whereIn('status', ['APPROVED', 'ACTIVE', 'COMPLETED']);
            } elseif ($tab === 'pending_cert') {
                $query->whereIn('status', ['APPROVED', 'ACTIVE', 'COMPLETED'])
                    ->where('certificate_issued', false);
            } elseif ($tab === 'issued_cert') {
                $query->where('certificate_issued', true);
            }

            if ($request->filled('status') && $request->status !== 'all') {
                $query->where('status', $request->status);
            }
            if ($request->filled('degree') && $request->degree !== 'all') {
                $query->where('degree', $request->degree);
            }
            if ($request->filled('domain') && $request->domain !== 'all') {
                $query->where('program_domain', $request->domain);
            }
            if ($request->filled('college') && $request->college !== 'all') {
                $query->where('college', $request->college);
            }
            if ($request->filled('doc_status') && $request->doc_status !== 'all') {
                match ($request->doc_status) {
                    'cert_pending' => $query->where('certificate_issued', false),
                    'cert_issued' => $query->where('certificate_issued', true),
                    'offer_pending' => $query->where('offer_letter_issued', false),
                    'offer_issued' => $query->where('offer_letter_issued', true),
                    'lor_pending' => $query->where('lor_issued', false),
                    'lor_issued' => $query->where('lor_issued', true),
                    default => null,
                };
            }
            if ($request->filled('search')) {
                $search = trim($request->search);
                $query->where(function ($q) use ($search) {
                    $q->where('application_number', 'like', "%{$search}%")
                        ->orWhere('college', 'like', "%{$search}%")
                        ->orWhere('program_domain', 'like', "%{$search}%")
                        ->orWhere('certificate_number', 'like', "%{$search}%")
                        ->orWhere('lor_number', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($uq) use ($search) {
                            $uq->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('phone', 'like', "%{$search}%");
                        });
                });
            }
        }

        $records = $query->latest()->get();
        $filename = 'student_registry_export_'.now()->format('Y_m_d_His').'.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($records) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'Application Number',
                'Candidate Name',
                'Email',
                'Phone',
                'Degree Program',
                'Current Semester',
                'College / Institute',
                'Internship Domain Track',
                'Father Name',
                'Univ Reg Number',
                'Univ Roll Number',
                'Attendance Rate',
                'Assigned Mentor',
                'Capstone Project',
                'Status',
                'Offer Letter Issued',
                'Consent Letter Issued',
                'Certificate Issued',
                'Certificate Number',
                'Internship Start Date',
                'Internship End Date',
                'Certificate Issue Date',
                'LOR Issued',
                'LOR Reference Number',
                'Scorecard Issued',
                'Marksheet Grade',
                'Marksheet Marks',
                'Enrolled At',
            ]);

            foreach ($records as $r) {
                fputcsv($handle, [
                    $r->application_number,
                    $r->user->name ?? 'N/A',
                    $r->user->email ?? 'N/A',
                    $r->user->phone ?? 'N/A',
                    $r->degree,
                    $r->semester,
                    $r->college,
                    $r->program_domain,
                    $r->father_name ?? '',
                    $r->university_reg_no ?? '',
                    $r->university_roll_no ?? '',
                    $r->attendance_rate.'%',
                    $r->mentor_name,
                    $r->project_title,
                    $r->status,
                    $r->offer_letter_issued ? 'YES' : 'NO',
                    $r->consent_letter_issued ? 'YES' : 'NO',
                    $r->certificate_issued ? 'YES' : 'NO',
                    $r->certificate_number ?? '',
                    $r->internship_start_date ? $r->internship_start_date->format('d/m/Y') : '',
                    $r->internship_end_date ? $r->internship_end_date->format('d/m/Y') : '',
                    $r->certificate_date ? $r->certificate_date->format('d/m/Y') : '',
                    $r->lor_issued ? 'YES' : 'NO',
                    $r->lor_number ?? '',
                    $r->marksheet_issued ? 'YES' : 'NO',
                    $r->marksheet_grade ?? '',
                    $r->marksheet_marks ?? '',
                    $r->created_at ? $r->created_at->format('d/m/Y H:i') : '',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
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

        $request->validate([
            'certificate_number' => ['nullable', 'string', 'max:100'],
            'certificate_date' => ['nullable', 'date'],
            'internship_start_date' => ['nullable', 'date'],
            'internship_end_date' => ['nullable', 'date'],
        ]);

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

        $startDate = $request->filled('internship_start_date')
            ? $request->internship_start_date
            : ($profile->internship_start_date ?? ($profile->offer_letter_date ? $profile->offer_letter_date->format('Y-m-d') : null));

        $endDate = $request->filled('internship_end_date')
            ? $request->internship_end_date
            : ($profile->internship_end_date ?? ($request->filled('certificate_date') ? $request->certificate_date : now()->format('Y-m-d')));

        $profile->update([
            'certificate_issued' => true,
            'certificate_number' => $certNumber,
            'certificate_date' => $certDate,
            'internship_start_date' => $startDate,
            'internship_end_date' => $endDate,
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
            'new_password' => ['nullable', 'string', 'min:6'],
            'college' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:50'],
            'semester' => ['required', 'string', 'max:50'],
            'gender' => ['nullable', 'string', 'max:50'],
            'father_name' => ['nullable', 'string', 'max:255'],
            'university_reg_no' => ['nullable', 'string', 'max:100'],
            'university_roll_no' => ['nullable', 'string', 'max:100'],
            'program_domain' => ['required', 'string', 'max:255'],
            'mentor_name' => ['required', 'string', 'max:255'],
            'project_title' => ['required', 'string', 'max:255'],
            'attendance_rate' => ['required', 'integer', 'min:0', 'max:100'],
            'status' => ['required', 'string', 'in:PENDING,APPROVED,ACTIVE,COMPLETED,REJECTED'],
            'offer_letter_issued' => ['nullable'],
            'consent_letter_issued' => ['nullable'],
            'certificate_issued' => ['nullable'],
            'certificate_number' => ['nullable', 'string', 'max:100'],
            'internship_start_date' => ['nullable', 'date'],
            'internship_end_date' => ['nullable', 'date'],
            'lor_issued' => ['nullable'],
            'lor_number' => ['nullable', 'string', 'max:100'],
        ]);

        if ($user) {
            $userData = [
                'name' => trim($validated['name']),
                'email' => strtolower(trim($validated['email'])),
                'phone' => trim($validated['phone']),
            ];
            if (! empty($validated['new_password'])) {
                $userData['password'] = Hash::make(trim($validated['new_password']));
            }
            $user->update($userData);
        }

        $profile->update([
            'college' => trim($validated['college']),
            'degree' => $validated['degree'],
            'semester' => $validated['semester'],
            'gender' => $request->filled('gender') ? trim($request->gender) : null,
            'father_name' => $request->filled('father_name') ? trim($request->father_name) : null,
            'university_reg_no' => $request->filled('university_reg_no') ? trim($request->university_reg_no) : null,
            'university_roll_no' => $request->filled('university_roll_no') ? trim($request->university_roll_no) : null,
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
            'internship_start_date' => $request->filled('internship_start_date') ? $request->internship_start_date : $profile->internship_start_date,
            'internship_end_date' => $request->filled('internship_end_date') ? $request->internship_end_date : $profile->internship_end_date,
            'lor_issued' => $request->has('lor_issued'),
            'lor_number' => $request->filled('lor_number') ? trim($request->lor_number) : ($profile->lor_number ?? 'INF-LOR-2026-'.rand(1000, 9999)),
            'lor_date' => $request->has('lor_issued') ? ($profile->lor_date ?? now()) : null,
        ]);

        $redirect = back()->with('success', "Candidate profile & document records updated successfully for {$profile->application_number}!");
        if (! empty($validated['new_password']) && $user) {
            $redirect->with('created_student_credentials', [
                'name' => $user->name,
                'email' => $user->email,
                'password' => trim($validated['new_password']),
                'phone' => $user->phone,
                'app_number' => $profile->application_number,
                'degree' => $profile->degree,
                'domain' => $profile->program_domain,
            ]);
        }

        return $redirect;
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
            'password' => ['nullable', 'string', 'min:6'],
            'college' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:50'],
            'semester' => ['required', 'string', 'max:50'],
            'gender' => ['nullable', 'string', 'max:50'],
            'father_name' => ['nullable', 'string', 'max:255'],
            'university_reg_no' => ['nullable', 'string', 'max:100'],
            'university_roll_no' => ['nullable', 'string', 'max:100'],
            'program_domain' => ['required', 'string', 'max:255'],
            'mentor_name' => ['nullable', 'string', 'max:255'],
            'project_title' => ['nullable', 'string', 'max:255'],
            'attendance_rate' => ['nullable', 'integer', 'min:0', 'max:100'],
            'status' => ['required', 'string', 'in:PENDING,APPROVED,ACTIVE,COMPLETED'],
            'internship_start_date' => ['nullable', 'date'],
            'internship_end_date' => ['nullable', 'date'],
        ]);

        $plainPassword = ! empty($validated['password']) ? trim($validated['password']) : 'Student@123';

        $user = User::where('email', strtolower(trim($validated['email'])))->first();
        if ($user) {
            $user->update([
                'name' => trim($validated['name']),
                'phone' => trim($validated['phone']),
                'password' => Hash::make($plainPassword),
            ]);
        } else {
            $user = User::create([
                'name' => trim($validated['name']),
                'email' => strtolower(trim($validated['email'])),
                'phone' => trim($validated['phone']),
                'password' => Hash::make($plainPassword),
                'role' => 'STUDENT',
            ]);
        }

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
            'gender' => $request->filled('gender') ? trim($request->gender) : null,
            'father_name' => $request->filled('father_name') ? trim($request->father_name) : null,
            'university_reg_no' => $request->filled('university_reg_no') ? trim($request->university_reg_no) : null,
            'university_roll_no' => $request->filled('university_roll_no') ? trim($request->university_roll_no) : null,
            'program_domain' => $validated['program_domain'],
            'mentor_name' => ! empty($validated['mentor_name']) ? $validated['mentor_name'] : 'Faculty Advisory Board',
            'project_title' => ! empty($validated['project_title']) ? $validated['project_title'] : 'Capstone Research Evaluation',
            'attendance_rate' => $validated['attendance_rate'] ?? 85,
            'status' => $validated['status'],
            'internship_start_date' => $request->filled('internship_start_date') ? $request->internship_start_date : null,
            'internship_end_date' => $request->filled('internship_end_date') ? $request->internship_end_date : null,
            'offer_letter_issued' => in_array($validated['status'], ['APPROVED', 'ACTIVE', 'COMPLETED']),
            'offer_letter_date' => in_array($validated['status'], ['APPROVED', 'ACTIVE', 'COMPLETED']) ? now() : null,
            'consent_letter_issued' => in_array($validated['status'], ['ACTIVE', 'COMPLETED']),
            'consent_letter_date' => in_array($validated['status'], ['ACTIVE', 'COMPLETED']) ? now() : null,
        ]);

        return back()
            ->with('success', "New student applicant {$user->name} ({$appNumber}) enrolled successfully with login access!")
            ->with('created_student_credentials', [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $plainPassword,
                'phone' => $user->phone,
                'app_number' => $appNumber,
                'degree' => $validated['degree'],
                'domain' => $validated['program_domain'],
            ]);
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
        $settings = OfferLetterSetting::current();

        return view('documents.offer-letter', compact('user', 'profile', 'settings'));
    }

    /**
     * View Student Consent Letter
     */
    public function viewStudentConsentLetter($id)
    {
        $profile = StudentProfile::with('user')->findOrFail($id);
        $user = $profile->user;
        $settings = ConsentLetterSetting::current();

        return view('documents.consent-letter', compact('user', 'profile', 'settings'));
    }

    /**
     * View Student Certificate
     */
    public function viewStudentCertificate($id)
    {
        $profile = StudentProfile::with('user')->findOrFail($id);
        $user = $profile->user;
        $settings = CertificateSetting::current();

        return view('documents.certificate', compact('user', 'profile', 'settings'));
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
            'internship_start_date' => ['nullable', 'date'],
            'internship_end_date' => ['nullable', 'date'],
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
                'internship_start_date' => $request->filled('internship_start_date') ? $request->internship_start_date : $profile->internship_start_date,
                'internship_end_date' => $request->filled('internship_end_date') ? $request->internship_end_date : $profile->internship_end_date,
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
            'internship_start_date' => $request->filled('internship_start_date') ? $request->internship_start_date : now()->subDays(45)->format('Y-m-d'),
            'internship_end_date' => $request->filled('internship_end_date') ? $request->internship_end_date : $validated['certificate_date'],
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

    /**
     * Offer Letter Settings Dashboard
     */
    public function offerLetterSettings()
    {
        $settings = OfferLetterSetting::current();
        $sampleProfile = StudentProfile::with('user')->where('offer_letter_issued', true)->latest()->first()
            ?? StudentProfile::with('user')->latest()->first();

        return view('admin.offer-letter-settings', compact('settings', 'sampleProfile'));
    }

    /**
     * Update Offer Letter Settings & Upload Media (Signature, Stamp/Seal, Logo)
     */
    public function updateOfferLetterSettings(Request $request)
    {
        $settings = OfferLetterSetting::current();

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_subtitle' => 'nullable|string|max:255',
            'cin_number' => 'nullable|string|max:100',
            'address' => 'required|string|max:500',
            'email' => 'required|email|max:255',
            'website' => 'required|string|max:255',
            'letter_title' => 'required|string|max:255',
            'ref_prefix' => 'required|string|max:50',
            'default_role' => 'nullable|string|max:255',
            'default_department' => 'nullable|string|max:255',
            'default_location' => 'required|string|max:255',
            'default_duration' => 'required|string|max:255',
            'default_stipend' => 'required|string|max:255',
            'default_reporting_manager' => 'required|string|max:255',
            'default_mode' => 'required|string|max:100',
            'acceptance_days' => 'required|integer|min:1|max:90',
            'intro_text' => 'nullable|string',
            'terms_text' => 'nullable|string',
            'closing_text' => 'nullable|string',
            'signatory_name' => 'required|string|max:255',
            'signatory_designation' => 'required|string|max:255',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:3072',
            'seal' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:3072',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:3072',
        ]);

        $destinationPath = public_path('uploads/offer-letter');
        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        if ($request->hasFile('signature')) {
            $file = $request->file('signature');
            $fileName = 'signature_'.time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $validated['signature_path'] = 'uploads/offer-letter/'.$fileName;
        }

        if ($request->hasFile('seal')) {
            $file = $request->file('seal');
            $fileName = 'seal_'.time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $validated['seal_path'] = 'uploads/offer-letter/'.$fileName;
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = 'logo_'.time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $validated['logo_path'] = 'uploads/offer-letter/'.$fileName;
        }

        $settings->update($validated);

        return back()->with('success', 'Offer Letter settings and headers updated successfully!');
    }

    /**
     * Remove an uploaded image (signature, seal, or logo)
     */
    public function removeOfferLetterImage(Request $request)
    {
        $type = $request->input('type');
        $settings = OfferLetterSetting::current();

        if ($type === 'signature') {
            if ($settings->signature_path && file_exists(public_path($settings->signature_path))) {
                @unlink(public_path($settings->signature_path));
            }
            $settings->update(['signature_path' => null]);

            return back()->with('success', 'Official signature image removed.');
        }

        if ($type === 'seal') {
            if ($settings->seal_path && file_exists(public_path($settings->seal_path))) {
                @unlink(public_path($settings->seal_path));
            }
            $settings->update(['seal_path' => null]);

            return back()->with('success', 'Official seal stamp image removed.');
        }

        if ($type === 'logo') {
            if ($settings->logo_path && file_exists(public_path($settings->logo_path))) {
                @unlink(public_path($settings->logo_path));
            }
            $settings->update(['logo_path' => null]);

            return back()->with('success', 'Custom logo removed (restored default logo).');
        }

        return back()->with('error', 'Invalid media removal request.');
    }

    /**
     * Reset settings back to sample template defaults
     */
    public function resetOfferLetterSettings()
    {
        $settings = OfferLetterSetting::current();
        $settings->update([
            'company_name' => 'INFINITY INTERNS',
            'company_subtitle' => 'A unit of Infinitya1 Career Counselling private limited',
            'cin_number' => 'U85500BR2025PTC075319',
            'address' => 'B-hub Maurya Lok Complex, Patna, Bihar – 800001',
            'email' => 'info@infinityinterns.com',
            'website' => 'www.infinityinterns.com',
            'letter_title' => 'INTERNSHIP OFFER LETTER',
            'ref_prefix' => 'II/OL/',
            'default_role' => 'Financial Management Intern',
            'default_department' => 'Marketing & Finance',
            'default_location' => 'ON-OFFICE',
            'default_duration' => '06 June 2026 to 21 July 2026',
            'default_stipend' => 'Rs 5000',
            'default_reporting_manager' => 'Aryav Singh Vishal',
            'default_mode' => 'Office',
            'acceptance_days' => 5,
            'intro_text' => null,
            'terms_text' => null,
            'closing_text' => null,
            'signatory_name' => 'Aryav Singh Vishal',
            'signatory_designation' => 'Authorized Signatory',
        ]);

        return back()->with('success', 'Offer letter settings reset to sample template defaults!');
    }

    /**
     * Consent Letter Settings Dashboard
     */
    public function consentLetterSettings()
    {
        $settings = ConsentLetterSetting::current();
        $sampleProfile = StudentProfile::with('user')->where('consent_letter_issued', true)->latest()->first()
            ?? StudentProfile::with('user')->latest()->first();

        return view('admin.consent-letter-settings', compact('settings', 'sampleProfile'));
    }

    /**
     * Update Consent Letter Settings & Media (Stamp, Signature)
     */
    public function updateConsentLetterSettings(Request $request)
    {
        $settings = ConsentLetterSetting::current();

        $validated = $request->validate([
            'default_college' => 'required|string|max:255',
            'annexure_text' => 'required|string|max:100',
            'letter_title' => 'required|string|max:255',
            'letter_subject' => 'required|string|max:255',
            'letter_no_prefix' => 'required|string|max:50',
            'credits_text' => 'required|string|max:255',
            'intro_text' => 'nullable|string',
            'authority_designation' => 'required|string|max:255',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:3072',
            'seal' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:3072',
        ]);

        $validated['show_signature_line'] = $request->has('show_signature_line');

        $destinationPath = public_path('uploads/consent-letter');
        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        if ($request->hasFile('signature')) {
            $file = $request->file('signature');
            $fileName = 'signature_'.time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $validated['signature_path'] = 'uploads/consent-letter/'.$fileName;
        }

        if ($request->hasFile('seal')) {
            $file = $request->file('seal');
            $fileName = 'seal_'.time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $validated['seal_path'] = 'uploads/consent-letter/'.$fileName;
        }

        $settings->update($validated);

        return back()->with('success', 'Consent Letter template settings updated successfully!');
    }

    /**
     * Remove an uploaded image (signature or seal)
     */
    public function removeConsentLetterImage(Request $request)
    {
        $type = $request->input('type');
        $settings = ConsentLetterSetting::current();

        if ($type === 'signature') {
            if ($settings->signature_path && file_exists(public_path($settings->signature_path))) {
                @unlink(public_path($settings->signature_path));
            }
            $settings->update(['signature_path' => null]);

            return back()->with('success', 'Authority signature image removed.');
        }

        if ($type === 'seal') {
            if ($settings->seal_path && file_exists(public_path($settings->seal_path))) {
                @unlink(public_path($settings->seal_path));
            }
            $settings->update(['seal_path' => null]);

            return back()->with('success', 'Official seal stamp image removed.');
        }

        return back()->with('error', 'Invalid media removal request.');
    }

    /**
     * Reset Consent Letter settings back to reference sample defaults
     */
    public function resetConsentLetterSettings()
    {
        $settings = ConsentLetterSetting::current();
        $settings->update([
            'default_college' => 'GAYA COLLEGE, GAYA.',
            'annexure_text' => 'ANNEXURE I',
            'letter_title' => 'CONSENT LETTER',
            'letter_subject' => 'TO WHOM IT MAY CONCERN',
            'letter_no_prefix' => 'GC/CL/',
            'credits_text' => 'minimum 04 credits (120 hrs)',
            'intro_text' => 'As part of the curriculum of CBCS UG the students are required to undertake internship of minimum 04 credits (120 hrs) in an organization. In this regard, I am introducing the below mentioned student with the following details for the purpose of internship:',
            'authority_designation' => 'Signature of HOD / Principal with Seal',
            'show_signature_line' => true,
        ]);

        return back()->with('success', 'Consent letter settings reset to sample template defaults!');
    }

    /**
     * Certificate Template Settings Page
     */
    public function certificateSettings()
    {
        $settings = CertificateSetting::current();

        // Sample student profile for live preview
        $sampleProfile = StudentProfile::with('user')->whereNotNull('certificate_number')->first()
            ?? StudentProfile::with('user')->first();

        $sampleUser = $sampleProfile?->user ?? auth()->user();

        return view('admin.certificate-settings', compact('settings', 'sampleProfile', 'sampleUser'));
    }

    /**
     * Update Certificate Settings
     */
    public function updateCertificateSettings(Request $request)
    {
        $settings = CertificateSetting::current();

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'director_name' => 'required|string|max:255',
            'director_title' => 'required|string|max:255',
            'company_unit' => 'required|string|max:255',
            'default_mode' => 'required|string|max:50',
            'default_duration' => 'required|string|max:50',
            'website_url' => 'required|url|max:255',
            'stamp_signature' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:3072',
            'msme_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:3072',
            'aicte_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:3072',
        ]);

        $destinationPath = public_path('uploads/certificate');
        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        if ($request->hasFile('stamp_signature')) {
            $file = $request->file('stamp_signature');
            $fileName = 'stamp_'.time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $validated['stamp_signature_path'] = 'uploads/certificate/'.$fileName;
        }

        if ($request->hasFile('msme_logo')) {
            $file = $request->file('msme_logo');
            $fileName = 'msme_'.time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $validated['msme_logo_path'] = 'uploads/certificate/'.$fileName;
        }

        if ($request->hasFile('aicte_logo')) {
            $file = $request->file('aicte_logo');
            $fileName = 'aicte_'.time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $validated['aicte_logo_path'] = 'uploads/certificate/'.$fileName;
        }

        $settings->update($validated);

        return back()->with('success', 'Certificate template settings updated successfully!');
    }

    /**
     * Remove an uploaded certificate image
     */
    public function removeCertificateImage(Request $request)
    {
        $type = $request->input('type');
        $settings = CertificateSetting::current();

        if ($type === 'stamp_signature') {
            if ($settings->stamp_signature_path && file_exists(public_path($settings->stamp_signature_path)) && str_starts_with($settings->stamp_signature_path, 'uploads/')) {
                @unlink(public_path($settings->stamp_signature_path));
            }
            $settings->update(['stamp_signature_path' => '/images/certificate/stamp_signature.png']);

            return back()->with('success', 'Custom stamp & signature restored to default reference.');
        }

        if ($type === 'msme_logo') {
            if ($settings->msme_logo_path && file_exists(public_path($settings->msme_logo_path)) && str_starts_with($settings->msme_logo_path, 'uploads/')) {
                @unlink(public_path($settings->msme_logo_path));
            }
            $settings->update(['msme_logo_path' => '/images/certificate/msme_logo.png']);

            return back()->with('success', 'MSME logo restored to default reference.');
        }

        if ($type === 'aicte_logo') {
            if ($settings->aicte_logo_path && file_exists(public_path($settings->aicte_logo_path)) && str_starts_with($settings->aicte_logo_path, 'uploads/')) {
                @unlink(public_path($settings->aicte_logo_path));
            }
            $settings->update(['aicte_logo_path' => '/images/certificate/aicte_logo.png']);

            return back()->with('success', 'AICTE logo restored to default reference.');
        }

        return back()->with('error', 'Invalid media removal request.');
    }

    /**
     * Reset Certificate settings back to reference sample defaults
     */
    public function resetCertificateSettings()
    {
        $settings = CertificateSetting::current();
        $settings->update([
            'company_name' => 'INFINITY INTERNS',
            'tagline' => 'LEARN • GROW • SUCCEED',
            'title' => 'CERTIFICATE OF COMPLETION',
            'director_name' => 'Rahul Kumar',
            'director_title' => 'Director, Infinity Interns',
            'company_unit' => 'Infinity A1 Career Counselling Pvt. Ltd.',
            'stamp_signature_path' => '/images/certificate/stamp_signature.png',
            'msme_logo_path' => '/images/certificate/msme_logo.png',
            'aicte_logo_path' => '/images/certificate/aicte_logo.png',
            'default_mode' => 'Offline',
            'default_duration' => '45 Days',
            'website_url' => 'https://infinityinterns.com/',
        ]);

        return back()->with('success', 'Certificate template settings reset to exact sample defaults!');
    }
}
