<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrganizerApprovedMail;
use App\Mail\OrganizerRejectedMail;
use Illuminate\Support\Str;

class OrganizerRequestController extends Controller
{
    public function index()
    {
        $requests = OrganizerRequest::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.organizer-requests', compact('requests'));
    }

    public function approve($id)
    {
        $organizerRequest = OrganizerRequest::findOrFail($id);
        
        // Generate unique verification code
        $verificationCode = strtoupper(Str::random(8));
        
        // Update request status
        $organizerRequest->status = 'approved';
        $organizerRequest->save();
        
        // Send email with verification code
        Mail::to($organizerRequest->contact_email)->send(new OrganizerApprovedMail($organizerRequest, $verificationCode));
        
        return redirect()->route('admin.organizer_requests.index')
            ->with('success', 'Organizer request approved! Verification code sent to email.');
    }

    public function reject($id)
    {
        $organizerRequest = OrganizerRequest::findOrFail($id);
        $organizerRequest->status = 'rejected';
        $organizerRequest->save();
        
        Mail::to($organizerRequest->contact_email)->send(new OrganizerRejectedMail($organizerRequest));
        
        return redirect()->route('admin.organizer_requests.index')
            ->with('error', 'Organizer request rejected.');
    }
}