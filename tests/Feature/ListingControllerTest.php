<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Listing;
use Database\Factories\UserFactory;
use App\Models\User;

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
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson('/api/listingsIndex');
        $response->assertStatus(200);
        $response->assertJsonStructure(['listings']);
    }

    public function test_listings_index_returns_listings_as_company_user(): void {
        $listings = Listing::factory()->count(3)->create();
        $company = Company::factory()->create();
        $this->actingAs($company);

        $response = $this->getJson('/api/listingsIndex');
        $response->assertStatus(200);
        $response->assertJsonStructure(['listings']);
    }

    public function test_listings_index_returns_logged_in(): void {
        $listings = Listing::factory()->count(3)->create();


        $response = $this->getJson('/api/listingsIndex');
        $response->assertStatus(401);
    }

    public function test_show_listings_returns_listing(): void {
        $listing = Listing::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson('api/showListing/' . $listing->id);
        $response->assertStatus(200);
    }

    public function test_cannot_show_listing_when_unauthenticated(): void {
        $listing = Listing::factory()->create();

        $response = $this->getJson('api/showListing/' . $listing->id);
        $response->assertStatus(401);
    }
}
