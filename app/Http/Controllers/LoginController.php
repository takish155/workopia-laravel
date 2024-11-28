<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // @desc Show login form
    // @route GET /login
    public function login(): View
    {
        return view("auth.login");
    }

    // @desc Authenticate a user
    // @route POST /login
    public function authenticate(Request $req): RedirectResponse
    {
        $credentials = $req->validate([
            // "unique" checks if its unique in table of "uers"
            "email" => "required|string|email",
            // "confirmed" checks for "password_confirmation" and check if same
            "password" => "required|string|min:8"
        ]);

        if (Auth::attempt($credentials)) {
            // Regenerate the session to prevent fixation attacks
            $req->session()->regenerate();

            return redirect()->intended(route("home"))->with("success", "You are now logged in!");
        };

        // If auth fails
        return back()->withErrors([
            "email" => "Credentials doesn't match!"
        ])->onlyInput("ema;i");
    }

    // @desc Log-out the user
    // @route POST /logout
    public function destroy(Request $req): RedirectResponse
    {
        Auth::logout();

        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect("/");
    }
}
