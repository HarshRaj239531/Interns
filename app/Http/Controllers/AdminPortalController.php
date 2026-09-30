<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\StudentProfile;
use Illuminate\Http\Request;

class AdminPortalController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = StudentProfile::with('user');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('degree') && $request->degree !== 'all') {
            $query->where('degree', $request->degree);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('application_number', 'like', "%{$search}%")
                    ->orWhere('college', 'like', "%{$search}%")
                    ->orWhere('program_domain', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    });
            });
        }

        $applications = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => StudentProfile::count(),
            'pending' => StudentProfile::where('status', 'PENDING')->count(),
            'approved' => StudentProfile::where('status', 'APPROVED')->count(),
            'active' => StudentProfile::where('status', 'ACTIVE')->count(),
            'completed' => StudentProfile::where('status', 'COMPLETED')->count(),
            'certificates_issued' => StudentProfile::where('certificate_issued', true)->count(),
            'total_inquiries' => Inquiry::count(),
            'new_inquiries' => Inquiry::where('status', 'NEW')->count(),
        ];

        return view('admin.dashboard', compact('applications', 'stats'));
    }

    public function updateStatus($id, Request $request)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:PENDING,APPROVED,ACTIVE,COMPLETED,REJECTED'],
        ]);

        $profile = StudentProfile::findOrFail($id);
        $profile->update(['status' => $validated['status']]);

        return back()->with('success', "Application {$profile->application_number} status changed to {$validated['status']}");
    }

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

        $profile->update([
            'certificate_issued' => true,
            'certificate_number' => $certNumber,
            'certificate_date' => now(),
            'status' => 'COMPLETED',
        ]);

        return back()->with('success', "UGC Certificate {$certNumber} issued successfully!");
    }

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

    public function inquiries(Request $request)
    {
        $inquiries = Inquiry::latest()->paginate(20);

        return view('admin.inquiries', compact('inquiries'));
    }

    public function updateInquiryStatus($id, Request $request)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->update([
            'status' => $request->input('status', 'REVIEWED'),
        ]);

        return back()->with('success', 'Inquiry marked as '.$inquiry->status);
    }

    public function viewStudentOfferLetter($id)
    {
        $profile = StudentProfile::with('user')->findOrFail($id);
        $user = $profile->user;

        return view('documents.offer-letter', compact('user', 'profile'));
    }

    public function viewStudentCertificate($id)
    {
        $profile = StudentProfile::with('user')->findOrFail($id);
        $user = $profile->user;

        return view('documents.certificate', compact('user', 'profile'));
    }

    public function viewStudentMarksheet($id)
    {
        $profile = StudentProfile::with('user')->findOrFail($id);
        $user = $profile->user;

        return view('documents.marksheet', compact('user', 'profile'));
    }
}
