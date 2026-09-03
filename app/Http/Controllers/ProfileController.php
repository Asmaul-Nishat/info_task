<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $profile = Auth::user()->profile;

        return view('profile', [
            'profile' => $profile,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],

            'parent1_name' => ['nullable', 'string', 'max:255'],
            'parent1_phone' => ['nullable', 'string', 'max:30'],
            'parent2_name' => ['nullable', 'string', 'max:255'],
            'parent2_phone' => ['nullable', 'string', 'max:30'],
        ]);

        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        return redirect()
            ->back()
            ->with('success', 'Personal information saved successfully.');
    }
}