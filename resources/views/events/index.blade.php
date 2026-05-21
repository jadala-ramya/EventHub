@extends('layouts.app')

@section('content')

<div class="p-10 mx-auto max-w-7xl">

    <div class="flex items-center justify-between mb-10">

        <h1 class="text-4xl font-bold">
            Events
        </h1>

        @auth

            @if(auth()->user()->role == 'organizer')

                <a href="{{ route('events.create') }}"
                   class="px-6 py-3 text-white bg-purple-600 rounded-xl">

                    Create Event

                </a>

            @endif

        @endauth

    </div>

    <div class="grid gap-8 md:grid-cols-3">

        @forelse($events as $event)

            <div class="overflow-hidden bg-white shadow rounded-2xl">

                @if($event->image)

                    <img src="/events/{{$event->image}}"
                         class="object-cover w-full h-56">

                @endif

                <div class="p-6">

                    <h2 class="mb-3 text-2xl font-bold">
                        {{$event->title}}
                    </h2>

                    <p class="mb-2">
                        {{$event->venue}}
                    </p>

                    <p class="text-xl font-bold text-purple-600">
                        ₹{{$event->price}}
                    </p>

                </div>

            </div>

        @empty

            <p>No events available.</p>

        @endforelse

    </div>

</div>

@endsection
