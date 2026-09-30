<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiteController extends Controller
{
    public function home()
    {
        $recentCertificates = StudentProfile::where('certificate_issued', true)
            ->with('user')
            ->latest('certificate_date')
            ->take(4)
            ->get();

        $stats = [
            'total_students' => StudentProfile::count() + 1420,
            'active_interns' => StudentProfile::whereIn('status', ['APPROVED', 'ACTIVE'])->count() + 890,
            'certificates_issued' => StudentProfile::where('certificate_issued', true)->count() + 520,
            'partner_colleges' => 24,
        ];

        return view('site.home', compact('recentCertificates', 'stats'));
    }

    public function programs()
    {
        return view('site.programs');
    }

    public function journey()
    {
        return view('site.journey');
    }

    public function certification()
    {
        return view('site.certification');
    }

    public function subjects()
    {
        return view('site.subjects');
    }

    public function mentors()
    {
        return view('site.mentors');
    }

    public function colleges()
    {
        return view('site.colleges');
    }

    public function stories()
    {
        return view('site.stories');
    }

    public function faq()
    {
        return view('site.faq');
    }

    public function contact()
    {
        return view('site.contact');
    }

    public function verifyCertificate(Request $request, ?string $code = null)
    {
        $searchCode = trim($code ?? $request->input('certificate_number', ''));
        $profile = null;
        $searched = false;

        if (! empty($searchCode)) {
            $searched = true;
            $profile = StudentProfile::where('certificate_number', $searchCode)
                ->where('certificate_issued', true)
                ->with('user')
                ->first();
        }

        return view('site.verify', compact('searchCode', 'profile', 'searched'));
    }

    public function storeContactInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'degree' => ['nullable', 'string', 'max:100'],
            'college' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Inquiry::create([
            'type' => 'STUDENT',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'degree' => $validated['degree'] ?? null,
            'college' => $validated['college'] ?? null,
            'message' => $validated['message'],
            'status' => 'NEW',
        ]);

        return back()->with('success', 'Your inquiry has been submitted! Our student counselor will contact you shortly.');
    }

    public function storeCollegeInquiry(Request $request)
    {
        $validated = $request->validate([
            'institution_name' => ['required', 'string', 'max:255'],
            'coordinator_name' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'student_count' => ['required', 'string', 'max:50'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        Inquiry::create([
            'type' => 'COLLEGE',
            'name' => $validated['coordinator_name'],
            'coordinator_name' => $validated['coordinator_name'],
            'institution_name' => $validated['institution_name'],
            'designation' => $validated['designation'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'city' => $validated['city'],
            'student_count' => $validated['student_count'],
            'message' => $validated['notes'] ?? 'Institutional MOU and partnership proposal request.',
            'status' => 'NEW',
        ]);

        return back()->with('success', 'Thank you! Your institutional partnership request has been recorded. Our Dean & College Coordinator will connect with your office within 24 hours.');
    }

    public function storeApplication(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:6'],
            'degree' => ['required', 'string', 'max:50'],
            'college' => ['required', 'string', 'max:255'],
            'semester' => ['required', 'string', 'max:50'],
            'program_domain' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'phone' => trim($validated['phone']),
            'password' => Hash::make($validated['password']),
            'role' => 'STUDENT',
        ]);

        $randomSuffix = rand(1000, 9999);
        $appNumber = 'INF-2026-'.$randomSuffix;

        // Ensure unique application number
        while (StudentProfile::where('application_number', $appNumber)->exists()) {
            $randomSuffix = rand(1000, 9999);
            $appNumber = 'INF-2026-'.$randomSuffix;
        }

        StudentProfile::create([
            'user_id' => $user->id,
            'application_number' => $appNumber,
            'degree' => $validated['degree'],
            'college' => trim($validated['college']),
            'semester' => $validated['semester'],
            'program_domain' => $validated['program_domain'],
            'status' => 'PENDING',
            'attendance_rate' => 90,
            'mentor_name' => 'Faculty Advisory Board',
            'project_title' => 'Undergraduate Domain Capstone Report',
        ]);

        Auth::login($user);

        return redirect()->route('student.dashboard')->with('success', "Welcome to Infinity Interns! Your application {$appNumber} has been received.");
    }
}
