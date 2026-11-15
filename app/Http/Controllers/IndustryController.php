<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industry;
class IndustryController extends Controller
{
    public function index() {

        $industries = Industry::all();
        if(!$industries) {
            return response()->json([
                'industries' => $industries,
                'message' => 'no industries found',
            ]);
        }

        return response()->json([
            'industries' => $industries,
            'message' => 'industries found',
        ]);
    }
}
