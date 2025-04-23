<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Show the profile edit page
public function edit()
{
    return view('profile.edit', [
        'user' => auth()->user(), // Pass the currently logged-in user
    ]);
}

// Update the profile information
public function update(Request $request)
{
    // Validate the inputs
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'birth_date' => 'nullable|date',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = auth()->user();

    // Update the user information
    $user->first_name = $request->input('first_name');
    $user->last_name = $request->input('last_name');
    $user->email = $request->input('email');
    $user->birth_date = $request->input('birth_date');

    // Handle profile photo upload
    if ($request->hasFile('profile_photo')) {
        $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        $user->profile_photo_path = $photoPath;
    }

    $user->save();

    return redirect('/profile')->with('success', 'Profils ir atjaunināts!');
}


public function destroy(Request $request)
{
    $user = $request->user();
    Auth::logout();
    $user->delete();

    return redirect('/')->with('success', 'Profils dzēsts.');
}


}

