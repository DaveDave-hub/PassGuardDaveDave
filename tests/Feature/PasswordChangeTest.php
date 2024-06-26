<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordChangeTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_change_password()
    {
        $user = User::factory()->create([
            'username' => 'testuser',
            'password' => bcrypt('OldPassword123!'),
        ]);

        $this->actingAs($user)
            ->post('/profile/change', [
                'current_password' => 'OldPassword123!',
                'new_password' => 'NewPassword123!',
                'new_password_confirmation' => 'NewPassword123!',
            ])
            ->assertRedirect('/profile');

        $this->assertTrue(Hash::check('NewPassword123!', $user->fresh()->password));
    }
}
