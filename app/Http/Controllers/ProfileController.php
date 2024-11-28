<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // @desc Update profile info
    // @route PUT /profile
    public function update(Request $req): RedirectResponse
    {
        // get logged in user
        $user = Auth::user();

        $validatedData = $req->validate([
            "name" => "required|string",
            "email" => "required|string|email",
            "avatar" => "nullable|image|mimes:jpeg,jpg,png,gif|max:2048"
        ]);

        // Get user name and email
        $user->name = $req->input("name");
        $user->email = $req->input("email");

        // Handle avatar upload
        if ($req->hasFile("avatar")) {
            // Delete old avatar if exist
            if ($user->avatar) {
                Storage::delete("public/" . $user->avatar);
            }

            // Store new avatar
            $avatarPath = $req->file("avatar")->store("avatars", "public");
            $user->avatar = $avatarPath;
        };

        $user->save();

        return redirect()->route("dashboard.index")->with("success", "Profile info updated!");
    }
}
