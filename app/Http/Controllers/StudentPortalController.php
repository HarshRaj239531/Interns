<?php

namespace App\Http\Controllers;

use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPortalController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $profile = $user->studentProfile;

        if (! $profile) {
            $appNumber = 'INF-2026-'.rand(1000, 9999);
            while (StudentProfile::where('application_number', $appNumber)->exists()) {
                $appNumber = 'INF-2026-'.rand(1000, 9999);
            }

            $profile = StudentProfile::create([
                'user_id' => $user->id,
                'application_number' => $appNumber,
                'degree' => 'BSc',
                'college' => 'Patna Science College, Patna University',
                'semester' => '5th Semester',
                'program_domain' => 'Technology, Digital & Web Skills',
                'mentor_name' => 'Faculty Advisory Board',
                'project_title' => 'Undergraduate Capstone Evaluation',
                'attendance_rate' => 85,
                'status' => 'PENDING',
            ]);
        }

        return view('student.dashboard', compact('user', 'profile'));
    }

    public function updateProject(Request $request)
    {
        $validated = $request->validate([
            'project_title' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        $profile = $user->studentProfile;

        if ($profile) {
            $profile->update([
                'project_title' => trim($validated['project_title']),
            ]);
        }

        return back()->with('success', 'Capstone project title updated successfully!');
    }

    public function viewOfferLetter()
    {
        $user = Auth::user();
        $profile = $user->studentProfile;

        if (! $profile || ! $profile->offer_letter_issued) {
            return back()->with('error', 'Offer letter has not been released yet for this application.');
        }

        return view('documents.offer-letter', compact('user', 'profile'));
    }

    public function viewConsentLetter()
    {
        $user = Auth::user();
        $profile = $user->studentProfile;

        if (! $profile || ! $profile->consent_letter_issued) {
            return back()->with('error', 'Consent letter is not released for this application.');
        }

        return view('documents.consent-letter', compact('user', 'profile'));
    }

    public function viewCertificate()
    {
        $user = Auth::user();
        $profile = $user->studentProfile;

        if (! $profile || ! $profile->certificate_issued) {
            return back()->with('error', 'Completion certificate has not been generated yet.');
        }

        return view('documents.certificate', compact('user', 'profile'));
    }

    public function viewLor()
    {
        $user = Auth::user();
        $profile = $user->studentProfile;

        if (! $profile || ! $profile->lor_issued) {
            return back()->with('error', 'Letter of Recommendation has not been released yet.');
        }

        return view('documents.lor', compact('user', 'profile'));
    }

    public function viewMarksheet()
    {
        $user = Auth::user();
        $profile = $user->studentProfile;

        if (! $profile || ! $profile->marksheet_issued) {
            return back()->with('error', 'Academic marksheet has not been generated yet.');
        }

        return view('documents.marksheet', compact('user', 'profile'));
    }
}
