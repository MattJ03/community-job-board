<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Database\Factories\UserFactory;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_company_register_returns_company(): void {
        $company = [
            'name' => 'gergrer',
            'number_of_employees' => 10,
            'industry' => 'ggewg',
            'phone_number' => '123456789',
            'email' => 'fake@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson('/api/registerCompany', $company);
        $response->assertStatus(201);
    }
}
