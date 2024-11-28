<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    // @desc Show register form
    // @route GET /register
    public function register(): View
    {
        return view("auth.register");
    }

    // @desc Store user in the database
    // @route POST /register
    public function store(Request $req): RedirectResponse
    {
        $validatedData = $req->validate([
            "name" => "required|string|max:100",
            // "unique" checks if its unique in table of "uers"
            "email" => "required|string|email|unique:users",
            // "confirmed" checks for "password_confirmation" and check if same
            "password" => "required|string|min:8|confirmed"
        ]);

        // Hash data
        $validatedData["password"] = Hash::make($validatedData["password"]);

        // Create user
        $user = User::create($validatedData);

        Auth::attempt([
            "email" => $validatedData["email"],
            "password" => $req->input("password")
        ]);

        return redirect()->route("dashboard.index")->with("success", "Successfully registered an account!");
    }
}
