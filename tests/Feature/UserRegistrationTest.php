<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegistrationTest extends TestCase
{
use RefreshDatabase;

public function test_user_can_register()
{
$response = $this->post('/register', [
'username' => 'testuser',
'name' => 'Test User',
'email' => 'testuser@example.com',
'password' => 'Password123!',
'password_confirmation' => 'Password123!',
]);

$response->assertRedirect('/home');
$this->assertDatabaseHas('users', [
'email' => 'testuser@example.com',
]);
}
}
