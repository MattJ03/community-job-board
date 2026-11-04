<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function registerCompany(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'number_of_employees' => 'required',
            'industry' => 'required',
            'phone_number' => 'required|min:3|max:16',
            'email' => 'required|email|unique:companies',
            'password' => 'required|confirmed|min:6',
        ]);

        $company = Company::create([
            'name' => $validatedData['name'],
            'number_of_employees' => $validatedData['number_of_employees'],
            'industry' => $validatedData['industry'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        Log::info($company->name . ' created a company account');

        return response()->json([
            'company' => $company,
            'message' => 'company registered successfully',
        ], 201);
    }

    public function loginCompany(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $company = Company::where('email', $validatedData['email'])->first();
        if(!$company || !Hash::check($validatedData['password'], $company->password)) {
            return response()->json([
                'message' => 'invalid email or password',
            ], 401);
        }

        $token = $company->createToken($company->name)->plainTextToken;

        return response()->json([
            'company' => $company,
            'token' => $token,
            'message' => 'login successfully',
        ]);
    }

    public function storeCompanyLogo(Request $request) {
        $company = auth()->user();

        $validatedData = $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $path = $request->file('logo')->store('logos/' . $company->id, 'public');

        $company->update([
            'logo' => $path,
        ]);

        return response()->json([
            'company' => $company,
            'message' => 'company logo created successfully',
        ]);


    }
}
