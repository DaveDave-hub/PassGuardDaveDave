<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Pass;

class VaultCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_password_entry()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/vault/store', [
                'platform' => 'Test Platform',
                'email_username' => 'test@example.com',
                'password' => 'Password123!',
            ])
            ->assertRedirect('/vault');

        $this->assertDatabaseHas('passes', [
            'platform' => 'Test Platform',
            'email_username' => 'test@example.com',
        ]);
    }

    public function test_user_can_edit_password_entry()
    {
        $user = User::factory()->create();
        $passwordEntry = Pass::factory()->create([
            'user_id' => $user->id,
            'platform' => 'Test Platform',
            'email_username' => 'test@example.com',
            'password' => 'Password123!',
        ]);

        $this->actingAs($user)
            ->put('/vault/update/' . $passwordEntry->id, [
                'platform' => 'Updated Platform',
                'email_username' => 'updated@example.com',
                'password' => 'NewPassword123!',
            ])
            ->assertRedirect('/vault');

        $this->assertDatabaseHas('passes', [
            'platform' => 'Updated Platform',
            'email_username' => 'updated@example.com',
        ]);
    }

    public function test_user_can_delete_password_entry()
    {
        $user = User::factory()->create();
        $passwordEntry = Pass::factory()->create([
            'user_id' => $user->id,
            'platform' => 'Test Platform',
            'email_username' => 'test@example.com',
            'password' => 'Password123!',
        ]);

        $this->actingAs($user)
            ->delete('/vault/destroy/' . $passwordEntry->id)
            ->assertRedirect('/vault');

        $this->assertDatabaseMissing('passes', [
            'id' => $passwordEntry->id,
        ]);
    }

    public function test_user_can_search_password_entry()
    {
        $user = User::factory()->create();
        Pass::factory()->create([
            'user_id' => $user->id,
            'platform' => 'Search Platform',
            'email_username' => 'search@example.com',
            'password' => 'Password123!',
        ]);

        $this->actingAs($user)
            ->get('/vault?query=Search')
            ->assertSee('Search Platform');
    }
}

