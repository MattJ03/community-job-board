<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Database\Factories\UserFactory;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_register_user_in_db(): void {
        $user = [
            'name' => "John Doe",
            'email' => 'john@gmail.com',
            'number' => '123456789',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->postJson('/api/registerUser', $user);
        $this->assertDatabaseHas('users', [
            'name' => $user['name'],
        ]);
    }

    public function test_register_no_two_users_same_email(): void {
        $user = User::factory()->create([
            'email' => 'john@gmail.com',
        ]);

        $user2 = User::factory()->raw([
            'email' => 'john@gmail.com',
        ]);
        $response = $this->postJson('/api/registerUser', $user2);
        $response->assertStatus(422);
    }

    public function test_register_user_returns_user(): void {
        $user = User::factory()->raw([
            'name' => 'ryan',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response = $this->postJson('/api/registerUser', $user);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message', 'user'
        ]);
    }
}
