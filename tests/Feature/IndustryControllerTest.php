<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndustryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_industry_index_returns_industry(): void {
        $response = $this->getJson('/api/allIndustries');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'industries',
        ]);
    }
}
