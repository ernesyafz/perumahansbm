<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_user_can_login_and_access_dashboard(): void
    {
        User::create([
            'name' => 'Admin SBM',
            'email' => 'admin@sbm.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@sbm.test',
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $this->assertAuthenticatedAs(User::where('email', 'admin@sbm.test')->first());
        $this->get('/admin')->assertOk();
    }

    public function test_default_admin_account_is_created_when_missing(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@sbm.test',
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'admin@sbm.test',
            'role' => 'admin',
        ]);
        $this->get('/admin')->assertOk();
    }
}
