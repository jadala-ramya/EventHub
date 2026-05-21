@extends('layouts.app')

@section('content')

<div class="p-10 mx-auto max-w-7xl">

    <!-- Header -->
    <div class="mb-12">
        <h1 class="mb-4 text-5xl font-black bg-gradient-to-r from-purple-400 to-yellow-400 bg-clip-text text-transparent">
            🔍 Search Events
        </h1>
        <p class="text-xl text-purple-200">
            Find events based on your interests.
        </p>
    </div>

    <!-- Search Filters -->
    <div class="p-8 mb-16 backdrop-blur-xl bg-white/5 border border-white/10 shadow-2xl rounded-3xl">

        <form method="GET"
              action="{{ route('search.events') }}">

            <div class="grid items-end grid-cols-1 gap-6 md:grid-cols-4">

                <!-- Search -->
                <div>
                    <label class="block mb-2 font-semibold text-purple-200">
                        Search Event
                    </label>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Concert, Workshop..."
                           class="w-full p-4 bg-purple-950/40 border border-purple-500/30 rounded-2xl text-white placeholder-purple-300/50 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                </div>

                <!-- Venue -->
                <div>
                    <label class="block mb-2 font-semibold text-purple-200">
                        Venue
                    </label>
                    <input type="text"
                           name="venue"
                           value="{{ request('venue') }}"
                           placeholder="Mumbai, Delhi..."
                           class="w-full p-4 bg-purple-950/40 border border-purple-500/30 rounded-2xl text-white placeholder-purple-300/50 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                </div>

                <!-- Price -->
                <div>
                    <label class="block mb-2 font-semibold text-purple-200">
                        Max Price
                    </label>
                    <input type="number"
                           name="price"
                           value="{{ request('price') }}"
                           placeholder="1000"
                           class="w-full p-4 bg-purple-950/40 border border-purple-500/30 rounded-2xl text-white placeholder-purple-300/50 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                </div>

                <!-- Button -->
                <div>
                    <button type="submit"
                            class="w-full py-4 text-lg font-bold text-white bg-gradient-to-r from-purple-600 to-yellow-500 hover:from-purple-700 hover:to-yellow-600 transition rounded-2xl shadow-lg">
                        🔍 Search
                    </button>
                </div>

            </div>

        </form>

    </div>

    <!-- Results -->
    <div class="grid gap-10 md:grid-cols-3">

        @forelse($events as $event)

            <div class="overflow-hidden backdrop-blur-xl bg-white/5 border border-white/10 shadow-2xl rounded-3xl hover:border-purple-500/50 transition-all duration-300 text-white">

                <!-- Image -->
                @if($event->image)
                    <img src="/events/{{$event->image}}"
                         class="object-cover w-full h-64">
                @else
                    <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=1400&auto=format&fit=crop"
                         class="object-cover w-full h-64">
                @endif

                <!-- Content -->
                <div class="p-6">

                    <h2 class="mb-3 text-3xl font-bold text-white">
                        {{$event->title}}
                    </h2>

                    <p class="mb-2 text-purple-200">
                        📍 {{$event->venue}}
                    </p>

                    <p class="mb-6 text-3xl font-bold text-yellow-400">
                        ₹{{$event->price}}
                    </p>

                    <a href="{{ route('events.show', $event->id) }}"
                       class="block py-4 text-xl font-bold text-center text-white bg-gradient-to-r from-purple-600 to-yellow-500 hover:from-purple-700 hover:to-yellow-600 transition rounded-2xl shadow-lg">
                        🎟️ Book Ticket
                    </a>

                </div>

            </div>

        @empty

            <div class="col-span-3 p-10 backdrop-blur-xl bg-white/5 border border-white/10 rounded-3xl text-center text-purple-200">
                <p class="text-2xl">
                    No matching events found.
                </p>
            </div>

        @endforelse

    </div>

</div>

@endsection
