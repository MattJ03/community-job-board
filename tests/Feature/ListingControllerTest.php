<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Listing;

class ListingControllerTest extends TestCase
{
 use RefreshDatabase;
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_index_listings_returns_listings(): void {
        $listings = Listing::factory()->count(3)->create();

        $response = $this->getJson('/listingsIndex');
        $response->assertStatus(200);
        $response->assertJsonStructure(['listings']);
    }
}
