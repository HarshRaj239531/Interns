<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use App\Models\InternshipStream;
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

        // 2. Seed Default Internship Streams
        $streams = [
            [
                'title' => 'Technology, Digital & Web Skills',
                'code' => 'TECH-WEB',
                'category' => 'TECHNOLOGY',
                'duration' => '8 Weeks (120 Contact Hours)',
                'credits' => '4.0 NHEQF Credits',
                'description' => 'Hands-on full stack application architecture, cloud infrastructure, REST API design, and practical industry workflows.',
                'is_active' => true,
            ],
            [
                'title' => 'AI, Machine Learning & Data Science',
                'code' => 'AI-DATA',
                'category' => 'TECHNOLOGY',
                'duration' => '8 Weeks (120 Contact Hours)',
                'credits' => '4.0 NHEQF Credits',
                'description' => 'Applied Python for data analytics, machine learning pipelines, predictive modeling, and business intelligence dashboards.',
                'is_active' => true,
            ],
            [
                'title' => 'Business, Finance & Entrepreneurship',
                'code' => 'BIZ-FIN',
                'category' => 'BUSINESS',
                'duration' => '8 Weeks (120 Contact Hours)',
                'credits' => '4.0 NHEQF Credits',
                'description' => 'Financial modeling, market research, SME working capital management, corporate communication, and startup venture planning.',
                'is_active' => true,
            ],
            [
                'title' => 'Science, Environment & Data Skills',
                'code' => 'SCI-ENV',
                'category' => 'SCIENCE',
                'duration' => '8 Weeks (120 Contact Hours)',
                'credits' => '4.0 NHEQF Credits',
                'description' => 'Ecological data sampling, statistical computing in R/Python, GIS mapping, sustainability metrics, and scientific reporting.',
                'is_active' => true,
            ],
            [
                'title' => 'Arts, Social Science & Communication',
                'code' => 'ARTS-COMM',
                'category' => 'ARTS',
                'duration' => '8 Weeks (120 Contact Hours)',
                'credits' => '4.0 NHEQF Credits',
                'description' => 'Public policy documentation, content strategy, digital journalism, community outreach analysis, and organizational writing.',
                'is_active' => true,
            ],
            [
                'title' => 'Digital Marketing & Growth Analytics',
                'code' => 'DIGI-MKT',
                'category' => 'BUSINESS',
                'duration' => '8 Weeks (120 Contact Hours)',
                'credits' => '4.0 NHEQF Credits',
                'description' => 'Performance marketing, search engine optimization (SEO), conversion tracking, social branding, and ROI analytics.',
                'is_active' => true,
            ],
        ];

        foreach ($streams as $s) {
            InternshipStream::firstOrCreate(['code' => $s['code']], $s);
        }

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
                'consent_letter_issued' => true,
                'consent_letter_date' => now()->subDays(15),
                'certificate_issued' => false,
                'certificate_number' => null,
                'certificate_date' => null,
                'lor_issued' => false,
                'lor_number' => null,
                'lor_date' => null,
                'lor_remarks' => null,
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
                'consent_letter_issued' => true,
                'consent_letter_date' => now()->subDays(45),
                'certificate_issued' => true,
                'certificate_number' => 'UGC-INF-892144',
                'certificate_date' => now()->subDays(3),
                'lor_issued' => true,
                'lor_number' => 'INF-LOR-2026-8921',
                'lor_date' => now()->subDays(3),
                'lor_remarks' => 'Aditya displayed exemplary research depth, punctuality, and technical problem-solving during his domain capstone evaluation.',
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
                'consent_letter_issued' => true,
                'consent_letter_date' => now()->subDays(20),
                'certificate_issued' => false,
                'certificate_number' => null,
                'certificate_date' => null,
                'lor_issued' => false,
                'lor_number' => null,
                'lor_date' => null,
                'lor_remarks' => null,
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
                'consent_letter_issued' => true,
                'consent_letter_date' => now()->subDays(50),
                'certificate_issued' => true,
                'certificate_number' => 'UGC-INF-771239',
                'certificate_date' => now()->subDays(5),
                'lor_issued' => true,
                'lor_number' => 'INF-LOR-2026-7712',
                'lor_date' => now()->subDays(5),
                'lor_remarks' => 'Kavita demonstrated outstanding software engineering skills, architectural clarity, and strong dedication throughout the internship.',
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
                'offer_letter_issued' => true,
                'offer_letter_date' => now()->subDays(2),
                'consent_letter_issued' => true,
                'consent_letter_date' => now()->subDays(2),
                'certificate_issued' => false,
                'certificate_number' => null,
                'certificate_date' => null,
                'lor_issued' => false,
                'lor_number' => null,
                'lor_date' => null,
                'lor_remarks' => null,
                'marksheet_issued' => false,
                'marksheet_grade' => null,
                'marksheet_marks' => null,
                'marksheet_date' => null,
                'attendance_rate' => 90,
                'mentor_name' => 'Faculty Advisory Board',
                'project_title' => 'Corporate Accounting and Tax Analysis Capstone',
            ],
        ];

        foreach ($students as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'password' => $data['password'],
                    'role' => 'STUDENT',
                ]
            );

            StudentProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'application_number' => $data['application_number'],
                    'degree' => $data['degree'],
                    'college' => $data['college'],
                    'semester' => $data['semester'],
                    'program_domain' => $data['program_domain'],
                    'status' => $data['status'],
                    'offer_letter_issued' => $data['offer_letter_issued'],
                    'offer_letter_date' => $data['offer_letter_date'],
                    'consent_letter_issued' => $data['consent_letter_issued'],
                    'consent_letter_date' => $data['consent_letter_date'],
                    'certificate_issued' => $data['certificate_issued'],
                    'certificate_number' => $data['certificate_number'],
                    'certificate_date' => $data['certificate_date'],
                    'lor_issued' => $data['lor_issued'],
                    'lor_number' => $data['lor_number'],
                    'lor_date' => $data['lor_date'],
                    'lor_remarks' => $data['lor_remarks'],
                    'marksheet_issued' => $data['marksheet_issued'],
                    'marksheet_grade' => $data['marksheet_grade'],
                    'marksheet_marks' => $data['marksheet_marks'],
                    'marksheet_date' => $data['marksheet_date'],
                    'attendance_rate' => $data['attendance_rate'],
                    'mentor_name' => $data['mentor_name'],
                    'project_title' => $data['project_title'],
                ]
            );
        }

        // 4. Seed Sample Institutional Inquiries
        Inquiry::firstOrCreate(
            ['email' => 'dean.academics@patnauniv.ac.in'],
            [
                'type' => 'COLLEGE',
                'name' => 'Dr. R. K. Mishra',
                'coordinator_name' => 'Dr. R. K. Mishra',
                'institution_name' => 'Patna University Central Directorate',
                'designation' => 'Dean, Faculty of Sciences',
                'phone' => '+91 612 2670123',
                'city' => 'Patna',
                'student_count' => '250-500 students',
                'message' => 'We are reviewing NEP 2020 4-year undergraduate syllabus credit requirements and wish to sign a formal internship partnership for 2026-27.',
                'status' => 'NEW',
            ]
        );

        Inquiry::firstOrCreate(
            ['email' => 'sneha.singh.ug@example.com'],
            [
                'type' => 'STUDENT',
                'name' => 'Sneha Singh',
                'email' => 'sneha.singh.ug@example.com',
                'phone' => '+91 9988776655',
                'degree' => 'BCA',
                'college' => 'St. Xavier\'s College of Management & Technology',
                'message' => 'Requesting confirmation on whether the cloud computing internship marksheet is eligible for credit transfer at St. Xavier\'s.',
                'status' => 'REVIEWED',
            ]
        );
    }
}
