<?php

namespace Tests\Feature;

use App\Models\Degree;
use App\Models\School;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InfinityInternsTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_public_pages_load_successfully(): void
    {
        $routes = [
            '/',
            '/programs',
            '/journey',
            '/certification',
            '/subjects',
            '/mentors',
            '/colleges',
            '/stories',
            '/faq',
            '/contact',
            '/verify',
            '/login',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
        }
    }

    public function test_public_contact_inquiry_submission(): void
    {
        $response = $this->post(route('inquiry.contact'), [
            'name' => 'Amit Sharma',
            'email' => 'amit@example.com',
            'phone' => '9876543210',
            'degree' => 'BSc',
            'college' => 'Patna Science College',
            'message' => 'I would like to inquire about UGC compliance and semester credit transfer.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('inquiries', [
            'email' => 'amit@example.com',
            'type' => 'STUDENT',
        ]);
    }

    public function test_college_mou_inquiry_submission(): void
    {
        $response = $this->post(route('inquiry.college'), [
            'institution_name' => 'Patna Institute of Technology',
            'coordinator_name' => 'Dr. R. K. Singh',
            'designation' => 'Dean Academics',
            'city' => 'Patna',
            'email' => 'dean@pit.edu.in',
            'phone' => '9988776655',
            'student_count' => '100-250',
            'notes' => 'We are interested in executing a formal MOU for the 2026 undergraduate batch.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('inquiries', [
            'email' => 'dean@pit.edu.in',
            'type' => 'COLLEGE',
        ]);
    }

    public function test_student_application_submission_creates_user_and_profile(): void
    {
        $response = $this->post(route('apply'), [
            'name' => 'Deepak Verma',
            'email' => 'deepak@example.com',
            'phone' => '9123456780',
            'password' => 'Student@123',
            'degree' => 'BCA',
            'college' => 'National Institute of Technology Patna',
            'semester' => '5th Semester',
            'program_domain' => 'Technology, Digital & Web Skills',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('users', [
            'email' => 'deepak@example.com',
            'role' => 'STUDENT',
        ]);
        $this->assertDatabaseHas('student_profiles', [
            'degree' => 'BCA',
            'program_domain' => 'Technology, Digital & Web Skills',
        ]);
    }

    public function test_student_application_submission_with_father_name_and_reg_no(): void
    {
        $response = $this->post(route('apply'), [
            'name' => 'Rahul Sharma',
            'father_name' => 'Rameshwar Sharma',
            'university_reg_no' => '21005678',
            'email' => 'rahul.sharma@example.com',
            'phone' => '9876543210',
            'password' => 'Student@123',
            'degree' => 'BSc',
            'college' => 'Patna Science College',
            'semester' => '5th Semester',
            'program_domain' => 'Science, Environment & Data Skills',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('student_profiles', [
            'father_name' => 'Rameshwar Sharma',
            'university_reg_no' => '21005678',
            'degree' => 'BSc',
        ]);

        $admin = User::factory()->create(['role' => 'ADMIN']);
        $adminResponse = $this->actingAs($admin)->get(route('admin.dashboard', ['search' => '21005678']));
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('Rameshwar Sharma');
        $adminResponse->assertSee('21005678');
    }

    public function test_certificate_verification_with_valid_and_invalid_codes(): void
    {
        $user = User::factory()->create(['role' => 'STUDENT']);
        $profile = StudentProfile::create([
            'user_id' => $user->id,
            'application_number' => 'INF-2026-9999',
            'degree' => 'B.Tech Computer Science',
            'college' => 'Patna Engineering College',
            'semester' => 'Semester 6',
            'program_domain' => 'AI & Machine Learning Engineering',
            'status' => 'COMPLETED',
            'certificate_issued' => true,
            'certificate_number' => 'UGC-INF-999999',
            'certificate_date' => now(),
            'marksheet_issued' => true,
            'marksheet_grade' => 'A+',
            'marksheet_marks' => 95,
        ]);

        // Valid Certificate Code
        $validResponse = $this->get(route('verify', ['code' => 'UGC-INF-999999']));
        $validResponse->assertStatus(200);
        $validResponse->assertSee('UGC-INF-999999');
        $validResponse->assertSee($user->name);

        // Invalid Certificate Code
        $invalidResponse = $this->get(route('verify', ['code' => 'INVALID-CODE-000']));
        $invalidResponse->assertStatus(200);
        $invalidResponse->assertSee('Certificate Record Not Found');
    }

    public function test_student_can_login_and_access_student_dashboard(): void
    {
        $user = User::create([
            'name' => 'Aditya Raj',
            'email' => 'aditya.student@example.com',
            'password' => bcrypt('Student@123'),
            'role' => 'STUDENT',
        ]);

        StudentProfile::create([
            'user_id' => $user->id,
            'application_number' => 'INF-2026-1001',
            'degree' => 'B.Tech CSE',
            'college' => 'BIT Patna',
            'semester' => 'Semester 6',
            'program_domain' => 'Full Stack Cloud Development',
            'status' => 'ACTIVE',
            'offer_letter_issued' => true,
            'offer_letter_date' => now(),
        ]);

        $loginResponse = $this->post(route('login'), [
            'email' => 'aditya.student@example.com',
            'password' => 'Student@123',
        ]);

        $loginResponse->assertRedirect(route('student.dashboard'));
        $this->assertAuthenticatedAs($user);

        $dashResponse = $this->get(route('student.dashboard'));
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('Aditya Raj');
    }

    public function test_student_cannot_access_admin_dashboard(): void
    {
        $user = User::create([
            'name' => 'Regular Student',
            'email' => 'student.only@example.com',
            'password' => bcrypt('Student@123'),
            'role' => 'STUDENT',
        ]);

        $this->actingAs($user);

        $response = $this->get(route('admin.dashboard'));
        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_dashboard_and_inquiries(): void
    {
        $admin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin.test@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $this->actingAs($admin);

        $dashResponse = $this->get(route('admin.dashboard'));
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('Administrator Command Center');

        $inqResponse = $this->get(route('admin.inquiries'));
        $inqResponse->assertStatus(200);
        $inqResponse->assertSee('Partnership Desks');
    }

    public function test_student_gets_instant_offer_and_consent_letters(): void
    {
        $user = User::create([
            'name' => 'Kavita Singh',
            'email' => 'kavita@example.com',
            'password' => bcrypt('Student@123'),
            'role' => 'STUDENT',
        ]);

        $profile = StudentProfile::create([
            'user_id' => $user->id,
            'application_number' => 'INF-2026-8888',
            'degree' => 'BSc',
            'college' => 'Patna Science College',
            'semester' => '5th Semester',
            'program_domain' => 'Technology, Digital & Web Skills',
            'status' => 'APPROVED',
            'offer_letter_issued' => true,
            'offer_letter_date' => now(),
            'consent_letter_issued' => true,
            'consent_letter_date' => now(),
        ]);

        $this->actingAs($user);

        // Offer Letter
        $offerRes = $this->get(route('student.offer-letter'));
        $offerRes->assertStatus(200);
        $offerRes->assertSee('OFFER & ACCEPTANCE LETTER', false);

        // Consent Letter
        $consentRes = $this->get(route('student.consent-letter'));
        $consentRes->assertStatus(200);
        $consentRes->assertSee('Consent & Institutional Undertaking Letter', false);
    }

    public function test_admin_can_manage_internship_streams(): void
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $this->actingAs($admin);

        // List streams
        $listRes = $this->get(route('admin.streams'));
        $listRes->assertStatus(200);
        $listRes->assertSee('Internship Streams &amp; Tracks', false);

        // Create stream
        $createRes = $this->post(route('admin.streams.store'), [
            'title' => 'Cybersecurity & Ethical Hacking',
            'code' => 'CYBER-SEC',
            'category' => 'TECHNOLOGY',
            'duration' => '8 Weeks (120 Contact Hours)',
            'credits' => '4.0 NHEQF Credits',
            'description' => 'Applied penetration testing, network defense, threat analysis, and digital forensics.',
            'is_active' => '1',
        ]);

        $createRes->assertSessionHas('success');
        $this->assertDatabaseHas('internship_streams', [
            'code' => 'CYBER-SEC',
            'title' => 'Cybersecurity & Ethical Hacking',
        ]);
    }

    public function test_admin_can_track_application_lifecycle(): void
    {
        $admin = User::create([
            'name' => 'Tracking Admin',
            'email' => 'track.admin@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $user = User::create([
            'name' => 'Manish Kumar',
            'email' => 'manish@example.com',
            'password' => bcrypt('Student@123'),
            'role' => 'STUDENT',
        ]);

        $profile = StudentProfile::create([
            'user_id' => $user->id,
            'application_number' => 'INF-2026-7777',
            'degree' => 'BCA',
            'college' => 'Patna College',
            'semester' => '6th Semester',
            'program_domain' => 'AI, Machine Learning & Data Science',
            'status' => 'COMPLETED',
            'attendance_rate' => 92,
            'certificate_issued' => true,
            'certificate_number' => 'UGC-INF-777777',
            'certificate_date' => now(),
            'lor_issued' => true,
            'lor_number' => 'INF-LOR-2026-7777',
            'lor_date' => now(),
        ]);

        $this->actingAs($admin);

        $trackRes = $this->get(route('admin.track', ['search' => 'INF-2026-7777']));
        $trackRes->assertStatus(200);
        $trackRes->assertSee('INF-2026-7777');
        $trackRes->assertSee('Manish Kumar');
        $trackRes->assertSee('UGC-INF-777777');
        $trackRes->assertSee('INF-LOR-2026-7777');
    }

    public function test_login_page_renders_cleanly_without_demo_accounts(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertDontSee('Quick One-Click Demo Access');
        $response->assertDontSee('fillStudentCreds');
        $response->assertDontSee('fillAdminCreds');
        $response->assertSee('Portal Login');
        $response->assertSee('Student Login');
        $response->assertSee('Admin Login');
    }

    public function test_admin_dashboard_renders_all_feature_tabs(): void
    {
        $admin = User::create([
            'name' => 'Tabs Admin',
            'email' => 'tabs.admin@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $this->actingAs($admin);

        foreach (['overview', 'all', 'enrolled', 'pending_cert', 'issued_cert', 'manage'] as $tab) {
            $response = $this->get(route('admin.dashboard', ['tab' => $tab]));
            $response->assertStatus(200);
            $response->assertSee('Administrator Command Center');
        }
    }

    public function test_admin_can_store_new_applicant(): void
    {
        $admin = User::create([
            'name' => 'Enrollment Admin',
            'email' => 'enroll.admin@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $this->actingAs($admin);

        $response = $this->post(route('admin.application.store'), [
            'name' => 'Rohan Sen',
            'email' => 'rohan.sen@example.com',
            'phone' => '+91 9911223344',
            'college' => 'Patna Science College',
            'degree' => 'BSc',
            'semester' => '5th Semester',
            'program_domain' => 'AI, Machine Learning & Data Science',
            'mentor_name' => 'Dr. R. K. Vatsa',
            'attendance_rate' => 95,
            'status' => 'APPROVED',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('users', ['email' => 'rohan.sen@example.com']);
        $this->assertDatabaseHas('student_profiles', [
            'college' => 'Patna Science College',
            'program_domain' => 'AI, Machine Learning & Data Science',
            'status' => 'APPROVED',
        ]);
    }

    public function test_admin_can_revoke_issued_certificate(): void
    {
        $admin = User::create([
            'name' => 'Revoke Admin',
            'email' => 'revoke.admin@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $user = User::create([
            'name' => 'Pooja Roy',
            'email' => 'pooja.roy@example.com',
            'password' => bcrypt('Student@123'),
            'role' => 'STUDENT',
        ]);

        $profile = StudentProfile::create([
            'user_id' => $user->id,
            'application_number' => 'INF-2026-9991',
            'degree' => 'BCA',
            'college' => 'Patna Women\'s College',
            'semester' => '6th Semester',
            'program_domain' => 'Technology, Digital & Web Skills',
            'status' => 'COMPLETED',
            'attendance_rate' => 90,
            'certificate_issued' => true,
            'certificate_number' => 'UGC-INF-999111',
            'certificate_date' => now(),
        ]);

        $this->actingAs($admin);

        $response = $this->post(route('admin.application.revoke-certificate', $profile->id));
        $response->assertSessionHas('success');

        $profile->refresh();
        $this->assertFalse($profile->certificate_issued);
        $this->assertEquals('ACTIVE', $profile->status);
    }

    public function test_admin_can_issue_certificate_with_start_and_end_dates(): void
    {
        $admin = User::create([
            'name' => 'Cert Admin',
            'email' => 'cert.admin@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $student = User::create([
            'name' => 'Priya Raj',
            'email' => 'priya.raj@example.com',
            'password' => bcrypt('Student@123'),
            'role' => 'STUDENT',
        ]);

        $profile = StudentProfile::create([
            'user_id' => $student->id,
            'application_number' => 'INF-2026-7204',
            'degree' => 'BCA',
            'college' => 'Patna Science College',
            'semester' => '6th Semester',
            'program_domain' => 'Web Development',
            'status' => 'ACTIVE',
            'attendance_rate' => 95,
            'certificate_issued' => false,
        ]);

        $this->actingAs($admin);

        $response = $this->post(route('admin.application.certificate', $profile->id), [
            'certificate_number' => 'UGC-INF-855357',
            'certificate_date' => '2026-10-22',
            'internship_start_date' => '2026-06-01',
            'internship_end_date' => '2026-07-15',
        ]);

        $response->assertSessionHas('success');

        $profile->refresh();
        $this->assertTrue($profile->certificate_issued);
        $this->assertEquals('UGC-INF-855357', $profile->certificate_number);
        $this->assertEquals('COMPLETED', $profile->status);
        $this->assertEquals('2026-06-01', $profile->internship_start_date->format('Y-m-d'));
        $this->assertEquals('2026-07-15', $profile->internship_end_date->format('Y-m-d'));

        // View Certificate and verify dates are rendered
        $certResponse = $this->get(route('admin.application.view-certificate', $profile->id));
        $certResponse->assertStatus(200);
        $certResponse->assertSee('01 June 2026');
        $certResponse->assertSee('15 July 2026');

        // View Public Verifier
        $verifyResponse = $this->get(route('verify', 'UGC-INF-855357'));
        $verifyResponse->assertStatus(200);
        $verifyResponse->assertSee('June 01, 2026');
        $verifyResponse->assertSee('July 15, 2026');
    }

    public function test_admin_can_export_applications_csv(): void
    {
        $admin = User::create([
            'name' => 'Export Admin',
            'email' => 'export.admin@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $this->actingAs($admin);

        $response = $this->get(route('admin.applications.export'));
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
    }

    public function test_admin_can_view_academic_setup_page(): void
    {
        $admin = User::create([
            'name' => 'Academic Admin',
            'email' => 'academic.admin@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $this->actingAs($admin);

        $response = $this->get(route('admin.academic-setup'));
        $response->assertStatus(200);
        $response->assertSee('Academic Setup & Registration Data', false);
    }

    public function test_admin_can_create_update_toggle_and_delete_degree(): void
    {
        $admin = User::create([
            'name' => 'Degree Admin',
            'email' => 'degree.admin@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $this->actingAs($admin);

        // 1. Create Degree
        $response = $this->post(route('admin.degrees.store'), [
            'name' => 'Master of Computer Applications',
            'code' => 'MCA',
            'duration' => '2 Years (4 Semesters)',
            'description' => 'Advanced software engineering program',
            'sort_order' => 10,
            'is_active' => 'on',
        ]);
        $response->assertRedirect(route('admin.academic-setup', ['tab' => 'degrees']));
        $this->assertDatabaseHas('degrees', [
            'code' => 'MCA',
            'name' => 'Master of Computer Applications',
            'is_active' => true,
        ]);

        $degree = Degree::where('code', 'MCA')->first();

        // 2. Update Degree
        $response = $this->patch(route('admin.degrees.update', $degree->id), [
            'name' => 'Master of Computer Applications (Postgrad)',
            'code' => 'MCA',
            'duration' => '2 Years',
            'sort_order' => 11,
            'is_active' => 'on',
        ]);
        $response->assertRedirect(route('admin.academic-setup', ['tab' => 'degrees']));
        $this->assertDatabaseHas('degrees', [
            'name' => 'Master of Computer Applications (Postgrad)',
        ]);

        // 3. Toggle Status
        $response = $this->post(route('admin.degrees.toggle', $degree->id));
        $response->assertRedirect(route('admin.academic-setup', ['tab' => 'degrees']));
        $degree->refresh();
        $this->assertFalse($degree->is_active);

        // 4. Delete Degree
        $response = $this->delete(route('admin.degrees.delete', $degree->id));
        $response->assertRedirect(route('admin.academic-setup', ['tab' => 'degrees']));
        $this->assertDatabaseMissing('degrees', ['code' => 'MCA']);
    }

    public function test_admin_can_create_update_toggle_and_delete_school(): void
    {
        $admin = User::create([
            'name' => 'School Admin',
            'email' => 'school.admin@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $this->actingAs($admin);

        // 1. Create School
        $response = $this->post(route('admin.schools.store'), [
            'name' => 'Delhi University Central Campus',
            'code' => 'DU-CC',
            'city' => 'New Delhi',
            'state' => 'Delhi',
            'type' => 'UNIVERSITY',
            'is_active' => 'on',
        ]);
        $response->assertRedirect(route('admin.academic-setup', ['tab' => 'schools']));
        $this->assertDatabaseHas('schools', [
            'name' => 'Delhi University Central Campus',
            'code' => 'DU-CC',
        ]);

        $school = School::where('name', 'Delhi University Central Campus')->first();

        // 2. Update School
        $response = $this->patch(route('admin.schools.update', $school->id), [
            'name' => 'University of Delhi (North Campus)',
            'code' => 'DU-NC',
            'city' => 'Delhi',
            'state' => 'Delhi',
            'type' => 'UNIVERSITY',
            'is_active' => 'on',
        ]);
        $response->assertRedirect(route('admin.academic-setup', ['tab' => 'schools']));
        $this->assertDatabaseHas('schools', [
            'name' => 'University of Delhi (North Campus)',
        ]);

        $school->refresh();

        // 3. Toggle Status
        $response = $this->post(route('admin.schools.toggle', $school->id));
        $response->assertRedirect(route('admin.academic-setup', ['tab' => 'schools']));
        $school->refresh();
        $this->assertFalse($school->is_active);

        // 4. Delete School
        $response = $this->delete(route('admin.schools.delete', $school->id));
        $response->assertRedirect(route('admin.academic-setup', ['tab' => 'schools']));
        $this->assertDatabaseMissing('schools', ['id' => $school->id]);
    }

    public function test_student_can_register_with_custom_other_school(): void
    {
        $response = $this->post(route('apply'), [
            'name' => 'Vikram Aditya',
            'email' => 'vikram.aditya@example.com',
            'phone' => '9812345678',
            'password' => 'Student@123',
            'degree' => 'B.Tech',
            'college' => '__OTHER__',
            'custom_college' => 'Indian Institute of Technology Patna',
            'semester' => '6th Semester',
            'program_domain' => 'AI, Machine Learning & Data Science',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('student_profiles', [
            'degree' => 'B.Tech',
            'college' => 'Indian Institute of Technology Patna',
        ]);
        $this->assertDatabaseHas('schools', [
            'name' => 'Indian Institute of Technology Patna',
        ]);
    }

    public function test_admin_can_add_applicant_with_custom_password_and_student_can_login(): void
    {
        $admin = User::create([
            'name' => 'Enrollment Admin',
            'email' => 'enrollment.admin@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $this->actingAs($admin);

        $customPass = 'InternPass#2026';
        $studentEmail = 'newstudent.test@example.com';

        $response = $this->post(route('admin.application.store'), [
            'name' => 'Rohan Varma',
            'email' => $studentEmail,
            'phone' => '+91 9988776655',
            'password' => $customPass,
            'degree' => 'BSc',
            'college' => 'Patna Science College',
            'semester' => '5th Semester',
            'program_domain' => 'Environment & Sustainable Science',
            'mentor_name' => 'Dr. K. Sharma',
            'project_title' => 'EIA River Ganga Study',
            'attendance_rate' => 92,
            'status' => 'ACTIVE',
        ]);

        $response->assertSessionHas('success');
        $response->assertSessionHas('created_student_credentials');

        // Verify user exists and can authenticate with the custom password
        $this->assertDatabaseHas('users', [
            'email' => $studentEmail,
            'role' => 'STUDENT',
        ]);

        // Attempt login with the custom password
        auth()->logout();
        $loginResponse = $this->post(route('login'), [
            'email' => $studentEmail,
            'password' => $customPass,
        ]);

        $loginResponse->assertRedirect(route('student.dashboard'));
        $this->assertAuthenticated();
        $this->assertEquals($studentEmail, auth()->user()->email);
    }

    public function test_admin_can_reset_student_password(): void
    {
        $admin = User::create([
            'name' => 'Reset Admin',
            'email' => 'reset.admin@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $student = User::create([
            'name' => 'Old Student',
            'email' => 'oldstudent.reset@example.com',
            'password' => bcrypt('OldPass@123'),
            'role' => 'STUDENT',
        ]);

        $profile = StudentProfile::create([
            'user_id' => $student->id,
            'application_number' => 'INF-2026-7788',
            'degree' => 'BA',
            'college' => 'Magadh Mahila College',
            'semester' => '4th Semester',
            'program_domain' => 'Media & Content Strategy',
            'mentor_name' => 'Advisory Board',
            'project_title' => 'Digital Journalism',
            'attendance_rate' => 88,
            'status' => 'APPROVED',
        ]);

        $this->actingAs($admin);

        $newPass = 'NewSecurePass#9988';
        $response = $this->post(route('admin.application.update-full', $profile->id), [
            'name' => 'Old Student Updated',
            'email' => 'oldstudent.reset@example.com',
            'phone' => '+91 9988771122',
            'new_password' => $newPass,
            'degree' => 'BA',
            'college' => 'Magadh Mahila College',
            'semester' => '4th Semester',
            'program_domain' => 'Media & Content Strategy',
            'mentor_name' => 'Advisory Board',
            'project_title' => 'Digital Journalism',
            'attendance_rate' => 88,
            'status' => 'APPROVED',
        ]);

        $response->assertSessionHas('success');

        // Attempt login with the new password
        auth()->logout();
        $loginResponse = $this->post(route('login'), [
            'email' => 'oldstudent.reset@example.com',
            'password' => $newPass,
        ]);

        $loginResponse->assertRedirect(route('student.dashboard'));
        $this->assertAuthenticated();
    }

    public function test_student_login_with_admin_url_intended_redirects_to_student_dashboard(): void
    {
        $student = User::create([
            'name' => 'Intended Test Student',
            'email' => 'intended.student@example.com',
            'password' => bcrypt('Student@123'),
            'role' => 'STUDENT',
        ]);

        StudentProfile::create([
            'user_id' => $student->id,
            'application_number' => 'INF-2026-6677',
            'degree' => 'BCA',
            'college' => 'Patna Science College',
            'semester' => '3rd Semester',
            'program_domain' => 'Web Development',
            'status' => 'ACTIVE',
        ]);

        // Simulate user visiting an admin URL before logging in
        $response = $this->withSession(['url.intended' => route('admin.dashboard')])
            ->post(route('login'), [
                'email' => 'intended.student@example.com',
                'password' => 'Student@123',
            ]);

        // Student must be redirected to student dashboard, NOT admin dashboard!
        $response->assertRedirect(route('student.dashboard'));
        $this->assertAuthenticated();
    }

    public function test_admin_can_view_and_update_offer_letter_settings(): void
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin.settings@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $this->actingAs($admin);

        // 1. Visit settings page
        $res = $this->get(route('admin.offer-letter.settings'));
        $res->assertStatus(200);
        $res->assertSee('Offer Letter Settings');
        $res->assertSee('Aryav Singh Vishal');

        // 2. Update settings
        $updateRes = $this->post(route('admin.offer-letter.settings.update'), [
            'company_name' => 'INFINITY INTERNS CORP',
            'company_subtitle' => 'Affiliated with Infinitya1 Innovations',
            'cin_number' => 'U85500BR2026PTC999999',
            'address' => 'Floor 4, Tech Tower, Bailey Road, Patna – 800001',
            'email' => 'contact@infinityinterns.com',
            'website' => 'www.infinityinterns.org',
            'letter_title' => 'INTERNSHIP APPOINTMENT & OFFER LETTER',
            'ref_prefix' => 'II/OFFER/',
            'default_role' => 'Software Engineering Intern',
            'default_department' => 'Engineering & R&D',
            'default_location' => 'HYBRID-OFFICE',
            'default_duration' => '10 Weeks (Summer Intensive)',
            'default_stipend' => 'Rs 8000',
            'default_reporting_manager' => 'Dr. Rajeshwar Sharma',
            'default_mode' => 'Hybrid',
            'acceptance_days' => 7,
            'signatory_name' => 'Vikramaditya Roy',
            'signatory_designation' => 'Executive Director of Academic Operations',
        ]);
        $updateRes->assertSessionHas('success');

        // 3. Verify changes reflected in database
        $this->assertDatabaseHas('offer_letter_settings', [
            'company_name' => 'INFINITY INTERNS CORP',
            'cin_number' => 'U85500BR2026PTC999999',
            'signatory_name' => 'Vikramaditya Roy',
        ]);

        // 4. Verify candidate offer letter renders customized values
        $studentUser = User::create([
            'name' => 'Gunja Kumari',
            'email' => 'gunja.test@example.com',
            'password' => bcrypt('Secret@123'),
            'role' => 'STUDENT',
        ]);
        $profile = StudentProfile::create([
            'user_id' => $studentUser->id,
            'application_number' => 'INF-2026-9047',
            'degree' => 'B.Tech CSE',
            'college' => 'NIT Patna',
            'semester' => '6th Semester',
            'program_domain' => 'AI & Cloud Computing',
            'status' => 'APPROVED',
            'offer_letter_issued' => true,
            'offer_letter_date' => now(),
        ]);

        $letterRes = $this->get(route('admin.application.view-offer-letter', $profile->id));
        $letterRes->assertStatus(200);
        $letterRes->assertSee('INFINITY INTERNS CORP');
        $letterRes->assertSee('U85500BR2026PTC999999');
        $letterRes->assertSee('Vikramaditya Roy');
        $letterRes->assertSee('Floor 4, Tech Tower, Bailey Road, Patna – 800001');

        // 5. Test reset to defaults
        $resetRes = $this->post(route('admin.offer-letter.settings.reset'));
        $resetRes->assertSessionHas('success');
        $this->assertDatabaseHas('offer_letter_settings', [
            'company_name' => 'INFINITY INTERNS',
            'cin_number' => 'U85500BR2025PTC075319',
        ]);
    }

    public function test_admin_can_view_and_update_consent_letter_settings(): void
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin.consent@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $this->actingAs($admin);

        // 1. Visit consent letter settings page
        $res = $this->get(route('admin.consent-letter.settings'));
        $res->assertStatus(200);
        $res->assertSee('Consent Letter Settings');
        $res->assertSee('GAYA COLLEGE, GAYA.');

        // 2. Update consent letter settings
        $updateRes = $this->post(route('admin.consent-letter.settings.update'), [
            'default_college' => 'PATNA SCIENCE COLLEGE, PATNA.',
            'annexure_text' => 'ANNEXURE I (CBCS NEP)',
            'letter_title' => 'INSTITUTIONAL UNDERTAKING & CONSENT',
            'letter_subject' => 'TO WHOMSOEVER IT MAY CONCERN',
            'letter_no_prefix' => 'PSC/INT/',
            'credits_text' => 'minimum 06 credits (180 hrs)',
            'authority_designation' => 'Principal / Dean of Student Welfare',
            'show_signature_line' => '1',
        ]);
        $updateRes->assertSessionHas('success');

        // 3. Verify changes reflected in database
        $this->assertDatabaseHas('consent_letter_settings', [
            'default_college' => 'PATNA SCIENCE COLLEGE, PATNA.',
            'annexure_text' => 'ANNEXURE I (CBCS NEP)',
            'letter_no_prefix' => 'PSC/INT/',
        ]);

        // 4. Create student with specific college name and extra details
        $studentUser = User::create([
            'name' => 'Priya Kumari',
            'email' => 'priya.gaya@example.com',
            'phone' => '+91 9123456789',
            'password' => bcrypt('Student@123'),
            'role' => 'STUDENT',
        ]);
        $profile = StudentProfile::create([
            'user_id' => $studentUser->id,
            'application_number' => 'INF-2026-7788',
            'degree' => 'BCA',
            'college' => 'Gaya College, Gaya',
            'semester' => '3rd Semester',
            'gender' => 'Female',
            'father_name' => 'Subhash Kumar',
            'university_reg_no' => 'MU-2023-9988',
            'university_roll_no' => '23BCA015',
            'program_domain' => 'Web Development',
            'status' => 'APPROVED',
            'consent_letter_issued' => true,
            'consent_letter_date' => now(),
        ]);

        // 5. Verify the candidate's consent letter dynamically formats their enrolled college at the top
        $consentRes = $this->get(route('admin.application.view-consent-letter', $profile->id));
        $consentRes->assertStatus(200);
        // Student's college must appear uppercase at the top:
        $consentRes->assertSee('GAYA COLLEGE, GAYA');
        $consentRes->assertSee('Priya Kumari');
        $consentRes->assertSee('Subhash Kumar');
        $consentRes->assertSee('MU-2023-9988');
        $consentRes->assertSee('23BCA015');

        // 6. Test reset to defaults
        $resetRes = $this->post(route('admin.consent-letter.settings.reset'));
        $resetRes->assertSessionHas('success');
        $this->assertDatabaseHas('consent_letter_settings', [
            'default_college' => 'GAYA COLLEGE, GAYA.',
            'annexure_text' => 'ANNEXURE I',
        ]);
    }

    public function test_certificate_renders_exact_reference_layout_and_settings(): void
    {
        // 1. Create admin user
        $admin = User::create([
            'name' => 'Certificate Admin',
            'email' => 'cert.admin@infinityinterns.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $this->actingAs($admin);

        // 2. Access certificate settings page
        $res = $this->get(route('admin.certificate.settings'));
        $res->assertStatus(200);
        $res->assertSee('Certificate of Completion Settings');
        $res->assertSee('CERTIFICATE OF COMPLETION');

        // 3. Create student with certificate details
        $studentUser = User::create([
            'name' => 'Tabish Taj Khurshid',
            'email' => 'tabish.khurshid@example.com',
            'phone' => '+91 9876543210',
            'password' => bcrypt('Student@123'),
            'role' => 'STUDENT',
        ]);

        $profile = StudentProfile::create([
            'user_id' => $studentUser->id,
            'application_number' => 'INF-2026-9900',
            'degree' => 'MBA',
            'college' => 'MAGADH UNIVERSITY, BODH GAYA',
            'semester' => '4th Semester',
            'gender' => 'Male',
            'university_reg_no' => '151103001616',
            'program_domain' => 'Marketing Management',
            'status' => 'COMPLETED',
            'certificate_issued' => true,
            'certificate_number' => 'II-00012',
            'certificate_date' => now(),
            'offer_letter_date' => now()->subDays(45),
            'marksheet_marks' => 96,
            'marksheet_grade' => 'Excellent',
        ]);

        // 4. View Certificate (Admin)
        $certRes = $this->get(route('admin.application.view-certificate', $profile->id));
        $certRes->assertStatus(200);
        $certRes->assertSee('CERTIFICATE OF COMPLETION');
        $certRes->assertSee('TABISH TAJ KHURSHID');
        $certRes->assertSee('151103001616');
        $certRes->assertSee('MAGADH UNIVERSITY, BODH GAYA');
        $certRes->assertSee('MBA Marketing Management');
        $certRes->assertSee('45 Days');
        $certRes->assertSee('Offline');
        $certRes->assertSee('96% Score');
        $certRes->assertSee('Excellent');
        $certRes->assertSee('Rahul Kumar');
        $certRes->assertSee('II-00012');
        $certRes->assertSee('SCAN TO VERIFY');

        // 5. Update certificate settings
        $updateRes = $this->post(route('admin.certificate.settings.update'), [
            'company_name' => 'INFINITY INTERNS OFFICIAL',
            'tagline' => 'LEARN • GROW • SUCCEED',
            'title' => 'CERTIFICATE OF COMPLETION',
            'director_name' => 'Er. Rahul Kumar',
            'director_title' => 'Managing Director, Infinity Interns',
            'company_unit' => 'Infinity A1 Career Counselling Pvt. Ltd.',
            'default_mode' => 'Offline',
            'default_duration' => '45 Days',
            'website_url' => 'https://infinityinterns.com/',
        ]);
        $updateRes->assertSessionHas('success');
        $this->assertDatabaseHas('certificate_settings', [
            'director_name' => 'Er. Rahul Kumar',
            'company_name' => 'INFINITY INTERNS OFFICIAL',
        ]);

        // 6. Reset certificate settings back to defaults
        $resetRes = $this->post(route('admin.certificate.settings.reset'));
        $resetRes->assertSessionHas('success');
        $this->assertDatabaseHas('certificate_settings', [
            'director_name' => 'Rahul Kumar',
            'company_name' => 'INFINITY INTERNS',
        ]);
    }

    public function test_admin_layout_has_animated_spinning_settings_button_and_theme_studio_drawer(): void
    {
        $adminUser = User::create([
            'name' => 'Admin Studio Tester',
            'email' => 'admin.studio@example.com',
            'phone' => '+91 9999900000',
            'password' => bcrypt('Admin@123'),
            'role' => 'ADMIN',
        ]);

        $this->actingAs($adminUser);

        $response = $this->get(route('admin.dashboard'));
        $response->assertStatus(200);

        // Verify continuously animated spinning gear icon & Customize trigger button in header
        $response->assertSee('adminThemeStudioBtn', false);
        $response->assertSee('animate-spin-continuous', false);
        $response->assertSee('Customize');

        // Verify Appearance & Theme Studio drawer markup
        $response->assertSee('adminCustomizerDrawer', false);
        $response->assertSee('adminCustomizerBackdrop', false);
        $response->assertSee('Appearance & Theme Studio', false);
        $response->assertSee('1-Click Master Presets');

        // Verify base themes, color picker, fonts, scale and curvature options
        $response->assertSee('Cyberpunk 2077');
        $response->assertSee('Nordic Forest');
        $response->assertSee('Warm Sepia');
        $response->assertSee('OLED Obsidian');
        $response->assertSee('studioColorPicker', false);
        $response->assertSee('Plus Jakarta Sans');
        $response->assertSee('Space Grotesk');
        $response->assertSee('Playfair Display');
        $response->assertSee('Tech Dot-Matrix Background');
    }
}
