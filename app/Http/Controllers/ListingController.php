<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

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

}
