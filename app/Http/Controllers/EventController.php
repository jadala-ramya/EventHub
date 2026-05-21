<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Events Listing
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $events = Event::latest()->get();

        return view('events.index', compact('events'));
    }

    /*
    |--------------------------------------------------------------------------

    /*
    |--------------------------------------------------------------------------
    | User Dashboard
    |--------------------------------------------------------------------------
    */

    public function userDashboard(Request $request)
    {
        $events = Event::query();

        // Search
        if ($request->search) {
            $events->where('title', 'LIKE', '%' . $request->search . '%');
        }

        // Venue Filter
        if ($request->venue) {
            $events->where('venue', 'LIKE', '%' . $request->venue . '%');
        }

        // Price Filter
        if ($request->price) {
            $events->where('price', '<=', $request->price);
        }

        $events = $events->latest()->get();

        /*
        |--------------------------------------------------------------------------
        | AI Recommendations
        |--------------------------------------------------------------------------
        */

        $recommendedEvents = collect();

        // Get user bookings
        $bookings = \App\Models\Booking::where('user_id', auth()->id())
            ->with('event')
            ->get();

        // Extract booked event titles
        $keywords = [];

        foreach ($bookings as $booking) {
            $titleWords = explode(' ', $booking->event->title);

            foreach ($titleWords as $word) {
                if (strlen($word) > 3) {
                    $keywords[] = $word;
                }
            }
        }

        // Remove duplicates
        $keywords = array_unique($keywords);

        // Find related events
        if (count($keywords) > 0) {
            $recommendedEvents = Event::where(function ($query) use ($keywords) {

                foreach ($keywords as $word) {
                    $query->orWhere('title', 'LIKE', '%' . $word . '%');
                }

            })
                ->whereNotIn('id', $bookings->pluck('event_id'))
                ->latest()
                ->take(6)
                ->get();
        }

        return view('user.dashboard', compact(
            'events',
            'recommendedEvents'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Show Single Event
    |--------------------------------------------------------------------------
    */

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /*
    |--------------------------------------------------------------------------
    | Create Event Page
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        if (auth()->user()->role != 'organizer') {
            abort(403);
        }

        return view('events.create');
    }

    /*
    |--------------------------------------------------------------------------
    | Store Event
    |--------------------------------------------------------------------------
    */

    // public function store(Request $request)
    // {
    //     if (auth()->user()->role != 'organizer') {
    //         abort(403);
    //     }

    //     $request->validate([

    //         'title' => 'required',

    //         'description' => 'required',

    //         'venue' => 'required',

    //         'date' => 'required',

    //         'time' => 'required',

    //         'price' => 'required|numeric',

    //         'image' => 'nullable|image',

    //         'payment_qr' => 'nullable|image',
    //         'event_type' => 'required',

    //     ]);

    //     $event = Event::create([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'event_date' => $request->event_date,
    //         'event_type' => $request->event_type,
    //         'total_seats' => $request->total_seats,
    //         'remaining_seats' => $request->total_seats,
    //         'status' => 'active',
    //     ]);


    //     // Generate Seats
    //     if ($event->event_type == 'seated') {
    //         for ($i = 1; $i <= $event->total_seats; $i++) {
    //             \App\Models\Seat::create([
    //                 'event_id' => $event->id,
    //                 'seat_number' => 'A' . $i,
    //             ]);
    //         }
    //     }
    //     // Event Image Upload
    //     $imageName = null;

    //     if ($request->hasFile('image')) {
    //         $imageName = time() . '_event.' . $request->image->extension();

    //         $request->image->move(
    //             public_path('events'),
    //             $imageName
    //         );
    //     }

    //     // QR Upload
    //     $qrName = null;

    //     if ($request->hasFile('payment_qr')) {
    //         $qrName = time() . '_qr.' . $request->payment_qr->extension();

    //         $request->payment_qr->move(
    //             public_path('payment_qr'),
    //             $qrName
    //         );
    //     }
    //     // Entry Code Image
    //     $entryCodeName = null;

    //     if ($request->hasFile('entry_code')) {
    //         $entryCodeName = time() . '_entry.' . $request->entry_code->extension();

    //         $request->entry_code->move(
    //             public_path('entry_codes'),
    //             $entryCodeName
    //         );
    //     }

    //     // Event::create([
    //     //     'title' => $request->title,
    //     //     'description' => $request->description,
    //     //     'venue' => $request->venue,
    //     //     'date' => $request->date,
    //     //     'time' => $request->time,
    //     //     'total_seats' => $request->total_seats,
    //     //     'available_seats' => $request->total_seats,
    //     //     'price' => $request->price,
    //     //     'image' => $imageName,
    //     //     'payment_qr' => $qrName,
    //     //     'organizer_id' => auth()->id(),
    //     //     'entry_code' => $entryCodeName,
    //     //     'status' => 'open',
    //     // ]);


    //     Event::create([

    //         'title' => $request->title,

    //         'description' => $request->description,

    //         'venue' => $request->venue,

    //         'date' => $request->date,

    //         'time' => $request->time,

    //         'price' => $request->price,

    //         'image' => $imageName,

    //         'payment_qr' => $qrName,

    //         'organizer_id' => auth()->id(),

    //         'entry_code' => $entryCodeName,

    //         'total_seats' => $request->total_seats,

    //         'available_seats' => $request->total_seats,

    //         'status' => 'open',

    //     ]);

    //     return redirect()->route('organizer.dashboard')
    //         ->with('success', 'Event created successfully');
    // }

//     public function store(Request $request)
// {
//     $request->validate([
//         'title' => 'required',
//         'description' => 'required',
//         'event_date' => 'required',
//         'event_type' => 'required',
//     ]);

//     $event = Event::create([
//         'title' => $request->title,
//         'description' => $request->description,
//         'event_date' => $request->event_date,
//         'event_type' => $request->event_type,
//         'total_seats' => $request->total_seats,
//         'remaining_seats' => $request->total_seats,
//         'status' => 'active',
//     ]);

//     // Generate Seats
//     if($event->event_type == 'seated')
//     {
//         for($i = 1; $i <= $event->total_seats; $i++)
//         {
//             \App\Models\Seat::create([
//                 'event_id' => $event->id,
//                 'seat_number' => 'A'.$i,
//             ]);
//         }
//     }

//     return redirect()
//         ->back()
//         ->with('success', 'Event created successfully!');
// }

public function store(Request $request)
{
$request->validate([


    'title' => 'required',
    'description' => 'required',
    'venue' => 'required',
    'date' => 'required',
    'time' => 'required',
    'price' => 'required',
    'event_type' => 'required',
    'total_seats' => 'required_if:event_type,seated|nullable|integer|min:1',
    'standing_limit' => 'required_if:event_type,standing|nullable|integer|min:1',

]);

// IMAGE
$imageName = null;

if($request->hasFile('image'))
{
    $imageName =
        time().'_'.$request->image->getClientOriginalName();

    $request->image->move(
        public_path('events'),
        $imageName
    );
}

// PAYMENT QR
$qrName = null;

if($request->hasFile('payment_qr'))
{
    $qrName =
        time().'_'.$request->payment_qr->getClientOriginalName();

    $request->payment_qr->move(
        public_path('payment_qr'),
        $qrName
    );
}

// ENTRY CODE (Auto-generated unique code for each event)
$entryCode = 'EVT-' . strtoupper(bin2hex(random_bytes(4))) . '-' . rand(100, 999);

// CREATE EVENT
$event = Event::create([

    'title' => $request->title,
    'description' => $request->description,
    'venue' => $request->venue,
    'date' => $request->date,
    'time' => $request->time,
    'price' => $request->price,

    'image' => $imageName,
    'payment_qr' => $qrName,
    'entry_code' => $entryCode,

    'event_type' => $request->event_type,

    'total_seats' =>
        $request->event_type == 'seated'
        ? $request->total_seats
        : 0,

    'standing_limit' =>
        $request->event_type == 'standing'
        ? $request->standing_limit
        : null,

    'remaining_seats' =>
        $request->event_type == 'seated'
        ? $request->total_seats
        : ($request->event_type == 'standing' ? $request->standing_limit : null),

    'status' => 'active',

    'organizer_id' => auth()->id(),

]);

// GENERATE SEATS
if($event->event_type == 'seated')
{
    // GENERATE REAL SEATS

if($event->event_type == 'seated')
{
$rows = range('A', 'Z');


$seatCount = 1;

foreach($rows as $row)
{
    for($number = 1; $number <= 10; $number++)
    {
        if($seatCount > $event->total_seats)
        {
            break 2;
        }

        \App\Models\Seat::create([

            'event_id' => $event->id,

            'seat_number' => $row.$number,

            'is_booked' => false,

        ]);

        $seatCount++;
    }
}


}

}

return redirect()
    ->route('organizer.dashboard')
    ->with(
        'success',
        'Event created successfully!'
    );


}



    /*
    |--------------------------------------------------------------------------
    | Edit Event
    |--------------------------------------------------------------------------
    */

    public function edit(Event $event)
    {
        if (auth()->user()->role != 'organizer') {
            abort(403);
        }

        return view('events.edit', compact('event'));
    }


    //serch
    public function searchPage(Request $request)
    {
        $events = Event::query();

        // Search
        if ($request->search) {
            $events->where('title', 'LIKE', '%' . $request->search . '%');
        }

        // Venue
        if ($request->venue) {
            $events->where('venue', 'LIKE', '%' . $request->venue . '%');
        }

        // Price
        if ($request->price) {
            $events->where('price', '<=', $request->price);
        }

        $events = $events->latest()->get();

        return view('user.search', compact('events'));
    }

    /*
    |--------------------------------------------------------------------------
    | Update Event
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Event $event)
    {
        if (auth()->user()->role != 'organizer') {
            abort(403);
        }

        $request->validate([

            'title' => 'required',

            'description' => 'required',

            'venue' => 'required',

            'date' => 'required',

            'time' => 'required',

            'price' => 'required|numeric',

            'image' => 'nullable|image'

        ]);

        $imageName = $event->image;

        if ($request->hasFile('image')) {
            $imageName = time() . '_event.' . $request->image->extension();

            $request->image->move(
                public_path('events'),
                $imageName
            );
        }

        $event->update([

            'title' => $request->title,

            'description' => $request->description,

            'venue' => $request->venue,

            'date' => $request->date,

            'time' => $request->time,

            'price' => $request->price,

            'image' => $imageName

        ]);

        return redirect()->route('organizer.dashboard')
            ->with('success', 'Event updated successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Event
    |--------------------------------------------------------------------------
    */

    public function destroy(Event $event)
    {
        if (auth()->user()->role != 'organizer') {
            abort(403);
        }

        $event->delete();

        return redirect()->route('organizer.dashboard')
            ->with('success', 'Event deleted successfully');
    }
}
