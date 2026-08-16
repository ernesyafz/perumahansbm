<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\PendingSurveySubmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PendingSurveyExpiryTest extends TestCase
{
    use RefreshDatabase;

    public function test_expired_token_is_rejected_and_not_saved()
    {
        // Submit survey anonymously
        $response = $this->post('/survey-submissions', [
            'name' => 'Anton',
            'email' => 'anton@example.test',
            'phone' => '08111111111',
            'hp_name' => '',
            'ts' => now()->subSeconds(5)->timestamp,
        ]);

        $response->assertRedirect();
        // Fetch pending record from DB
        $pending = PendingSurveySubmission::first();
        $this->assertNotNull($pending);
        $token = $pending->token;

        // Simulate token created >31 minutes ago
        $pending->created_at = now()->subMinutes(31);
        $pending->save();

        // Register user and attempt to complete (DB record contains expired token)
        $reg = $this->followingRedirects()->post('/register', [
            'name' => 'Anton',
            'email' => 'anton@example.test',
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $token,
        ]);

        $reg->assertOk();

        // Ensure pending token removed from DB and no survey_submissions row created
        $this->assertDatabaseMissing('pending_survey_submissions', ['token' => $token]);
        $this->assertDatabaseMissing('survey_submissions', ['email' => 'anton@example.test']);
    }
}
