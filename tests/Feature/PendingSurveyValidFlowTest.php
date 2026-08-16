<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\PendingSurveySubmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PendingSurveyValidFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_token_results_in_persistent_submission_assigned_to_user()
    {
        // Anonymous submit
        $response = $this->post('/survey-submissions', [
            'name' => 'Budi',
            'email' => 'budi@example.test',
            'phone' => '08222222222',
            'notes' => 'Mau lihat unit A',
            'hp_name' => '',
            'ts' => now()->subSeconds(5)->timestamp,
        ]);

        $response->assertRedirect();

        $pending = PendingSurveySubmission::first();
        $this->assertNotNull($pending);
        $token = $pending->token;

        // Create user and complete within valid window
        $reg = $this->followingRedirects()->post('/register', [
                'name' => 'Budi',
                'email' => 'budi@example.test',
                'password' => 'password',
                'password_confirmation' => 'password',
                'token' => $token,
            ]);

        $reg->assertOk();

        // User should exist
        $user = User::where('email', 'budi@example.test')->first();
        $this->assertNotNull($user);

        // Survey submission should be persisted and assigned to user
        $this->assertDatabaseHas('survey_submissions', [
            'email' => 'budi@example.test',
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        // Pending token should be removed from session
        $currentPending = session('pending_survey_submissions', []);
        $this->assertArrayNotHasKey($token, $currentPending);
    }
}
