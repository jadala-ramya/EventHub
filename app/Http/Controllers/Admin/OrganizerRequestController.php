<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrganizerRequestApprovedMail;
use App\Models\OrganizerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrganizerRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of organizer requests for admin.
     */
    public function index()
    {
        abort_unless(auth()->user() && auth()->user()->role === 'admin', 403);

        $requests = OrganizerRequest::with('user')->latest()->get();

        return view('admin.organizer_requests.index', compact('requests'));
    }

    /**
     * Approve an organizer request.
     */
    public function approve(Request $request, $id): RedirectResponse
    {
        abort_unless(auth()->user() && auth()->user()->role === 'admin', 403);

        $req = OrganizerRequest::findOrFail($id);

        $oneTimePassword = \Illuminate\Support\Str::random(10);
        $email = $req->contact_email ?: (optional($req->user)->email);

        if ($email) {
            $user = \App\Models\User::where('email', $email)->first();
            if ($user) {
                $user->password = \Illuminate\Support\Facades\Hash::make($oneTimePassword);
                $user->role = 'organizer';
                $user->save();
            } else {
                $user = \App\Models\User::create([
                    'name' => $req->full_name,
                    'email' => $email,
                    'password' => \Illuminate\Support\Facades\Hash::make($oneTimePassword),
                    'role' => 'organizer',
                ]);
            }
            $req->user_id = $user->id;
        }

        $req->status = 'approved';
        $req->save();

        $continueLink = route('organizer.request.approved', $req->id);
        $recipient = $email;

        if ($recipient) {
            Mail::to($recipient)
                ->send(new OrganizerRequestApprovedMail($req, $continueLink, $oneTimePassword));
        }

        return back()->with('status', 'Organizer request approved and organizer notified.');
    }
}
