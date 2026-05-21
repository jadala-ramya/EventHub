@extends('layouts.app')

@section('content')

<style>
    /* Custom Animations */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-in {
        animation: slideIn 0.5s ease-out;
    }

    .stat-card {
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    /* Status Badge Styles */
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .status-upcoming {
        background: rgba(59, 130, 246, 0.2);
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .status-ongoing {
        background: rgba(16, 185, 129, 0.2);
        color: #34d399;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status-completed {
        background: rgba(156, 163, 175, 0.2);
        color: #d1d5db;
        border: 1px solid rgba(156, 163, 175, 0.3);
    }

    .status-cancelled {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    /* Table hover effect */
    .event-table-row {
        transition: all 0.2s ease;
    }

    .event-table-row:hover {
        background: rgba(255, 255, 255, 0.05);
        transform: scale(1.005);
    }

    /* Quick action buttons */
    .quick-action-btn {
        transition: all 0.2s ease;
    }

    .quick-action-btn:hover {
        transform: translateY(-2px);
    }

    .glass-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0.03) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.1);
    }
    
    .text-glow {
        text-shadow: 0 0 10px rgba(234,179,8,0.3);
    }
</style>

<!-- Background Container to match login page theme -->
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-pink-900 py-12 px-4 sm:px-6 lg:px-8 text-white relative overflow-hidden">
    
    <!-- Animated Background Orbs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-72 h-72 bg-yellow-500 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-pulse delay-2000"></div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8 animate-slide-in">

        <!-- Welcome Banner -->
        <div class="mb-8 overflow-hidden bg-gradient-to-r from-purple-700/80 via-purple-600/70 to-yellow-500/80 border border-white/15 rounded-3xl shadow-2xl relative backdrop-blur-md">
            <div class="relative px-8 py-12">
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <h1 class="text-4xl font-bold text-white md:text-5xl drop-shadow-md">
                            Welcome back, {{ auth()->user()->name }}! 👋
                        </h1>
                        <p class="mt-2 text-lg text-yellow-200 drop-shadow-sm font-medium">
                            Manage your events, analyze bookings, and track your revenue in real-time.
                        </p>
                    </div>
                    <div class="w-16 h-16 rounded-2xl bg-white/15 border border-white/25 flex items-center justify-center text-3xl shadow-lg animate-bounce">
                        🚀
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Section with Actions -->
        <div class="flex flex-col gap-4 mb-8 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white drop-shadow-md">Dashboard Overview</h2>
                <p class="text-gray-300">Manage your events and track performance</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('organizer.bookings') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 text-white transition-all bg-gradient-to-r from-green-600/85 to-emerald-500/85 border border-green-500/30 rounded-xl hover:scale-105 shadow-lg shadow-green-900/20 backdrop-blur-sm quick-action-btn">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    View All Bookings
                </a>

                <a href="/events/create"
                   class="inline-flex items-center gap-2 px-6 py-3 text-white transition-all bg-gradient-to-r from-purple-600 to-yellow-500 border border-purple-400/20 rounded-xl hover:scale-105 shadow-lg shadow-purple-900/30 backdrop-blur-sm quick-action-btn">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create New Event
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">

            <!-- Total Events Card -->
            <div class="overflow-hidden transition-all glass-card rounded-2xl shadow-xl hover:shadow-2xl border border-white/10 relative">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-300">Total Events</p>
                            <h3 class="mt-2 text-3xl font-bold text-yellow-400 text-glow">{{ $totalEvents }}</h3>
                        </div>
                        <div class="p-3 bg-white/10 rounded-xl border border-white/10">
                            <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-sm text-green-400 font-semibold">
                            {{ $activeEvents ?? 0 }} active
                        </span>
                        <span class="text-sm text-gray-400"> now</span>
                    </div>
                </div>

                <div class="border-t border-white/10 p-4 space-y-2 max-h-48 overflow-y-auto">
                    @foreach($events as $event)
                    <div class="p-3 bg-white/5 border border-white/10 rounded-xl transition hover:bg-white/10">
                        <h4 class="text-xs font-bold text-white truncate">{{ $event->title }}</h4>
                        <p class="mt-1 text-[11px] font-semibold text-yellow-400">
                            @if($event->event_type == 'seated')
                                Remaining Seats: {{ $event->remaining_seats }}
                            @else
                                Remaining Tickets: {{ $event->standing_limit !== null ? $event->remaining_seats : 'Unlimited' }}
                            @endif
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Total Bookings Card -->
            <div class="overflow-hidden transition-all glass-card rounded-2xl shadow-xl hover:shadow-2xl border border-white/10 relative">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-300">Total Bookings</p>
                            <h3 class="mt-2 text-3xl font-bold text-green-400 text-glow">{{ $totalBookings }}</h3>
                        </div>
                        <div class="p-3 bg-white/10 rounded-xl border border-white/10">
                            <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-sm text-blue-400 font-semibold">
                            {{ $pendingBookings ?? 0 }} pending
                        </span>
                    </div>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="overflow-hidden transition-all glass-card rounded-2xl shadow-xl hover:shadow-2xl border border-white/10 relative">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-300">Total Revenue</p>
                            <h3 class="mt-2 text-3xl font-bold text-purple-400 text-glow">₹{{ number_format($totalRevenue, 2) }}</h3>
                        </div>
                        <div class="p-3 bg-white/10 rounded-xl border border-white/10">
                            <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-sm text-green-400 font-semibold">
                            ↑ {{ $revenueGrowth ?? 0 }}% from last month
                        </span>
                    </div>
                </div>
            </div>

            <!-- Top Event Card -->
            <div class="overflow-hidden transition-all glass-card rounded-2xl shadow-xl hover:shadow-2xl border border-white/10 relative">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-300">Top Performing Event</p>
                            <h3 class="mt-2 text-lg font-bold truncate text-yellow-400 text-glow max-w-[180px]">
                                {{ $topEvent ? $topEvent->title : 'No Data' }}
                            </h3>
                        </div>
                        <div class="p-3 bg-white/10 rounded-xl border border-white/10">
                            <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    @if($topEvent)
                    <div class="mt-4">
                        <span class="text-sm text-gray-300">
                            {{ $topEvent->bookings_count ?? 0 }} total bookings
                        </span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Stats Row -->
        <div class="grid gap-6 mb-8 md:grid-cols-3">
            <div class="flex items-center justify-between p-6 shadow-lg bg-gradient-to-br from-blue-600/70 to-blue-500/50 backdrop-blur-md border border-blue-400/20 rounded-2xl">
                <div>
                    <p class="text-sm font-medium text-blue-100">Average Ticket Price</p>
                    <p class="text-2xl font-bold text-white">₹{{ number_format($averageTicketPrice ?? 0, 2) }}</p>
                </div>
                <div class="p-2 bg-white/20 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
            </div>

            <div class="flex items-center justify-between p-6 shadow-lg bg-gradient-to-br from-green-500/70 to-emerald-500/50 backdrop-blur-md border border-green-400/20 rounded-2xl">
                <div>
                    <p class="text-sm font-medium text-green-100">Total Seats Sold</p>
                    <p class="text-2xl font-bold text-white">{{ $totalSeatsSold ?? 0 }}</p>
                </div>
                <div class="p-2 bg-white/20 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"></path>
                    </svg>
                </div>
            </div>

            <div class="flex items-center justify-between p-6 shadow-lg bg-gradient-to-br from-purple-500/70 to-pink-500/50 backdrop-blur-md border border-purple-400/20 rounded-2xl">
                <div>
                    <p class="text-sm font-medium text-purple-100">Occupancy Rate</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($occupancyRate ?? 0, 1) }}%</p>
                </div>
                <div class="p-2 bg-white/20 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Events Overview Table -->
        <div class="mb-8 overflow-hidden glass-card rounded-2xl shadow-xl border border-white/10 relative">
            <div class="px-6 py-4 border-b border-white/10">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-white">All Events Overview</h3>
                        <p class="text-sm text-gray-300">Manage and track your events performance</p>
                    </div>
                    <button onclick="exportEventsToCSV()" class="inline-flex items-center gap-2 px-4 py-2 text-sm text-white transition bg-white/10 rounded-lg border border-white/15 hover:bg-white/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export CSV
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-white/10">
                    <thead class="bg-white/5">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-yellow-400 uppercase">Event Title</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-yellow-400 uppercase">Date</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-yellow-400 uppercase">Venue</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-yellow-400 uppercase">Capacity / Tickets Sold</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-yellow-400 uppercase">Bookings</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-yellow-400 uppercase">Revenue</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-yellow-400 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-yellow-400 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 bg-transparent">
                        @forelse($events as $event)
                        <tr class="event-table-row">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-white">{{ $event->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">{{ Str::limit($event->venue, 30) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($event->event_type == 'seated')
                                    @php
                                        $bookedSeats = $event->total_seats - $event->remaining_seats;
                                        $percentage = $event->total_seats > 0 ? ($bookedSeats / $event->total_seats) * 100 : 0;
                                    @endphp
                                    <div class="text-sm text-white">
                                        {{ $bookedSeats }} / {{ $event->total_seats }} seats
                                    </div>
                                    <div class="w-full mt-1 bg-white/10 rounded-full h-1.5 border border-white/5">
                                        <div class="bg-gradient-to-r from-purple-500 to-yellow-400 h-1.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                @else
                                    @php
                                        $bookedTickets = (int) ($event->bookings_sum_tickets ?? 0);
                                        $percentage = ($event->standing_limit !== null && $event->standing_limit > 0) ? ($bookedTickets / $event->standing_limit) * 100 : 0;
                                    @endphp
                                    <div class="text-sm text-white">
                                        @if($event->standing_limit !== null)
                                            {{ $bookedTickets }} / {{ $event->standing_limit }} sold
                                        @else
                                            {{ $bookedTickets }} sold (Unlimited)
                                        @endif
                                    </div>
                                    @if($event->standing_limit !== null)
                                        <div class="w-full mt-1 bg-white/10 rounded-full h-1.5 border border-white/5">
                                            <div class="bg-gradient-to-r from-orange-500 to-yellow-400 h-1.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    @endif
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-semibold text-green-400">{{ $event->bookings_count ?? 0 }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-purple-400">₹{{ number_format($event->bookings_sum_price ?? 0, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $eventDate = \Carbon\Carbon::parse($event->date);
                                    $status = '';
                                    if ($eventDate->isPast()) {
                                        $status = 'completed';
                                    } elseif ($eventDate->isToday()) {
                                        $status = 'ongoing';
                                    } elseif ($eventDate->isFuture()) {
                                        $status = 'upcoming';
                                    }
                                @endphp
                                <span class="status-badge status-{{ $status }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <div class="flex gap-3">
                                    <a href="{{ route('events.show', $event->id) }}" class="text-purple-400 hover:text-purple-300" title="View">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('events.edit', $event->id) }}" class="text-yellow-400 hover:text-yellow-300" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <button onclick="confirmDelete({{ $event->id }}, '{{ $event->title }}')" class="text-red-400 hover:text-red-300" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="text-center">
                                    <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="mt-4 text-gray-400">No events created yet</p>
                                    <a href="/events/create" class="inline-flex items-center gap-2 mt-4 text-yellow-400 hover:text-yellow-300 font-semibold">
                                        Create your first event
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Bookings & Quick Actions Grid -->
        <div class="grid gap-8 mb-8 lg:grid-cols-2">

            <!-- Recent Bookings -->
            <div class="overflow-hidden glass-card rounded-2xl shadow-xl border border-white/10 relative">
                <div class="px-6 py-4 border-b border-white/10">
                    <h3 class="text-xl font-bold text-white">Recent Bookings</h3>
                    <p class="text-sm text-gray-300">Latest ticket purchases</p>
                </div>
                <div class="divide-y divide-white/5">
                    @forelse($recentBookings ?? [] as $booking)
                    <div class="p-4 transition hover:bg-white/5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-white">{{ $booking->user_name ?? 'Guest' }}</p>
                                <p class="text-sm text-gray-400">{{ $booking->event_title ?? 'Event' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-purple-400">₹{{ number_format($booking->amount ?? 0, 2) }}</p>
                                <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($booking->created_at ?? now())->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center">
                        <p class="text-gray-400">No recent bookings</p>
                    </div>
                    @endforelse
                </div>
                @if(isset($recentBookings) && count($recentBookings) > 0)
                <div class="px-6 py-3 border-t border-white/10">
                    <a href="{{ route('organizer.bookings') }}" class="text-sm text-yellow-400 hover:text-yellow-300 font-semibold">View all bookings →</a>
                </div>
                @endif
            </div>

            <!-- Quick Actions & Tips -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="overflow-hidden glass-card rounded-2xl shadow-xl border border-white/10 relative">
                    <div class="px-6 py-4 border-b border-white/10">
                        <h3 class="text-xl font-bold text-white">Quick Actions</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <a href="/events/create" class="flex items-center gap-3 p-3 transition rounded-lg hover:bg-white/5 border border-transparent hover:border-white/10">
                                <div class="p-2 bg-white/10 rounded-lg text-yellow-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Create New Event</p>
                                    <p class="text-xs text-gray-400">Start selling tickets</p>
                                </div>
                            </a>

                            <a href="{{ route('organizer.bookings') }}" class="flex items-center gap-3 p-3 transition rounded-lg hover:bg-white/5 border border-transparent hover:border-white/10">
                                <div class="p-2 bg-white/10 rounded-lg text-green-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Manage Bookings</p>
                                    <p class="text-xs text-gray-400">View and manage tickets</p>
                                </div>
                            </a>

                            <a href="#" class="flex items-center gap-3 p-3 transition rounded-lg hover:bg-white/5 border border-transparent hover:border-white/10">
                                <div class="p-2 bg-white/10 rounded-lg text-purple-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">View Analytics</p>
                                    <p class="text-xs text-gray-400">Detailed reports</p>
                                </div>
                            </a>

                            <a href="#" class="flex items-center gap-3 p-3 transition rounded-lg hover:bg-white/5 border border-transparent hover:border-white/10">
                                <div class="p-2 bg-white/10 rounded-lg text-orange-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Email Support</p>
                                    <p class="text-xs text-gray-400">Get help and resources</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pro Tip -->
                <div class="overflow-hidden bg-gradient-to-r from-purple-700/85 via-purple-600/75 to-yellow-500/85 border border-white/15 rounded-2xl shadow-xl backdrop-blur-md">
                    <div class="p-6">
                        <div class="flex items-start gap-4">
                            <div class="text-3xl animate-pulse">💡</div>
                            <div>
                                <h4 class="font-bold text-white">Pro Tip</h4>
                                <p class="mt-1 text-sm text-yellow-100/90 font-medium">
                                    Promote your events on social media to increase ticket sales by up to 300%!
                                </p>
                                <button class="mt-3 text-sm font-semibold text-white underline underline-offset-2 hover:text-yellow-200">
                                    Learn more →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 transition-opacity bg-black bg-opacity-70" onclick="closeDeleteModal()"></div>

        <div class="relative w-full max-w-md p-6 mx-auto transition-all transform bg-gray-900 border border-white/10 shadow-2xl rounded-2xl text-white">
            <div class="text-center">
                <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-900/30 rounded-full border border-red-500/20">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-medium text-white">Delete Event</h3>
                <p class="mt-2 text-sm text-gray-300">
                    Are you sure you want to delete "<span id="deleteEventTitle" class="text-yellow-400 font-semibold"></span>"? This action cannot be undone.
                </p>
                <div class="flex gap-3 mt-6">
                    <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 text-gray-300 transition border border-white/10 rounded-lg hover:bg-white/5">
                        Cancel
                    </button>
                    <form id="deleteForm" method="POST" action="" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 text-white transition bg-red-600 rounded-lg hover:bg-red-700">
                            Delete Event
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let deleteEventId = null;

    function confirmDelete(eventId, eventTitle) {
        deleteEventId = eventId;
        document.getElementById('deleteEventTitle').textContent = eventTitle;
        document.getElementById('deleteForm').action = `/events/${eventId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    function exportEventsToCSV() {
        const events = @json($events);
        if (events.length === 0) {
            alert('No events to export');
            return;
        }

        let csvContent = "Title,Date,Venue,Total Seats,Available Seats,Bookings,Revenue,Status\n";

        events.forEach(event => {
            const row = [
                `"${event.title}"`,
                event.date,
                `"${event.venue}"`,
                event.total_seats,
                event.available_seats,
                event.bookings_count || 0,
                event.bookings_sum_price || 0,
                event.status
            ].join(',');
            csvContent += row + "\n";
        });

        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `events_export_${new Date().toISOString().split('T')[0]}.csv`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
    }
</script>

@endsection
