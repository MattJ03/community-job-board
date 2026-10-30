<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{

    public function availableListings(Request $request) {

        $listings = Listing::where('status', 'open');

        if($request->filled(''))


    }
}
