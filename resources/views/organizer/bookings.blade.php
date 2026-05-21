@extends('layouts.app')

@section('content')

<div class="p-10 mx-auto max-w-7xl">

    <!-- Header -->
    <div class="flex items-center justify-between mb-12">

        <div>

            <h1 class="mb-3 text-5xl font-bold">
                📋 Event Bookings
            </h1>

            <p class="text-xl text-gray-600">
                Manage all attendee bookings.
            </p>

        </div>

        <a href="{{ route('organizer.dashboard') }}"
           class="px-6 py-3 font-semibold bg-gray-200 rounded-xl">

            ← Back

        </a>

    </div>

    <!-- Booking Cards -->
    <div class="grid gap-10 md:grid-cols-2">

        @forelse($bookings as $booking)

            <div class="overflow-hidden bg-white shadow rounded-3xl">

                <!-- Event Image -->
                @if($booking->event->image)

                    <img src="/events/{{$booking->event->image}}"
                         class="object-cover w-full h-72">

                @else

                    <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=1400&auto=format&fit=crop"
                         class="object-cover w-full h-72">

                @endif

                <!-- Content -->
                <div class="p-8">

                    <h2 class="mb-4 text-4xl font-bold">
                        {{$booking->event->title}}
                    </h2>

                    <!-- User -->
                    <div class="mb-6">

                        <p class="mb-2 text-xl">

                            👤 <strong>User:</strong>
                            {{$booking->user->name}}

                        </p>

                        <p class="text-lg text-gray-600">

                            {{$booking->user->email}}

                        </p>

                    </div>

                    <!-- Ticket -->
                    <div class="p-5 mb-6 bg-indigo-100 rounded-2xl">

                        <p class="text-xl font-bold text-indigo-700">

                            🎟️ Ticket:
                            {{$booking->ticket_number}}

                        </p>

                    </div>

                    <!-- Screenshot -->
                    <div class="mb-6">

                        <h3 class="mb-4 text-2xl font-bold">
                            Payment Screenshot
                        </h3>

                        <img src="/payments/{{$booking->payment_screenshot}}"
                             class="border shadow rounded-2xl">

                    </div>

                    <!-- Status -->
                    <div class="p-5 bg-green-100 rounded-2xl">

                        <p class="text-lg font-bold text-green-700">

                            ✅ Payment Submitted

                        </p>

                    </div>

                </div>

            </div>

        @empty

            <div class="p-10 bg-white shadow rounded-3xl">

                <p class="text-2xl">
                    No bookings yet.
                </p>

            </div>

        @endforelse

    </div>

</div>

@endsection
