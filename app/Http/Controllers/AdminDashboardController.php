<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Booking;
use App\Models\OrganizerRequest;
use App\Mail\OrganizerRequestApprovedMail;
use Illuminate\Support\Facades\Mail;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            abort_unless(auth()->user() && auth()->user()->role === 'admin', 403);
            return $next($request);
        });
    }

    public function index()
    {
        // STATS
        $totalUsers =
            User::where('role', 'user')->count();

        $totalOrganizers =
            User::where('role', 'organizer')->count();

        $totalEvents =
            Event::count();

        $totalBookings =
            Booking::count();

        $totalRevenue =
            Booking::sum('total_price');

        // RECENT USERS
        $recentUsers =
            User::latest()
                ->take(5)
                ->get();

        // RECENT EVENTS
        $recentEvents =
            Event::latest()
                ->take(5)
                ->get();

        // ORGANIZER REQUESTS
        $organizerRequests =
            OrganizerRequest::with('user')->latest()->get();

        $pendingRequestsCount = $organizerRequests->where('status', 'pending')->count();

        $allUsers =
User::latest()->get();

//events controlling
$allEvents =
Event::latest()->get();

$recentEvents =
    Event::latest()->take(5)->get();



        return view('admin.dashboard', compact(

            'totalUsers',
            'totalOrganizers',
            'totalEvents',
            'totalBookings',
            'totalRevenue',

            'recentUsers',
            'recentEvents',

            'organizerRequests',
            'pendingRequestsCount',
            'allUsers',
            'allEvents',

        ));
    }

    public function approve($id)
    {
        $request = OrganizerRequest::findOrFail($id);

        $oneTimePassword = \Illuminate\Support\Str::random(10);
        $email = $request->contact_email ?: (optional($request->user)->email);

        if ($email) {
            $user = \App\Models\User::where('email', $email)->first();
            if ($user) {
                $user->password = \Illuminate\Support\Facades\Hash::make($oneTimePassword);
                $user->role = 'organizer';
                $user->save();
            } else {
                $user = \App\Models\User::create([
                    'name' => $request->full_name,
                    'email' => $email,
                    'password' => \Illuminate\Support\Facades\Hash::make($oneTimePassword),
                    'role' => 'organizer',
                ]);
            }
            $request->user_id = $user->id;
        }

        $request->status = 'approved';
        $request->save();

        $continueLink = route('organizer.request.approved', $request->id);

        $recipient = $email;
        if ($recipient) {
            Mail::to($recipient)
                ->send(new OrganizerRequestApprovedMail($request, $continueLink, $oneTimePassword));
        }

        return back()->with(
            'success',
            'Organizer approved successfully and the organizer has been notified.'
        );
    }

public function reject($id)
{
$request =
OrganizerRequest::findOrFail($id);


$request->status = 'rejected';

$request->save();

return back()->with(
    'success',
    'Organizer request rejected.'
);


}


public function deleteUser($id)
{
$user = User::findOrFail($id);

// PREVENT ADMIN DELETE
if($user->role == 'admin')
{
    return back()->with(
        'error',
        'Admin cannot be deleted.'
    );
}

$user->delete();

return back()->with(
    'success',
    'User deleted successfully.'
);


}

public function deleteEvent($id)
{
$event = Event::findOrFail($id);


$event->delete();

return back()->with(
    'success',
    'Event deleted successfully.'
);


}

public function closeBooking($id)
{
$event = Event::findOrFail($id);


$event->status = 'closed';

$event->save();

return back()->with(
    'success',
    'Bookings closed successfully.'
);


}

public function openBooking($id)
{
$event = Event::findOrFail($id);


$event->status = 'active';

$event->save();

return back()->with(
    'success',
    'Bookings reopened successfully.'
);


}



}