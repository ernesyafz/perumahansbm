<?php

namespace Tests\Feature;

use App\Models\SurveySubmission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PendingSurveyFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_anonymous_submit_then_register_saves_submission_with_user()
    {
        // Submit survey anonymously
        $response = $this->post('/survey-submissions', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.test',
            'phone' => '08123456789',
            'address' => 'Jl. Mawar 1',
            'preferred_schedule' => 'Sabtu, 10:00',
            'notes' => 'Testing submit',
            'hp_name' => '',
            'ts' => now()->subSeconds(5)->timestamp,
        ]);

        $response->assertRedirect();

        // Pending should be saved in DB
        $pending = \App\Models\PendingSurveySubmission::first();
        $this->assertNotNull($pending);
        $token = $pending->token;
        $this->assertNotEmpty($token);
        $this->assertEquals('budi@example.test', $pending->payload['email'] ?? null);

        // Now register a new user and pass the token
        $reg = $this->followingRedirects()->post('/register', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.test',
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $token,
        ]);

        $reg->assertOk();

        // After registration the pending submission should be saved to DB
        $this->assertDatabaseHas('users', ['email' => 'budi@example.test']);

        $this->assertDatabaseHas('survey_submissions', [
            'email' => 'budi@example.test',
        ]);

        $submission = SurveySubmission::where('email', 'budi@example.test')->first();
        $this->assertNotNull($submission->user_id);
    }
}
