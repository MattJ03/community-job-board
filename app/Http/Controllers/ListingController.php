<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ListingController extends Controller
{

    public function availableListings(Request $request) {

        $query = Listing::where('status', 'open');

        if($request->filled('location')) {
            $query->where('location', $request->location);
        }
        if($request->filled('work_from')) {
            $query->where('work_from', $request->work_from);
        }
        if($request->filled('min_salary')) {
            $query->where('salary', '>=', $request->min_salary);
        }
        if($request->filled('min_hourly')) {
            $query->where('hourly', '>=', $request->min_hourly);
        }

        if($request->filled('search')) {
            $search = $request->query('search');
            $query->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhere('location', 'LIKE', '%' . $search . '%');
            });
        }

        $listings = $query->orderBy('created_at', 'desc');
        if($listings->count() <= 0) {
            return response()->json([
                'listings' => $listings,
                'message' => 'no listings found',
            ]);
        }

        $listings = $listings->paginate(20);
        foreach($listings as $listing) {
            $listing->increment('views');
        }

        return response()->json([
            'listings' => $listings,
            'message' => 'listing listings',
        ]);

    }

    public function showListing(Listing $listing) {

        $listing->increment('views');

        return response()->json([[
            'listing' => $listing,
            'message' => 'listing listing',
        ]]);

    }

    public function storeListing(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'location' => 'required|max:255',
            'years_of_experience' => 'nullable',
            'requirements' => 'nullable|max:255',
            'description' => 'required|max:255',
            'minimum_qualification' => 'nullable',
            'work_from' => 'required',
            'industry' => 'required|max:255',
            'salary' => 'nullable',
            'hourly' => 'nullable',
            ]);

        $listing = Listing::create([
            'company_id' => $request->user()->id,
            'title' => $validatedData['title'],
            'location' => $validatedData['location'],
            'years_of_experience' => $validatedData['years_of_experience'],
            'requirements' => $validatedData['requirements'],
            'description' => $validatedData['description'],
            'minimum_qualification' => $validatedData['minimum_qualification'],
            'work_from' => $validatedData['work_from'],
            'industry' => $validatedData['industry'],
            'salary' => $validatedData['salary'] ?? null,
            'hourly' => $validatedData['hourly'] ?? null,
            'views' => 0,
        ]);
        Log::info($request->user()->title . ' created listing ' . $listing->id);

        return response()->json([
            'listing' => $listing,
            'message' => 'listing listing created',
        ], 201);
    }

    public function updateListing(Request $request, Listing $listing) {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'location' => 'required|max:255',
            'years_of_experience' => 'nullable',
            'requirements' => 'nullable|max:255',
            'description' => 'required|max:255',
            'minimum_qualification' => 'nullable',
            'work_from' => 'required',
            'industry' => 'required|max:255',
            'salary' => 'nullable',
            'hourly' => 'nullable',
        ]);

        $listing->update([
            'title' => $validatedData['title'],
            'location' => $validatedData['location'],
            'years_of_experience' => $validatedData['years_of_experience'],
            'requirements' => $validatedData['requirements'],
            'description' => $validatedData['description'],
            'minimum_qualification' => $validatedData['minimum_qualification'],
            'work_from' => $validatedData['work_from'],
            'industry' => $validatedData['industry'],
            'salary' => $validatedData['salary'] ?? null,
            'hourly' => $validatedData['hourly'] ?? null,
        ]);

        return response()->json([
            'listing' => $listing,
            'message' => 'listing listing updated',
        ]);
    }
}
