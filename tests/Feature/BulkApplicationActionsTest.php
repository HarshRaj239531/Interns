<?php

namespace Tests\Feature;

use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BulkApplicationActionsTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'ADMIN',
            'email' => 'admin@infinityinterns.edu',
        ]);
    }

    public function test_admin_can_bulk_generate_certificates_with_start_and_end_dates(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $p1 = StudentProfile::create([
            'user_id' => $user1->id,
            'application_number' => 'INF-2026-9001',
            'college' => 'Patna Science College',
            'degree' => 'BSc',
            'semester' => '5th Semester',
            'program_domain' => 'AI & Machine Learning',
            'status' => 'ACTIVE',
            'certificate_issued' => false,
        ]);

        $p2 = StudentProfile::create([
            'user_id' => $user2->id,
            'application_number' => 'INF-2026-9002',
            'college' => 'Patna University',
            'degree' => 'BSc',
            'semester' => '5th Semester',
            'program_domain' => 'AI & Machine Learning',
            'status' => 'ACTIVE',
            'certificate_issued' => false,
        ]);

        $response = $this->actingAs($this->admin)->post(route('admin.applications.bulk-action'), [
            'action' => 'certificate',
            'selected_ids' => [$p1->id, $p2->id],
            'certificate_prefix' => 'UGC-INF-2026-',
            'internship_start_date' => '2026-08-01',
            'internship_end_date' => '2026-09-30',
            'certificate_date' => '2026-10-01',
        ]);

        $response->assertSessionHas('success');

        $p1->refresh();
        $p2->refresh();

        $this->assertTrue($p1->certificate_issued);
        $this->assertTrue($p2->certificate_issued);
        $this->assertEquals('COMPLETED', $p1->status);
        $this->assertEquals('COMPLETED', $p2->status);
        $this->assertStringStartsWith('UGC-INF-2026-', $p1->certificate_number);
        $this->assertStringStartsWith('UGC-INF-2026-', $p2->certificate_number);
        $this->assertEquals('2026-08-01', $p1->internship_start_date->format('Y-m-d'));
        $this->assertEquals('2026-09-30', $p1->internship_end_date->format('Y-m-d'));
        $this->assertEquals('2026-10-01', $p1->certificate_date->format('Y-m-d'));
    }

    public function test_admin_can_bulk_issue_offer_letters(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $p1 = StudentProfile::create([
            'user_id' => $user1->id,
            'application_number' => 'INF-2026-9003',
            'college' => 'Patna Science College',
            'degree' => 'BCA',
            'semester' => '3rd Semester',
            'program_domain' => 'Full Stack Web Development',
            'status' => 'PENDING',
            'offer_letter_issued' => false,
        ]);

        $p2 = StudentProfile::create([
            'user_id' => $user2->id,
            'application_number' => 'INF-2026-9004',
            'college' => 'Patna Science College',
            'degree' => 'BCA',
            'semester' => '3rd Semester',
            'program_domain' => 'Full Stack Web Development',
            'status' => 'PENDING',
            'offer_letter_issued' => false,
        ]);

        $response = $this->actingAs($this->admin)->post(route('admin.applications.bulk-action'), [
            'action' => 'offer_letter',
            'selected_ids' => [$p1->id, $p2->id],
        ]);

        $response->assertSessionHas('success');

        $p1->refresh();
        $p2->refresh();

        $this->assertTrue($p1->offer_letter_issued);
        $this->assertTrue($p2->offer_letter_issued);
        $this->assertEquals('APPROVED', $p1->status);
        $this->assertEquals('APPROVED', $p2->status);
    }

    public function test_admin_can_bulk_change_status(): void
    {
        $user1 = User::factory()->create();

        $p1 = StudentProfile::create([
            'user_id' => $user1->id,
            'application_number' => 'INF-2026-9005',
            'college' => 'Patna Science College',
            'degree' => 'BCA',
            'semester' => '3rd Semester',
            'program_domain' => 'Cyber Security',
            'status' => 'PENDING',
        ]);

        $response = $this->actingAs($this->admin)->post(route('admin.applications.bulk-action'), [
            'action' => 'status',
            'selected_ids' => [$p1->id],
            'status' => 'ACTIVE',
        ]);

        $response->assertSessionHas('success');
        $p1->refresh();
        $this->assertEquals('ACTIVE', $p1->status);
    }

    public function test_admin_can_bulk_export_selected_to_csv(): void
    {
        $user1 = User::factory()->create();

        $p1 = StudentProfile::create([
            'user_id' => $user1->id,
            'application_number' => 'INF-2026-9006',
            'college' => 'Patna Science College',
            'degree' => 'BSc',
            'semester' => '5th Semester',
            'program_domain' => 'Data Science & Analytics',
            'status' => 'ACTIVE',
        ]);

        $response = $this->actingAs($this->admin)->post(route('admin.applications.export.post'), [
            'selected_ids' => [$p1->id],
        ]);

        $response->assertStatus(200);
        $this->assertEquals('text/csv; charset=UTF-8', $response->headers->get('Content-Type'));
        $content = $response->streamedContent();
        $this->assertStringContainsString('INF-2026-9006', $content);
        $this->assertStringContainsString('Data Science & Analytics', $content);
    }

    public function test_admin_can_bulk_delete(): void
    {
        $user1 = User::factory()->create();

        $p1 = StudentProfile::create([
            'user_id' => $user1->id,
            'application_number' => 'INF-2026-9007',
            'college' => 'Patna Science College',
            'degree' => 'BSc',
            'semester' => '5th Semester',
            'program_domain' => 'Cloud Computing',
            'status' => 'REJECTED',
        ]);

        $response = $this->actingAs($this->admin)->post(route('admin.applications.bulk-action'), [
            'action' => 'delete',
            'selected_ids' => [$p1->id],
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('student_profiles', ['id' => $p1->id]);
    }
}
