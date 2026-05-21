<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\OrganizerRequestMail;
use App\Mail\OrganizerApprovedMail;
use App\Models\User;
use App\Models\OrganizerRequest;
use Illuminate\Support\Str;

class OrganizerRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('user.become-organizer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'organization_name' => 'required|string|max:255',
            'event_details' => 'required|string',
            'id_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $filePath = $request->file('id_proof')->store('idproofs', 'public');

        $organizerRequest = OrganizerRequest::create([
            'user_id' => auth()->id(),
            'full_name' => $request->full_name,
            'contact_email' => $request->contact_email,
            'phone' => $request->phone,
            'organization_name' => $request->organization_name,
            'event_details' => $request->event_details,
            'id_proof' => $filePath,
            'status' => 'pending',
        ]);

        $data = [
            'request_id' => $organizerRequest->id,
            'full_name' => $request->full_name,
            'contact_email' => $request->contact_email,
            'phone' => $request->phone,
            'organization_name' => $request->organization_name,
            'event_details' => $request->event_details,
            'id_proof' => $filePath,
        ];

        Mail::to('kurvasucharitha24@gmail.com')->send(new OrganizerRequestMail($data));

        return redirect('/')->with('success', 'Organizer request submitted successfully! An admin will review it shortly.');
    }

    public function approved($id)
    {
        $requestModel = OrganizerRequest::findOrFail($id);
        abort_if($requestModel->user_id !== auth()->id(), 403);
        abort_if($requestModel->status !== 'approved', 403, 'Your request is not approved yet.');

        return view('organizer.request-approved', compact('requestModel'));
    }

    public function complete(Request $request, $id)
    {
        $organizerRequest = OrganizerRequest::findOrFail($id);

        abort_if($organizerRequest->user_id !== auth()->id(), 403);
        if ($organizerRequest->status !== 'approved') {
            return back()->with('error', 'Your request is not approved yet.');
        }

        $user = auth()->user();
        $user->role = 'organizer';
        $user->save();

        $organizerRequest->status = 'completed';
        $organizerRequest->save();

        return redirect()->route('organizer.dashboard')
            ->with('success', 'Your organizer account is now active. Welcome aboard!');
    }
}