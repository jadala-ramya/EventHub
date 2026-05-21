<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'verification_code' => ['nullable', 'string', 'size:8'],
        ]);

        // Check if verification code is valid
        $role = 'user';
        if ($request->verification_code) {
            // Check if there's an approved organizer request with this email
            $organizerRequest = \App\Models\OrganizerRequest::where('contact_email', $request->email)
                ->where('status', 'approved')
                ->first();
            
            if ($organizerRequest && $request->verification_code === session('verification_code')) {
                $role = 'organizer';
                // Mark request as completed
                $organizerRequest->status = 'completed';
                $organizerRequest->save();
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        if ($user->role === 'organizer') {
            return redirect()->route('organizer.dashboard');
        }

        return redirect()->route('user.dashboard');
    }
}