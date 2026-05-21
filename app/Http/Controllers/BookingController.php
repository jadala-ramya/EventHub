<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketBookedMail;
use App\Models\Seat;
use App\Models\User;

class BookingController extends Controller
{
    public function myBookings()
{
    $bookings = \App\Models\Booking::where('user_id', auth()->id())
                    ->latest()
                    ->get();

    return view('bookings.index', compact('bookings'));
}
//seats
// public function book(Request $request, $id)
// {
//     $event = Event::findOrFail($id);

//     $tickets = $request->tickets;

//     $totalPrice =
//     $event->ticket_price * $tickets;

//     // Check if event closed
//     if ($event->status == 'closed') {

//         return back()->with('error', 'No seats available');

//     }

//     // Check seats
//     if ($event->available_seats < $tickets) {

//         return back()->with('error', 'Not enough seats available');

//     }

//     // Create booking
//     Booking::create([

//         'user_id' => auth()->id(),

//         'event_id' => $event->id,

//         'tickets' => $tickets,

//         'total_price' => $totalPrice,

//     ]);

//     // Reduce seats
//     $event->available_seats -= $tickets;

//     // Auto close booking
//     if ($event->available_seats == 0) {

//         $event->status = 'closed';

//     }

//     $event->save();

//     return back()->with('success', 'Booking Successful');
// }

public function bookSeat(Request $request, $seatId)
{
    $seat = Seat::findOrFail($seatId);

    // Already booked
    if ($seat->is_booked) {
        return back()->with(
            'error',
            'Seat already booked!'
        );
    }

    $request->validate([
        'payment_screenshot' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
    ]);

    // Upload screenshot
    $screenshotName = time() . '_payment_seat_' . $seat->seat_number . '.' . $request->payment_screenshot->extension();
    $request->payment_screenshot->move(
        public_path('payments'),
        $screenshotName
    );

    // Mark seat booked
    $seat->is_booked = true;
    $seat->save();

    // Update event seats
    $event = $seat->event;
    $event->remaining_seats -= 1;
    $event->save();

    // Create booking
    $booking = Booking::create([
        'user_id' => auth()->id(),
        'event_id' => $event->id,
        'tickets' => 1,
        'total_price' => $event->price,
        'payment_screenshot' => $screenshotName,
        'ticket_number' => 'EVT-' . rand(100000, 999999),
    ]);

    // Send Email
    try {
        Mail::to(auth()->user()->email)
            ->send(new TicketBookedMail($booking));
    } catch (\Exception $e) {
        // Handle email exception
    }

    return back()->with(
        'success',
        'Seat ' . $seat->seat_number . ' booked successfully! Ticket details sent to your email.'
    );
}

public function getSeatBook($seatId)
{
    $seat = Seat::find($seatId);
    if ($seat) {
        return redirect()->route('events.show', $seat->event_id);
    }
    return redirect()->route('user.dashboard');
}

public function organizerBookings()
{
    $bookings = \App\Models\Booking::with('event', 'user')
                    ->whereHas('event', function($query) {

                        $query->where('organizer_id', auth()->id());

                    })
                    ->latest()
                    ->get();

    return view('organizer.bookings', compact('bookings'));
}
public function ticket(\App\Models\Booking $booking)
{
    return view('bookings.ticket', compact('booking'));
}
    public function store(Request $request, Event $event)
    {
        if ($event->event_type === 'seated') {
            return redirect()->route('events.show', $event->id)
                             ->with('error', 'Please select a seat to book tickets.');
        }

        $request->validate([
            'tickets' => 'required|integer|min:1',
            'payment_screenshot' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $ticketsCount = $request->tickets;

        // Check availability if a limit is set
        if ($event->standing_limit !== null) {
            if ($event->remaining_seats < $ticketsCount) {
                return back()->with('error', 'Not enough tickets available!');
            }
        }

        // Upload screenshot
        $screenshotName = time().'_payment.'.$request->payment_screenshot->extension();
        $request->payment_screenshot->move(
            public_path('payments'),
            $screenshotName
        );

        // Create booking
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'tickets' => $ticketsCount,
            'total_price' => $ticketsCount * $event->price,
            'payment_screenshot' => $screenshotName,
            'ticket_number' => 'EVT-'.rand(100000,999999),
        ]);

        // Decrement remaining tickets/seats if standing limit is set
        if ($event->standing_limit !== null) {
            $event->remaining_seats -= $ticketsCount;
            $event->save();
        }

        // Send Email
        try {
            Mail::to(auth()->user()->email)
                ->send(new TicketBookedMail($booking));
        } catch (\Exception $e) {
            // Handle email exception
        }

        return redirect()->route('user.dashboard')
                     ->with('success', 'Ticket Booked Successfully');
    }
}
