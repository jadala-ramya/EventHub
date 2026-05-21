@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-2xl font-bold mb-6">Organizer Requests</h1>

    @if(session('status'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded">{{ session('status') }}</div>
    @endif

    <div class="overflow-x-auto bg-gray-900 p-4 rounded-lg">
        <table class="min-w-full text-left divide-y divide-gray-700">
            <thead>
                <tr class="text-sm text-gray-300">
                    <th class="p-2">#</th>
                    <th class="p-2">User</th>
                    <th class="p-2">Full Name</th>
                    <th class="p-2">Organization</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Phone</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Submitted</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-200 divide-y divide-gray-800">
                @forelse($requests as $r)
                    <tr>
                        <td class="p-2">{{ $r->id }}</td>
                        <td class="p-2">{{ optional($r->user)->email ?? '—' }}</td>
                        <td class="p-2">{{ $r->full_name }}</td>
                        <td class="p-2">{{ $r->organization_name }}</td>
                        <td class="p-2">{{ $r->contact_email ?? optional($r->user)->email ?? '—' }}</td>
                        <td class="p-2">{{ $r->phone }}</td>
                        <td class="p-2">{{ ucfirst($r->status) }}</td>
                        <td class="p-2">{{ $r->created_at->diffForHumans() }}</td>
                        <td class="p-2">
                            @if($r->status !== 'approved')
                                <form action="{{ route('admin.organizer_requests.approve', $r->id) }}" method="POST" onsubmit="return confirm('Approve this request?');">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 text-sm font-semibold text-white bg-green-600 rounded">Approve</button>
                                </form>
                            @else
                                <span class="px-3 py-1 text-sm font-semibold text-gray-300 bg-gray-700 rounded">Approved</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-4 text-center" colspan="9">No requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
