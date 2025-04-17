<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller; // <-- ŠO vajag!
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;


class SessionController extends Controller
{
    
    public function create()
    {
        return view("auth.login");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "email" => ['required', 'email'],
            "password" => ['required'],
        ]);

        if (!Auth::attempt($validated)) {
            throw ValidationException::withMessages([
                'email' => 'Nepareizs e-pasts vai parole, vai konts vairs neeksistē.'
            ]);
        }
        

        $request->session()->regenerate();

        return redirect("/grades");
    }

    public function destroy()
    {
        Auth::logout();
        return redirect("/");
    }
}
