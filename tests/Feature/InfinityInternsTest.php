<?php

namespace Tests\Feature;

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
}
