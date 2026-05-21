@extends('layouts.app')

@section('content')

<div class="max-w-3xl p-10 mx-auto bg-white shadow rounded-3xl">

    <h1 class="mb-10 text-4xl font-bold">
        Edit Event
    </h1>

    <form action="{{ route('events.update', $event->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-6">

            <label class="block mb-2 font-semibold">
                Event Title
            </label>

            <input type="text"
                   name="title"
                   value="{{$event->title}}"
                   class="w-full p-4 border rounded-xl">

        </div>

        <div class="mb-6">

            <label class="block mb-2 font-semibold">
                Description
            </label>

            <textarea name="description"
                      rows="5"
                      class="w-full p-4 border rounded-xl">{{$event->description}}</textarea>

        </div>

        <div class="mb-6">

            <label class="block mb-2 font-semibold">
                Venue
            </label>

            <input type="text"
                   name="venue"
                   value="{{$event->venue}}"
                   class="w-full p-4 border rounded-xl">

        </div>

        <div class="mb-6">

            <label class="block mb-2 font-semibold">
                Date
            </label>

            <input type="date"
                   name="date"
                   value="{{$event->date}}"
                   class="w-full p-4 border rounded-xl">

        </div>

        <div class="mb-6">

            <label class="block mb-2 font-semibold">
                Time
            </label>

            <input type="time"
                   name="time"
                   value="{{$event->time}}"
                   class="w-full p-4 border rounded-xl">

        </div>

        <div class="mb-6">

            <label class="block mb-2 font-semibold">
                Ticket Price
            </label>

            <input type="number"
                   name="price"
                   value="{{$event->price}}"
                   class="w-full p-4 border rounded-xl">

        </div>

        <div class="mb-8">

            <label class="block mb-2 font-semibold">
                Event Image
            </label>

            <input type="file"
                   name="image"
                   class="w-full p-3 border rounded-xl">

        </div>

        <button type="submit"
                class="w-full py-4 text-white bg-indigo-600 rounded-2xl">

            Update Event

        </button>

    </form>

</div>

@endsection
