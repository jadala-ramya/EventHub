<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrganizerDashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role != 'organizer') {
            abort(403);
        }

        $organizerId = auth()->id();

        $events = Event::where('organizer_id', $organizerId)
            ->withCount('bookings')
            ->withSum('bookings as bookings_sum_price', 'total_price')
            ->withSum('bookings as bookings_sum_tickets', 'tickets')
            ->latest()
            ->get();

        // Analytics
        $totalEvents = $events->count();

        $activeEvents = $events->filter(function ($event) {
            return $event->status == 'active' && (Carbon::parse($event->date)->isFuture() || Carbon::parse($event->date)->isToday());
        })->count();

        // Total Bookings for this organizer's events
        $totalBookings = Booking::whereHas('event', function ($query) use ($organizerId) {
            $query->where('organizer_id', $organizerId);
        })->count();

        // Pending Bookings (if status column exists in bookings table, count pending ones; otherwise 0)
        $hasStatusColumn = \Schema::hasColumn('bookings', 'status');
        $pendingBookings = 0;
        if ($hasStatusColumn) {
            $pendingBookings = Booking::whereHas('event', function ($query) use ($organizerId) {
                $query->where('organizer_id', $organizerId);
            })->where('status', 'pending')->count();
        }

        // Total Revenue for this organizer's events
        $totalRevenue = Booking::whereHas('event', function ($query) use ($organizerId) {
            $query->where('organizer_id', $organizerId);
        })->sum('total_price');

        // Monthly Bookings for this organizer's events
        $monthlyBookings = Booking::whereHas('event', function ($query) use ($organizerId) {
            $query->where('organizer_id', $organizerId);
        })
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->groupBy('month')
        ->pluck('total')
        ->toArray();

        // Monthly Revenue for this organizer's events
        $monthlyRevenue = Booking::whereHas('event', function ($query) use ($organizerId) {
            $query->where('organizer_id', $organizerId);
        })
        ->selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
        ->groupBy('month')
        ->pluck('total')
        ->toArray();

        // Top Performing Event for this organizer
        $topEvent = Event::where('organizer_id', $organizerId)
            ->withCount('bookings')
            ->orderByDesc('bookings_count')
            ->first();

        // Average Ticket Price for this organizer's events
        $averageTicketPrice = $events->avg('price') ?? 0;

        // Total Seats Sold (using tickets column or count of bookings)
        $totalSeatsSold = Booking::whereHas('event', function ($query) use ($organizerId) {
            $query->where('organizer_id', $organizerId);
        })->get()->sum(function ($booking) {
            return $booking->tickets ?? 1;
        });

        // Occupancy Rate for seated events
        $totalSeats = $events->where('event_type', 'seated')->sum('total_seats');
        $seatedBookings = Booking::whereHas('event', function ($query) use ($organizerId) {
            $query->where('organizer_id', $organizerId)
                  ->where('event_type', 'seated');
        })->count();
        
        $occupancyRate = $totalSeats > 0 ? ($seatedBookings / $totalSeats) * 100 : 0;

        // Simple revenue growth simulation or placeholder
        $revenueGrowth = 0;

        return view('organizer.dashboard', [
            'events' => $events,
            'totalEvents' => $totalEvents,
            'activeEvents' => $activeEvents,
            'totalBookings' => $totalBookings,
            'pendingBookings' => $pendingBookings,
            'totalRevenue' => $totalRevenue,
            'monthlyBookings' => $monthlyBookings,
            'monthlyRevenue' => $monthlyRevenue,
            'topEvent' => $topEvent,
            'averageTicketPrice' => $averageTicketPrice,
            'totalSeatsSold' => $totalSeatsSold,
            'occupancyRate' => $occupancyRate,
            'revenueGrowth' => $revenueGrowth,
        ]);
    }
}
