<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create()
    {
        return view("auth.register");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "first_name" => ["required", "max:255", "regex:/^[\p{L}\s\-]+$/u"],
            "last_name" => ["required", "max:255", "regex:/^[\p{L}\s\-]+$/u"],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "birth_date" => ['required', 'date', 'before:today'],
            "role" => ['required', Rule::in(['student', 'teacher'])],
            "password" => ['required', 'confirmed', Password::min(6)->letters()->numbers()->symbols()],
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);
        Auth::login($user);

        return redirect("/grades");
    }
}
