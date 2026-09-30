<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Main Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@infinityinterns.com'],
            [
                'name' => 'Chief Academic Administrator',
                'phone' => '+91 6204141971',
                'password' => Hash::make('Admin@123'),
                'role' => 'ADMIN',
            ]
        );

        // 2. Seed Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@infinityinterns.com'],
            [
                'name' => 'Master Portal Controller',
                'phone' => '+91 6204221832',
                'password' => Hash::make('SuperAdmin@123'),
                'role' => 'SUPER_ADMIN',
            ]
        );

        // 3. Seed Sample Students with Profiles
        $students = [
            [
                'name' => 'Ritika Srivastava',
                'email' => 'ritika.s@example.com',
                'phone' => '+91 9876543211',
                'password' => Hash::make('Student@123'),
                'degree' => 'BA',
                'college' => 'Magadh Mahila College, Patna',
                'semester' => '5th Semester',
                'program_domain' => 'Arts, Social Science & Communication',
                'status' => 'APPROVED',
                'application_number' => 'INF-2026-1024',
                'offer_letter_issued' => true,
                'offer_letter_date' => now()->subDays(15),
                'certificate_issued' => false,
                'certificate_number' => null,
                'certificate_date' => null,
                'marksheet_issued' => false,
                'marksheet_grade' => null,
                'marksheet_marks' => null,
                'marksheet_date' => null,
                'attendance_rate' => 96,
                'mentor_name' => 'Rajeshwar Kumar (Policy Specialist)',
                'project_title' => 'Rural Educational Scheme Implementation in Bihar',
            ],
            [
                'name' => 'Aditya Raj',
                'email' => 'aditya.raj@example.com',
                'phone' => '+91 9876543212',
                'password' => Hash::make('Student@123'),
                'degree' => 'BSc',
                'college' => 'Patna Science College, Patna University',
                'semester' => '6th Semester',
                'program_domain' => 'Science, Environment & Data Skills',
                'status' => 'COMPLETED',
                'application_number' => 'INF-2026-2048',
                'offer_letter_issued' => true,
                'offer_letter_date' => now()->subDays(45),
                'certificate_issued' => true,
                'certificate_number' => 'UGC-INF-892144',
                'certificate_date' => now()->subDays(3),
                'marksheet_issued' => true,
                'marksheet_grade' => 'A+',
                'marksheet_marks' => 92,
                'marksheet_date' => now()->subDays(3),
                'attendance_rate' => 98,
                'mentor_name' => 'Dr. Alok Verma (Academic Board)',
                'project_title' => 'GIS Environmental Impact Assessment of Gangetic Belt',
            ],
            [
                'name' => 'Mohit Sharma',
                'email' => 'mohit.sharma@example.com',
                'phone' => '+91 9876543213',
                'password' => Hash::make('Student@123'),
                'degree' => 'BBA',
                'college' => 'College of Commerce, Arts & Science, Patna',
                'semester' => '4th Semester',
                'program_domain' => 'Business, Finance & Entrepreneurship',
                'status' => 'ACTIVE',
                'application_number' => 'INF-2026-3091',
                'offer_letter_issued' => true,
                'offer_letter_date' => now()->subDays(20),
                'certificate_issued' => false,
                'certificate_number' => null,
                'certificate_date' => null,
                'marksheet_issued' => false,
                'marksheet_grade' => null,
                'marksheet_marks' => null,
                'marksheet_date' => null,
                'attendance_rate' => 94,
                'mentor_name' => 'Ananya Roy, CFA (Finance Lead)',
                'project_title' => 'SME Working Capital and Cash Flow Forecasting Model',
            ],
            [
                'name' => 'Kavita Kumari',
                'email' => 'kavita.k@example.com',
                'phone' => '+91 9876543214',
                'password' => Hash::make('Student@123'),
                'degree' => 'BCA',
                'college' => 'A.N. College, Patna',
                'semester' => '5th Semester',
                'program_domain' => 'Technology, Digital & Web Skills',
                'status' => 'COMPLETED',
                'application_number' => 'INF-2026-4105',
                'offer_letter_issued' => true,
                'offer_letter_date' => now()->subDays(50),
                'certificate_issued' => true,
                'certificate_number' => 'UGC-INF-771239',
                'certificate_date' => now()->subDays(5),
                'marksheet_issued' => true,
                'marksheet_grade' => 'A+',
                'marksheet_marks' => 95,
                'marksheet_date' => now()->subDays(5),
                'attendance_rate' => 100,
                'mentor_name' => 'Priyanka Sen (Tech Lead)',
                'project_title' => 'Full-Stack Student Credential Portal on Modern Web Stack',
            ],
            [
                'name' => 'Rahul Verma',
                'email' => 'rahul.v@example.com',
                'phone' => '+91 9876543215',
                'password' => Hash::make('Student@123'),
                'degree' => 'BCom',
                'college' => 'Patna College',
                'semester' => '3rd Semester',
                'program_domain' => 'Business, Finance & Entrepreneurship',
                'status' => 'PENDING',
                'application_number' => 'INF-2026-5219',
                'offer_letter_issued' => false,
                'offer_letter_date' => null,
                'certificate_issued' => false,
                'certificate_number' => null,
                'certificate_date' => null,
                'marksheet_issued' => false,
                'marksheet_grade' => null,
                'marksheet_marks' => null,
                'marksheet_date' => null,
                'attendance_rate' => 90,
                'mentor_name' => 'Faculty Advisory Board',
                'project_title' => 'Corporate Accounting & GST Audit Protocols',
            ],
        ];

        foreach ($students as $stu) {
            $user = User::firstOrCreate(
                ['email' => $stu['email']],
                [
                    'name' => $stu['name'],
                    'phone' => $stu['phone'],
                    'password' => $stu['password'],
                    'role' => 'STUDENT',
                ]
            );

            StudentProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'application_number' => $stu['application_number'],
                    'degree' => $stu['degree'],
                    'college' => $stu['college'],
                    'semester' => $stu['semester'],
                    'program_domain' => $stu['program_domain'],
                    'status' => $stu['status'],
                    'offer_letter_issued' => $stu['offer_letter_issued'],
                    'offer_letter_date' => $stu['offer_letter_date'],
                    'certificate_issued' => $stu['certificate_issued'],
                    'certificate_number' => $stu['certificate_number'],
                    'certificate_date' => $stu['certificate_date'],
                    'marksheet_issued' => $stu['marksheet_issued'],
                    'marksheet_grade' => $stu['marksheet_grade'],
                    'marksheet_marks' => $stu['marksheet_marks'],
                    'marksheet_date' => $stu['marksheet_date'],
                    'attendance_rate' => $stu['attendance_rate'],
                    'mentor_name' => $stu['mentor_name'],
                    'project_title' => $stu['project_title'],
                ]
            );
        }

        // 4. Seed College Inquiries
        Inquiry::create([
            'type' => 'COLLEGE',
            'name' => 'Dr. K. N. Sinha',
            'email' => 'dean.academics@magadhuniversity.ac.in',
            'phone' => '+91 9431002233',
            'institution_name' => 'Magadh University Affiliated Colleges Directorate',
            'coordinator_name' => 'Dr. K. N. Sinha',
            'designation' => 'Dean, College Development Council',
            'city' => 'Bodh Gaya, Bihar',
            'student_count' => '250+',
            'message' => 'Requesting proposal for university-wide MOU for 500+ undergraduate BA and BSc 5th-semester students requiring NEP-2020 internship credits.',
            'status' => 'NEW',
        ]);

        Inquiry::create([
            'type' => 'STUDENT',
            'name' => 'Pooja Pandey',
            'email' => 'pooja.pandey@gmail.com',
            'phone' => '+91 9123456780',
            'degree' => 'BSc',
            'college' => 'Patna Science College',
            'message' => 'Can I choose the Environmental Data track along with Chemistry honours? Please confirm batch timings.',
            'status' => 'NEW',
        ]);
    }
}
