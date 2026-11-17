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

    public function storePreferredIndustries(Request $request) {
        $user = auth('sanctum')->user();

        $validatedData = $request->validate([
            'industries' => 'sometimes|array|max:5',
            'industries.*' => 'integer|distinct|exists:industries,id',
        ]);

        $user->industries()->sync($validatedData['industries']);

        return response()->noContent();
    }
}
