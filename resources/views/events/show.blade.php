@extends('layouts.app')

@section('content')

<style>
    /* Custom Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeInUp 0.5s ease-out;
    }

    /* Seat Grid Styles */
    .seat-grid {
        display: grid;
        gap: 0.75rem;
        grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
    }

    @media (min-width: 768px) {
        .seat-grid {
            grid-template-columns: repeat(10, 1fr);
        }
    }

    .seat-btn {
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
    }

    .seat-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.3s, height 0.3s;
    }

    .seat-btn:hover::before {
        width: 100%;
        height: 100%;
    }

    /* Ticket Card */
    .ticket-card {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(168, 85, 247, 0.1));
        backdrop-filter: blur(10px);
    }

    /* Info Card */
    .info-card {
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
    }
</style>

<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8 animate-fade-in">

    <!-- Back Button - Enhanced -->
    <a href="{{ auth()->user()->role == 'organizer' ? route('organizer.dashboard') : route('user.dashboard') }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 mb-6 font-semibold text-white transition-all bg-white/10 hover:bg-white/20 border border-white/10 rounded-xl group">
        <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Dashboard
    </a>

    <!-- Main Event Card -->
    <div class="overflow-hidden backdrop-blur-xl bg-white/5 border border-white/10 shadow-2xl rounded-3xl text-white">

        <!-- Event Image - Reduced Size -->
        <div class="relative h-64 overflow-hidden md:h-80 lg:h-96">
            @if($event->image)
                <img src="/events/{{$event->image}}"
                     class="object-cover w-full h-full transition-transform duration-700 hover:scale-105"
                     alt="{{$event->title}}">
            @else
                <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=1400&auto=format&fit=crop"
                     class="object-cover w-full h-full transition-transform duration-700 hover:scale-105"
                     alt="Event placeholder">
            @endif

            <!-- Status Badge Overlay -->
            <div class="absolute top-4 right-4">
                @php
                    $eventDate = \Carbon\Carbon::parse($event->date);
                    $now = \Carbon\Carbon::now();
                    if ($eventDate->isPast()) {
                        $status = 'Completed';
                        $statusColor = 'bg-gray-600';
                    } elseif ($eventDate->isToday()) {
                        $status = 'Live Now';
                        $statusColor = 'bg-green-600';
                    } else {
                        $status = 'Upcoming';
                        $statusColor = 'bg-blue-600';
                    }
                @endphp
                <span class="px-4 py-2 text-sm font-semibold text-white rounded-full {{ $statusColor }}">
                    {{ $status }}
                </span>
            </div>
        </div>

        <!-- Event Content -->
        <div class="p-6 md:p-8 lg:p-10">

            <!-- Title -->
            <h1 class="mb-4 text-3xl font-black bg-gradient-to-r from-purple-400 to-yellow-400 bg-clip-text text-transparent md:text-4xl lg:text-5xl">
                {{$event->title}}
            </h1>

            <!-- Description -->
            <div class="mb-8">
                <p class="text-base leading-relaxed text-purple-200 md:text-lg">
                    {{$event->description}}
                </p>
            </div>

            <!-- Two Column Layout -->
            <div class="grid gap-8 lg:gap-12 lg:grid-cols-2">

                <!-- LEFT COLUMN - Event Details -->
                <div>
                    <div class="p-6 rounded-2xl bg-purple-950/40 border border-purple-500/20">
                        <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">
                            Event Details
                        </h2>

                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-purple-900/40 rounded-lg border border-purple-500/20">
                                    <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-purple-300">Venue</p>
                                    <p class="text-lg font-semibold text-white">{{$event->venue}}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-purple-900/40 rounded-lg border border-purple-500/20">
                                    <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-purple-300">Date</p>
                                    <p class="text-lg font-semibold text-white">
                                        {{\Carbon\Carbon::parse($event->date)->format('l, F j, Y')}}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-purple-900/40 rounded-lg border border-purple-500/20">
                                    <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-purple-300">Time</p>
                                    <p class="text-lg font-semibold text-white">
                                        {{\Carbon\Carbon::parse($event->time)->format('h:i A')}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Price Section -->
                        <div class="pt-6 mt-8 border-t border-purple-500/20">
                            <div class="flex items-baseline justify-between">
                                <div>
                                    <p class="text-sm text-purple-300">Ticket Price</p>
                                    <p class="text-4xl font-bold text-yellow-400">
                                        ₹{{ number_format($event->price, 2) }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-purple-300">
                                        {{ $event->event_type == 'seated' ? 'Available Seats' : 'Available Tickets' }}
                                    </p>
                                    <p class="text-2xl font-bold text-green-400">
                                        @if($event->event_type == 'seated')
                                            {{ $event->remaining_seats }}
                                        @else
                                            {{ $event->standing_limit !== null ? $event->remaining_seats : 'Unlimited' }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN - Booking Section -->
                <div>
                    <div class="p-6 bg-purple-950/40 border border-purple-500/20 shadow-lg rounded-2xl">
                        <h2 class="mb-4 text-2xl font-bold text-white">
                            Book Your Ticket
                        </h2>

                        @if($event->status == 'closed' || ($event->remaining_seats !== null && $event->remaining_seats <= 0))
                            <!-- Sold Out State -->
                            <div class="p-6 text-center bg-red-950/40 border border-red-900/40 rounded-xl">
                                <svg class="w-16 h-16 mx-auto mb-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="mb-2 text-xl font-bold text-red-400">Sold Out!</h3>
                                <p class="text-purple-300">No seats available for this event.</p>
                            </div>
                        @elseif($event->event_type == 'seated')
                            <!-- Seated Event Notice -->
                            <div class="p-6 text-center bg-purple-900/20 border border-purple-500/20 rounded-xl">
                                <svg class="w-16 h-16 mx-auto mb-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                                <h3 class="mb-2 text-xl font-bold text-white">Seated Event</h3>
                                <p class="text-purple-200">This event has assigned seating. Please select your preferred seat from the layout below to complete booking.</p>
                            </div>
                        @else
                            <!-- Booking Form -->
                            <div class="space-y-6">
                                <!-- QR Code Section -->
                                @if($event->payment_qr)
                                    <div class="p-4 text-center bg-purple-900/20 border border-purple-500/20 rounded-xl">
                                        <p class="mb-3 text-sm font-medium text-purple-200">Scan to Pay</p>
                                        <img src="/payment_qr/{{$event->payment_qr}}"
                                             class="w-48 mx-auto shadow-lg rounded-2xl"
                                             alt="Payment QR Code">
                                    </div>
                                @endif

                                <!-- Warning Notice -->
                                <div class="flex gap-3 p-4 border-l-4 border-yellow-500 bg-yellow-500/10 rounded-r-xl">
                                    <svg class="flex-shrink-0 w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-yellow-400">
                                            Important Note
                                        </p>
                                        <p class="text-xs text-yellow-200/80">
                                            Please upload a valid payment screenshot. Organizers will verify payments during event entry.
                                        </p>
                                    </div>
                                </div>

                                @if(auth()->user()->role == 'user')
                                    <form action="{{ route('book.event', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                        @csrf

                                        <!-- Number of Tickets -->
                                        <div>
                                            <label class="block mb-2 text-sm font-semibold text-purple-200">
                                                Number of Tickets
                                            </label>
                                            <input type="number"
                                                   name="tickets"
                                                   min="1"
                                                   @if($event->standing_limit !== null)
                                                       max="{{ $event->remaining_seats }}"
                                                   @endif
                                                   value="1"
                                                   class="w-full px-4 py-3 bg-purple-950/40 border border-purple-500/30 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:border-transparent text-white"
                                                   required>
                                            @if($event->standing_limit !== null)
                                                <p class="mt-1 text-xs text-purple-300/80">Max: {{ $event->remaining_seats }} tickets</p>
                                            @endif
                                        </div>

                                        <!-- Payment Screenshot -->
                                        <div>
                                            <label class="block mb-2 text-sm font-semibold text-purple-200">
                                                Upload Payment Screenshot
                                            </label>
                                            <div class="relative">
                                                <input type="file"
                                                       name="payment_screenshot"
                                                       class="w-full px-4 py-3 bg-purple-950/40 border border-purple-500/30 rounded-xl text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-900 file:text-purple-200 hover:file:bg-purple-800"
                                                       accept="image/*"
                                                       required>
                                            </div>
                                            <p class="mt-1 text-xs text-purple-300/80">Accepted formats: JPG, PNG (Max 5MB)</p>
                                        </div>

                                        <!-- Price Summary -->
                                        <div class="p-4 rounded-xl bg-purple-900/20 border border-purple-500/20">
                                            <div class="flex justify-between mb-2">
                                                <span class="text-purple-200">Ticket Price:</span>
                                                <span class="font-semibold text-white">₹{{ number_format($event->price, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between pt-2 border-t border-purple-500/20">
                                                <span class="font-bold text-white">Total Amount:</span>
                                                <span class="text-xl font-bold text-yellow-400">
                                                    ₹<span id="totalAmount">{{ number_format($event->price, 2) }}</span>
                                                </span>
                                            </div>
                                        </div>

                                        <button type="submit"
                                                class="w-full py-4 font-bold text-white transition-all bg-gradient-to-r from-purple-600 to-yellow-500 hover:from-purple-700 hover:to-yellow-600 hover:scale-105 shadow-lg rounded-xl">
                                            🎟️ Confirm Booking
                                        </button>
                                    </form>

                                    <script>
                                        // Update total amount when ticket count changes
                                        const ticketInput = document.querySelector('input[name="tickets"]');
                                        if (ticketInput) {
                                            ticketInput.addEventListener('change', function() {
                                                const tickets = parseInt(this.value) || 1;
                                                const price = {{ $event->price }};
                                                const total = tickets * price;
                                                document.getElementById('totalAmount').textContent = total.toLocaleString('en-IN', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                });
                                            });
                                        }
                                    </script>
                                @else
                                    <div class="p-6 text-center bg-purple-900/20 border border-purple-500/20 rounded-xl">
                                        <p class="text-purple-200">Please login as a user to book tickets.</p>
                                        <a href="{{ route('login') }}" class="inline-block mt-3 text-yellow-400 hover:text-yellow-500">
                                            Login here →
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Organizer Actions -->
            @if(auth()->user()->role == 'organizer' && auth()->id() == $event->organizer_id)
                <div class="flex flex-wrap gap-4 pt-8 mt-8 border-t border-purple-500/20">
                    <a href="{{ route('events.edit', $event->id) }}"
                       class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-white transition-all bg-yellow-500 hover:bg-yellow-600 hover:scale-105 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Event
                    </a>

                    <button onclick="confirmDelete()"
                            class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-white transition-all bg-red-500 hover:bg-red-600 hover:scale-105 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Event
                    </button>

                    <a href="{{ route('organizer.bookings') }}?event={{ $event->id }}"
                       class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-white transition-all bg-green-500 hover:bg-green-600 hover:scale-105 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        View Bookings
                    </a>
                </div>

                <!-- Delete Confirmation Modal -->
                <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen px-4">
                        <div class="fixed inset-0 bg-black bg-opacity-50" onclick="closeDeleteModal()"></div>
                        <div class="relative w-full max-w-md p-6 mx-auto bg-purple-950 border border-purple-900/50 rounded-2xl">
                            <div class="text-center">
                                <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-900/30 rounded-full">
                                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-lg font-medium text-white">Delete Event</h3>
                                <p class="mt-2 text-sm text-purple-300">
                                    Are you sure you want to delete "{{ $event->title }}"? This action cannot be undone.
                                </p>
                                <div class="flex gap-3 mt-6">
                                    <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 text-purple-200 border border-purple-500/30 rounded-lg hover:bg-purple-900/30">
                                        Cancel
                                    </button>
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function confirmDelete() {
                        document.getElementById('deleteModal').classList.remove('hidden');
                    }
                    function closeDeleteModal() {
                        document.getElementById('deleteModal').classList.add('hidden');
                    }
                </script>
            @endif
        </div>
    </div>

    <!-- Seated Event Section -->
    @if($event->event_type == 'seated' && isset($event->seats) && count($event->seats) > 0)
        <div class="mt-12 overflow-hidden backdrop-blur-xl bg-white/5 border border-white/10 shadow-2xl rounded-3xl text-white">
            <div class="p-6 md:p-8">
                <div class="flex flex-col gap-4 mb-8 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-bold md:text-3xl text-white">
                            🎟️ Select Your Seat
                        </h2>
                        <p class="mt-1 text-sm text-purple-200">
                            Choose your preferred seat from the layout below
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 bg-green-500 rounded-lg"></div>
                            <span class="text-sm font-semibold text-purple-200">Available</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 bg-red-500 rounded-lg"></div>
                            <span class="text-sm font-semibold text-purple-200">Booked</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 bg-purple-600 rounded-lg"></div>
                            <span class="text-sm font-semibold text-purple-200">Your Selection</span>
                        </div>
                    </div>
                </div>

                <!-- Screen -->
                <div class="mb-10">
                    <div class="relative">
                        <div class="w-64 h-2 mx-auto rounded-full bg-gradient-to-r from-purple-500 via-yellow-500 to-pink-500 md:w-96"></div>
                        <div class="absolute transform -translate-x-1/2 -top-6 left-1/2">
                            <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-3 text-sm text-center text-purple-300">
                        STAGE / SCREEN
                    </p>
                </div>

                <!-- Seat Grid -->
                <div class="seat-grid">
                    @foreach($event->seats as $seat)
                        @if(auth()->check() && auth()->user()->role == 'user')
                            <button type="button"
                                    onclick="openBookingModal('{{ $seat->id }}', '{{ $seat->seat_number }}')"
                                    class="seat-btn w-full py-3 rounded-xl font-bold text-sm transition-all duration-300
                                    {{ $seat->is_booked
                                        ? 'bg-red-500 cursor-not-allowed opacity-60'
                                        : 'bg-green-500 hover:bg-green-600 hover:scale-105 hover:shadow-lg' }}"
                                    {{ $seat->is_booked ? 'disabled' : '' }}>
                                {{ $seat->seat_number }}
                            </button>
                        @else
                            <button type="button"
                                    onclick="alert('Please login as a user to book seats.')"
                                    class="seat-btn w-full py-3 rounded-xl font-bold text-sm transition-all duration-300
                                    {{ $seat->is_booked
                                        ? 'bg-red-500 cursor-not-allowed opacity-60'
                                        : 'bg-green-500 hover:bg-green-600 hover:scale-105 hover:shadow-lg' }}"
                                    {{ $seat->is_booked ? 'disabled' : '' }}>
                                {{ $seat->seat_number }}
                            </button>
                        @endif
                    @endforeach
                </div>

                <div class="p-4 mt-8 bg-purple-900/20 border border-purple-500/20 rounded-xl">
                    <p class="text-sm text-center text-purple-200">
                        💡 Tip: Click on any available (green) seat to choose it and verify payment
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    .seat-btn {
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
    }

    .seat-btn:active {
        transform: scale(0.95);
    }

    /* Dark mode adjustments */
    .dark input,
    .dark select,
    .dark textarea {
        background-color: rgb(31, 41, 55);
        border-color: rgb(55, 65, 81);
        color: rgb(243, 244, 246);
    }

    /* File input styling */
    input[type="file"]::file-selector-button {
        transition: all 0.2s ease;
        cursor: pointer;
    }

    input[type="file"]::file-selector-button:hover {
        background-color: rgb(224, 231, 255);
    }
</style>

<!-- Booking Modal for Seated Event -->
<div id="bookingModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-6">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/70 backdrop-blur-sm" onclick="closeBookingModal()"></div>
        
        <!-- Modal Content -->
        <div class="relative w-full max-w-lg p-6 mx-auto bg-purple-950/95 border border-purple-900/80 rounded-3xl shadow-2xl text-white animate-fade-in">
            <!-- Close Button -->
            <button onclick="closeBookingModal()" class="absolute top-4 right-4 text-purple-300 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <h3 class="text-2xl font-bold text-white mb-2 flex items-center gap-2">
                🎟️ Confirm Seat Booking
            </h3>
            <p class="text-purple-300 text-sm mb-6">
                You are booking seat <span id="modalSeatNumber" class="text-yellow-400 font-bold"></span>.
            </p>
            
            <form id="modalBookingForm" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Payment QR (if exists) -->
                @if($event->payment_qr)
                    <div class="p-4 text-center bg-purple-900/30 border border-purple-500/20 rounded-2xl">
                        <p class="mb-2 text-sm font-semibold text-purple-200">Scan to Pay</p>
                        <img src="/payment_qr/{{$event->payment_qr}}" class="w-40 mx-auto shadow-md rounded-xl" alt="Payment QR">
                    </div>
                @endif
                
                <!-- Price Info -->
                <div class="p-4 bg-purple-900/20 border border-purple-500/20 rounded-xl flex justify-between items-center">
                    <span class="text-purple-200">Total Price:</span>
                    <span class="text-2xl font-bold text-yellow-400">₹{{ number_format($event->price, 2) }}</span>
                </div>
                
                <!-- Upload Screenshot -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-purple-200">
                        Upload Payment Screenshot
                    </label>
                    <input type="file"
                           name="payment_screenshot"
                           class="w-full px-4 py-3 bg-purple-950/40 border border-purple-500/30 rounded-xl text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-900 file:text-purple-200 hover:file:bg-purple-800"
                           accept="image/*"
                           required>
                    <p class="mt-1 text-xs text-purple-400/80">Accepted formats: JPG, PNG (Max 5MB)</p>
                </div>
                
                <!-- Warning Notice -->
                <div class="flex gap-3 p-4 border-l-4 border-yellow-500 bg-yellow-500/10 rounded-r-xl">
                    <svg class="flex-shrink-0 w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <p class="text-xs text-yellow-200/80">
                        Please upload a valid payment receipt. Booking is not completed without screenshot validation.
                    </p>
                </div>
                
                <!-- Submit -->
                <button type="submit" class="w-full py-4 font-bold text-white transition-all bg-gradient-to-r from-purple-600 to-yellow-500 hover:from-purple-700 hover:to-yellow-600 hover:scale-105 shadow-lg rounded-xl">
                    🎟️ Confirm Booking & Pay
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openBookingModal(seatId, seatNumber) {
    const modal = document.getElementById('bookingModal');
    const seatSpan = document.getElementById('modalSeatNumber');
    const form = document.getElementById('modalBookingForm');
    
    seatSpan.textContent = seatNumber;
    form.action = `/seat/book/${seatId}`;
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeBookingModal() {
    const modal = document.getElementById('bookingModal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}
</script>

@endsection
