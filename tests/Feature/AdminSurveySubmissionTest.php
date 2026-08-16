<?php

namespace Tests\Feature;

use App\Models\SurveySubmission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSurveySubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_shows_pending_survey_submissions_and_notification_count(): void
    {
        $admin = new User([
            'name' => 'Admin SBM',
            'email' => 'admin@sbm.test',
            'password' => 'secret',
            'role' => 'admin',
        ]);
        $this->actingAs($admin);

        SurveySubmission::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081111111111',
            'address' => 'Jl. Mawar No. 1',
            'preferred_schedule' => 'Sabtu, 10:00',
            'notes' => 'Membutuhkan informasi unit keluarga',
            'status' => 'pending',
        ]);

        SurveySubmission::create([
            'name' => 'Sari Lestari',
            'email' => 'sari@example.com',
            'phone' => '082222222222',
            'address' => 'Jl. Melati No. 2',
            'preferred_schedule' => 'Minggu, 13:00',
            'notes' => 'Ingin melihat tipe rumah',
            'status' => 'pending',
        ]);

        SurveySubmission::create([
            'name' => 'Adit Pratama',
            'email' => 'adit@example.com',
            'phone' => '083333333333',
            'address' => 'Jl. Anggrek No. 3',
            'preferred_schedule' => 'Senin, 09:00',
            'notes' => 'Sudah diproses',
            'status' => 'approved',
        ]);

        $response = $this->get('/admin');

        $response->assertOk();
        $response->assertSee('Pengajuan Survei Baru');
        $response->assertSee('2');
        $response->assertSee('Budi Santoso');
        $response->assertSee('Sari Lestari');
    }

    public function test_admin_can_view_and_process_a_survey_submission(): void
    {
        $admin = User::create([
            'name' => 'Admin SBM',
            'email' => 'admin2@sbm.test',
            'password' => 'secret',
            'role' => 'admin',
        ]);
        $this->actingAs($admin);

        $submission = SurveySubmission::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081111111111',
            'address' => 'Jl. Mawar No. 1',
            'preferred_schedule' => 'Sabtu, 10:00',
            'notes' => 'Membutuhkan informasi unit keluarga',
            'status' => 'pending',
        ]);

        $response = $this->get('/admin/survey-submissions/' . $submission->id);

        $response->assertOk();
        $response->assertSee('Detail Pengajuan Survei');
        $response->assertSee('Budi Santoso');

        $processResponse = $this->post('/admin/survey-submissions/' . $submission->id . '/process', [
            'status' => 'approved',
            'admin_note' => 'Unit sesuai kebutuhan.',
        ]);

        $processResponse->assertRedirect();
        $this->assertDatabaseHas('survey_submissions', [
            'id' => $submission->id,
            'status' => 'approved',
            'admin_note' => 'Unit sesuai kebutuhan.',
            'processed_by' => $admin->id,
        ]);
    }

    public function test_admin_cannot_assign_a_survey_slot_that_conflicts_with_another_submission(): void
    {
        $admin = User::create([
            'name' => 'Admin SBM',
            'email' => 'admin3@sbm.test',
            'password' => 'secret',
            'role' => 'admin',
        ]);
        $this->actingAs($admin);

        SurveySubmission::create([
            'name' => 'First Customer',
            'email' => 'first@example.com',
            'phone' => '081000000001',
            'address' => 'Jl. Satu',
            'preferred_schedule' => 'Minggu, 10:00',
            'notes' => 'Sudah terjadwal',
            'status' => 'approved',
            'scheduled_at' => '2026-08-10 10:00:00',
        ]);

        $conflictingSubmission = SurveySubmission::create([
            'name' => 'Second Customer',
            'email' => 'second@example.com',
            'phone' => '081000000002',
            'address' => 'Jl. Dua',
            'preferred_schedule' => 'Minggu, 11:00',
            'notes' => 'Ingin survei pada slot yang sama',
            'status' => 'pending',
        ]);

        $response = $this->post('/admin/survey-submissions/' . $conflictingSubmission->id . '/process', [
            'status' => 'approved',
            'scheduled_at' => '2026-08-10T10:00',
            'admin_note' => 'Coba ambil slot yang sama.',
        ]);

        $response->assertSessionHasErrors('scheduled_at');
        $this->assertDatabaseHas('survey_submissions', [
            'id' => $conflictingSubmission->id,
            'status' => 'pending',
        ]);
    }

    public function test_public_can_submit_a_survey_request(): void
    {
        $response = $this->post('/survey-submissions', [
            'name' => 'Dewi Lestari',
            'email' => 'dewi@example.com',
            'phone' => '081234567890',
            'address' => 'Jl. Cendana No. 10',
            'preferred_schedule' => 'Sabtu, 09:00',
            'notes' => 'Saya ingin melihat unit 2 lantai.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('survey_submissions', [
            'email' => 'dewi@example.com',
            'phone' => '081234567890',
            'status' => 'pending',
        ]);
    }
}
