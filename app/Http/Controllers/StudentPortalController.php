<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPortalController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $profile = $user->studentProfile;

        if (! $profile) {
            return redirect()->route('home')->with('error', 'Student profile record not found.');
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

    public function viewCertificate()
    {
        $user = Auth::user();
        $profile = $user->studentProfile;

        if (! $profile || ! $profile->certificate_issued) {
            return back()->with('error', 'Completion certificate has not been generated yet.');
        }

        return view('documents.certificate', compact('user', 'profile'));
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
