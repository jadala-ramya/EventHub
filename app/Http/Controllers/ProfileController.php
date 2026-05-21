<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // SHOW PROFILE PAGE
    public function show()
    {
        return view('profile.show');
    }

    // UPDATE PROFILE
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return back()->with('success',
            'Profile updated successfully!');
    }

    // UPDATE PASSWORD
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // check old password
        if (!Hash::check(
            $request->current_password,
            $user->password
        )) {
            return back()->with('error',
                'Current password is incorrect!');
        }

        // update password
        $user->password = Hash::make(
            $request->new_password
        );

        $user->save();

        return back()->with('success',
            'Password updated successfully!');
    }
}
