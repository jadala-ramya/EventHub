@extends('layouts.app')

@section('content')

<div class="p-10">

    <div class="max-w-4xl mx-auto">

        <!-- Back -->
        <a href="{{ route('my.bookings') }}"
           class="inline-block px-6 py-3 mb-8 font-semibold bg-white/10 hover:bg-white/20 text-white border border-white/10 rounded-xl transition">
            ← Back to My Bookings
        </a>

        <!-- Ticket -->
        <div class="backdrop-blur-xl bg-white/5 border border-white/10 rounded-[40px] shadow-2xl overflow-hidden text-white">

            <!-- Banner -->
            @if($booking->event->image)
                <img src="/events/{{$booking->event->image}}"
                     class="w-full h-[350px] object-cover">
            @else
                <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=1400&auto=format&fit=crop"
                     class="w-full h-[350px] object-cover">
            @endif

            <!-- Content -->
            <div class="p-12">

                <!-- Header -->
                <div class="flex items-center justify-between mb-10">
                    <div>
                        <h1 class="mb-3 text-5xl font-black bg-gradient-to-r from-purple-400 to-yellow-400 bg-clip-text text-transparent">
                            🎟️ Event Ticket
                        </h1>
                        <p class="text-xl text-purple-200">
                            Entry Pass
                        </p>
                    </div>

                    <div class="px-6 py-4 bg-yellow-500/20 border border-yellow-500/30 rounded-2xl">
                        <p class="text-xl font-bold text-yellow-300">
                            {{$booking->ticket_number}}
                        </p>
                    </div>
                </div>

                <!-- Grid -->
                <div class="grid gap-12 md:grid-cols-2">

                    <!-- Left -->
                    <div>
                        <h2 class="mb-8 text-4xl font-extrabold text-white">
                            {{$booking->event->title}}
                        </h2>

                        <div class="space-y-5 text-xl text-purple-200">
                            <p>
                                👤 <strong class="text-white">Attendee:</strong>
                                {{$booking->user->name}}
                            </p>
                            <p>
                                📍 <strong class="text-white">Venue:</strong>
                                {{$booking->event->venue}}
                            </p>
                            <p>
                                📅 <strong class="text-white">Date:</strong>
                                {{$booking->event->date}}
                            </p>
                            <p>
                                ⏰ <strong class="text-white">Time:</strong>
                                {{$booking->event->time}}
                            </p>
                        </div>
                    </div>

                    <!-- Right -->
                    <div class="flex flex-col items-center justify-center">

                        <!-- Dynamic QR Code -->
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ urlencode(route('ticket.show', $booking)) }}"
                             class="mb-6 shadow rounded-3xl w-72"
                             alt="Ticket QR Code">

                        <p class="text-center text-purple-300 font-semibold mb-3">
                            Event Code: {{ $booking->event->entry_code ?? 'N/A' }}
                        </p>

                        <p class="text-center text-purple-200">
                            Show this ticket at the event entry.
                        </p>
                    </div>

                </div>

                <!-- Footer -->
                <div class="pt-8 mt-12 border-t border-white/10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-300">
                                Powered by EventHub
                            </p>
                        </div>

                        <button onclick="window.print()"
                                class="px-8 py-4 text-xl text-white font-bold bg-gradient-to-r from-purple-600 to-yellow-500 hover:from-purple-700 hover:to-yellow-600 rounded-2xl shadow-lg transition">
                            Download Ticket
                        </button>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection
