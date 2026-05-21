@extends('layouts.app')

@section('content')

<div class="p-8 mx-auto max-w-7xl">

    <!-- Header -->
    <div class="flex flex-col mb-12 md:flex-row md:items-center md:justify-between animate-fade-in">
        <div>
            <h1 class="mb-3 text-5xl font-black bg-gradient-to-r from-purple-400 to-yellow-400 bg-clip-text text-transparent">
                🎟️ My Bookings
            </h1>
            <p class="text-xl text-purple-200">
                View all your booked event tickets.
            </p>
        </div>

        <a href="{{ route('user.dashboard') }}"
           class="px-6 py-3 mt-5 font-semibold transition bg-white/10 hover:bg-white/20 text-white border border-white/10 md:mt-0 rounded-2xl">
            ← Back
        </a>
    </div>

    <!-- Booking Cards -->
    <div class="grid gap-10 md:grid-cols-2">

        @forelse($bookings as $booking)

            <div class="overflow-hidden backdrop-blur-xl bg-white/5 border border-white/10 shadow-2xl rounded-3xl hover:border-purple-500/50 transition-all duration-300">

                <!-- Event Image -->
                @if($booking->event->image)
                    <img src="/events/{{$booking->event->image}}"
                         class="object-cover w-full h-72">
                @else
                    <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=1400&auto=format&fit=crop"
                         class="object-cover w-full h-72">
                @endif

                <!-- Card Content -->
                <div class="p-8">

                    <!-- Event Title -->
                    <h2 class="mb-4 text-3xl font-bold text-white">
                        {{$booking->event->title}}
                    </h2>

                    <!-- Event Info -->
                    <div class="mb-6 space-y-3 text-lg text-purple-200">
                        <p>📍 {{$booking->event->venue}}</p>
                        <p>📅 {{$booking->event->date}}</p>
                    </div>

                    <!-- Ticket Number -->
                    <div class="p-5 mb-6 bg-yellow-500/20 border border-yellow-500/30 rounded-2xl">
                        <p class="text-xl font-bold text-yellow-300">
                            🎫 Ticket Number: {{$booking->ticket_number}}
                        </p>
                    </div>

                    <!-- Payment Screenshot -->
                    <div class="mb-6">
                        <h3 class="mb-4 text-2xl font-bold text-white">
                            Payment Screenshot
                        </h3>
                        <img src="/payments/{{$booking->payment_screenshot}}"
                             class="w-full border border-white/10 shadow-2xl rounded-2xl">
                    </div>

                    <!-- Status -->
                    <div class="p-5 mb-6 bg-green-500/20 border border-green-500/30 rounded-2xl">
                        <p class="text-lg font-bold text-green-300">
                            ✅ Booking Submitted Successfully
                        </p>
                    </div>

                    <!-- View Ticket Button -->
                    <a href="{{ route('ticket.show', $booking->id) }}"
                       class="block py-4 mt-6 text-xl text-center text-white font-bold bg-gradient-to-r from-purple-600 to-yellow-500 hover:from-purple-700 hover:to-yellow-600 transition rounded-2xl shadow-lg">
                        🎟️ View Ticket
                    </a>

                </div>

            </div>

        @empty

            <div class="col-span-2 p-12 text-center backdrop-blur-xl bg-white/5 border border-white/10 rounded-3xl">
                <h2 class="mb-3 text-3xl font-bold text-white">
                    No bookings yet
                </h2>
                <p class="mb-6 text-lg text-purple-200">
                    You haven't booked any events.
                </p>
                <a href="{{ route('user.dashboard') }}"
                   class="inline-block px-8 py-4 font-bold text-white transition bg-gradient-to-r from-purple-600 to-yellow-500 hover:from-purple-700 hover:to-yellow-600 rounded-2xl shadow-lg">
                    Browse Events
                </a>
            </div>

        @endforelse

    </div>

</div>

@endsection
