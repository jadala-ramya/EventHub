@extends('layouts.app')

@section('content')
<div class="max-w-3xl p-10 mx-auto mt-10 bg-white shadow-2xl rounded-3xl">
    <h1 class="mb-6 text-3xl font-bold text-gray-900">Organizer Request Approved</h1>

    <p class="mb-4 text-gray-700">Your request has been approved by the admin. Click the button below to complete your organizer registration and activate your organizer account.</p>

    <div class="mb-6 p-6 border border-gray-200 rounded-3xl bg-gray-50">
        <p class="font-semibold">Organization:</p>
        <p>{{ $requestModel->organization_name }}</p>

        <p class="mt-4 font-semibold">Event Details:</p>
        <p>{{ $requestModel->event_details }}</p>
    </div>

    <form action="{{ route('organizer.request.complete', $requestModel->id) }}" method="POST">
        @csrf
        <button type="submit" class="px-8 py-3 text-white bg-indigo-600 rounded-xl hover:bg-indigo-700">Continue Registration</button>
    </form>
</div>
@endsection
