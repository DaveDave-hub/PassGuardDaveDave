<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;



    public function test_user_can_login_with_username()
    {
        $user = User::factory()->create([
            'username' => 'testuser',
            'email' => 'testuser@example.com',
            'password' => bcrypt($password = 'Password123!'),
        ]);

        $response = $this->post('/login', [
            'login' => 'testuser',
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }
}
