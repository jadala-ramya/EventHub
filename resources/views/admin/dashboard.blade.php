@extends('layouts.app')

@section('content')

<style>
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-slide-up {
        animation: slide-up 0.5s ease-out forwards;
    }
    
    .glass-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.06) 0%, rgba(255,255,255,0.02) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.08);
    }
    
    .text-glow-yellow {
        text-shadow: 0 0 15px rgba(234,179,8,0.4);
    }
    
    .text-glow-pink {
        text-shadow: 0 0 15px rgba(236,72,153,0.4);
    }
    
    .text-glow-purple {
        text-shadow: 0 0 15px rgba(168,85,247,0.4);
    }
    
    .text-glow-indigo {
        text-shadow: 0 0 15px rgba(99,102,241,0.4);
    }
    
    .text-glow-green {
        text-shadow: 0 0 15px rgba(34,197,94,0.4);
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-pink-900 py-12 px-6 lg:px-8 text-white relative overflow-hidden">
    
    <!-- Animated Background Orbs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-20 left-10 w-96 h-96 bg-purple-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-pink-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-yellow-500/5 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-2000"></div>
    </div>

    <div class="max-w-7xl mx-auto relative z-10 animate-slide-up">
        
        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-10 gap-4">
            <div>
                <h1 class="text-5xl font-black tracking-tight text-white">
                    Admin <span class="bg-gradient-to-r from-purple-400 to-yellow-400 bg-clip-text text-transparent">Dashboard</span>
                </h1>
                <p class="mt-3 text-lg text-purple-200">
                    Manage EventHub platform activities, users, and organizer requests.
                </p>
            </div>
            <div class="flex items-center gap-3 bg-white/5 border border-white/10 px-5 py-2.5 rounded-full backdrop-blur-md self-start sm:self-auto">
                <span class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></span>
                <span class="font-semibold text-green-400 text-glow-green text-sm">
                    System Active
                </span>
            </div>
        </div>

        <!-- STATS CARDS -->
        <div class="grid gap-6 mb-12 md:grid-cols-2 lg:grid-cols-5">
            <!-- Total Users -->
            <div class="p-6 transition-all duration-300 glass-card rounded-3xl hover:scale-[1.03] hover:shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-500/10 rounded-full filter blur-xl group-hover:bg-indigo-500/20 transition-all duration-300"></div>
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-purple-200">Total Users</h2>
                    <div class="p-2.5 rounded-2xl bg-indigo-500/10 text-indigo-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-4xl font-black text-indigo-400 text-glow-indigo">{{ $totalUsers }}</p>
            </div>

            <!-- Organizers -->
            <div class="p-6 transition-all duration-300 glass-card rounded-3xl hover:scale-[1.03] hover:shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-purple-500/10 rounded-full filter blur-xl group-hover:bg-purple-500/20 transition-all duration-300"></div>
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-purple-200">Organizers</h2>
                    <div class="p-2.5 rounded-2xl bg-purple-500/10 text-purple-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-4xl font-black text-purple-400 text-glow-purple">{{ $totalOrganizers }}</p>
            </div>

            <!-- Total Events -->
            <div class="p-6 transition-all duration-300 glass-card rounded-3xl hover:scale-[1.03] hover:shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-pink-500/10 rounded-full filter blur-xl group-hover:bg-pink-500/20 transition-all duration-300"></div>
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-purple-200">Total Events</h2>
                    <div class="p-2.5 rounded-2xl bg-pink-500/10 text-pink-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-4xl font-black text-pink-400 text-glow-pink">{{ $totalEvents }}</p>
            </div>

            <!-- Total Bookings -->
            <div class="p-6 transition-all duration-300 glass-card rounded-3xl hover:scale-[1.03] hover:shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-green-500/10 rounded-full filter blur-xl group-hover:bg-green-500/20 transition-all duration-300"></div>
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-purple-200">Total Bookings</h2>
                    <div class="p-2.5 rounded-2xl bg-green-500/10 text-green-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-4xl font-black text-green-400 text-glow-green">{{ $totalBookings }}</p>
            </div>

            <!-- Total Revenue -->
            <div class="p-6 transition-all duration-300 glass-card rounded-3xl hover:scale-[1.03] hover:shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-yellow-500/10 rounded-full filter blur-xl group-hover:bg-yellow-500/20 transition-all duration-300"></div>
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-purple-200">Total Revenue</h2>
                    <div class="p-2.5 rounded-2xl bg-yellow-500/10 text-yellow-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-3xl font-black text-yellow-400 text-glow-yellow">₹{{ number_format($totalRevenue, 0) }}</p>
            </div>
        </div>

        <!-- ORGANIZER REQUESTS SECTION -->
        <div class="p-8 mb-10 glass-card rounded-3xl shadow-2xl relative border border-white/10">
            <div class="flex flex-col justify-between mb-8 sm:flex-row sm:items-center gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold bg-gradient-to-r from-white to-purple-200 bg-clip-text text-transparent">Organizer Verification Requests</h2>
                    <p class="text-sm text-purple-300/80 mt-1">Review and manage organizer signups</p>
                </div>
                <span class="inline-flex px-4 py-2 text-sm font-bold text-yellow-300 bg-yellow-950/50 border border-yellow-500/30 rounded-full backdrop-blur-sm self-start sm:self-auto">
                    {{ $pendingRequestsCount }} Pending
                </span>
            </div>

            @if($organizerRequests->count() > 0)
                <div class="overflow-x-auto rounded-2xl border border-white/10">
                    <table class="min-w-full divide-y divide-white/10">
                        <thead class="bg-white/5">
                            <tr>
                                <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Email</th>
                                <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Full Name</th>
                                <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Organization</th>
                                <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Phone</th>
                                <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Request Details</th>
                                <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">ID Proof</th>
                                <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Status</th>
                                <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 bg-transparent">
                            @foreach($organizerRequests as $request)
                            <tr class="hover:bg-white/5 transition-all">
                                <td class="px-6 py-5 text-gray-300">{{ $request->user?->email ?? '—' }}</td>
                                <td class="px-6 py-5 font-semibold text-white">{{ $request->full_name }}</td>
                                <td class="px-6 py-5 text-gray-300">{{ $request->organization_name }}</td>
                                <td class="px-6 py-5 text-gray-300">{{ $request->phone }}</td>
                                <td class="px-6 py-5 text-gray-300 max-w-xl break-words">{{ \Illuminate\Support\Str::limit($request->event_details, 80) }}</td>
                                <td class="px-6 py-5 text-gray-300">
                                    @if($request->id_proof)
                                        <a href="{{ asset('storage/'.$request->id_proof) }}" target="_blank" class="text-sm font-bold text-indigo-400 hover:text-indigo-300 hover:underline transition-all">View Proof</a>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="px-6 py-5">
                                    <span class="px-3 py-1 text-xs font-bold text-yellow-300 bg-yellow-950/50 border border-yellow-500/30 rounded-full">
                                        {{ ucfirst($request->status ?? 'pending') }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex gap-3">
                                        <a href="{{ route('admin.approve', $request->id) }}"
                                           onclick="return confirm('Approve this organizer request?')"
                                           class="px-4 py-2 text-sm font-bold text-white transition bg-gradient-to-r from-green-600 to-emerald-500 rounded-xl hover:scale-105 shadow-md shadow-green-950/30">
                                            Approve
                                        </a>
                                        <a href="{{ route('admin.reject', $request->id) }}"
                                           onclick="return confirm('Reject this organizer request?')"
                                           class="px-4 py-2 text-sm font-bold text-white transition bg-gradient-to-r from-red-600 to-pink-600 rounded-xl hover:scale-105 shadow-md shadow-red-950/30">
                                            Reject
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="py-16 text-center">
                    <div class="mb-4 text-6xl">📭</div>
                    <h3 class="text-2xl font-bold text-white">No Pending Requests</h3>
                    <p class="mt-2 text-purple-300/80">All organizer requests have been processed.</p>
                </div>
            @endif
        </div>

        <!-- USER MANAGEMENT SECTION -->
        <div class="p-8 mt-10 glass-card rounded-3xl shadow-2xl relative border border-white/10">
            <div class="flex flex-col justify-between mb-8 sm:flex-row sm:items-center gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold bg-gradient-to-r from-white to-purple-200 bg-clip-text text-transparent">User Management</h2>
                    <p class="text-sm text-purple-300/80 mt-1">Manage platform users and access controls</p>
                </div>
                <span class="inline-flex px-4 py-2 text-sm font-bold text-red-300 bg-red-950/50 border border-red-500/30 rounded-full backdrop-blur-sm self-start sm:self-auto">
                    {{ $allUsers->count() }} Total Users
                </span>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-white/10">
                <table class="min-w-full divide-y divide-white/10">
                    <thead class="bg-white/5">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Name</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Email</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Role</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 bg-transparent">
                        @foreach($allUsers as $user)
                        <tr class="hover:bg-white/5 transition-all">
                            <td class="px-6 py-5 font-semibold text-white">{{ $user->name }}</td>
                            <td class="px-6 py-5 text-gray-300">{{ $user->email }}</td>
                            <td class="px-6 py-5">
                                @if($user->role == 'admin')
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-red-300 bg-red-950/50 border border-red-500/30 rounded-full">
                                        👑 Admin
                                    </span>
                                @elseif($user->role == 'organizer')
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-purple-300 bg-purple-950/50 border border-purple-500/30 rounded-full">
                                        🚀 Organizer
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-blue-300 bg-blue-950/50 border border-blue-500/30 rounded-full">
                                        👤 User
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                @if($user->role != 'admin')
                                    <form action="{{ route('admin.delete.user', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')"
                                            class="px-4 py-2 text-sm font-bold text-white transition bg-gradient-to-r from-red-600 to-pink-600 rounded-xl hover:scale-105 shadow-md shadow-red-950/30">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <span class="px-4 py-2 text-sm font-semibold text-purple-300/40 bg-purple-950/20 border border-purple-900/30 rounded-xl">Protected</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- EVENT MANAGEMENT -->
        <div class="p-8 mt-10 glass-card rounded-3xl shadow-2xl relative border border-white/10">
            <div class="flex flex-col justify-between mb-8 sm:flex-row sm:items-center gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold bg-gradient-to-r from-white to-purple-200 bg-clip-text text-transparent">Event Management</h2>
                    <p class="text-sm text-purple-300/80 mt-1">Monitor, suspend or reopen event bookings</p>
                </div>
                <span class="inline-flex px-4 py-2 text-sm font-bold text-pink-300 bg-pink-950/50 border border-pink-500/30 rounded-full backdrop-blur-sm self-start sm:self-auto">
                    {{ $allEvents->count() }} Events
                </span>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-white/10">
                <table class="min-w-full divide-y divide-white/10">
                    <thead class="bg-white/5">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Event</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Type</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Price</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Status</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-purple-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 bg-transparent">
                        @foreach($allEvents as $event)
                        <tr class="hover:bg-white/5 transition-all">
                            <td class="px-6 py-5 font-semibold text-white">{{ $event->title }}</td>
                            <td class="px-6 py-5">
                                @if($event->event_type == 'seated')
                                    <span class="px-3 py-1 text-xs font-bold text-purple-300 bg-purple-950/50 border border-purple-500/30 rounded-full">🎟️ Seated</span>
                                @else
                                    <span class="px-3 py-1 text-xs font-bold text-orange-300 bg-orange-950/50 border border-orange-500/30 rounded-full">🎵 Standing</span>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-gray-300 font-semibold">₹{{ $event->price }}</td>
                            <td class="px-6 py-5">
                                @if($event->status == 'closed')
                                    <span class="px-3 py-1 text-xs font-bold text-red-300 bg-red-950/50 border border-red-500/30 rounded-full">🔒 Closed</span>
                                @else
                                    <span class="px-3 py-1 text-xs font-bold text-green-300 bg-green-950/50 border border-green-500/30 rounded-full">✅ Active</span>
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex flex-wrap gap-3">
                                    @if($event->status != 'closed')
                                        <a href="{{ route('admin.close.booking', $event->id) }}"
                                           onclick="return confirm('Close bookings for this event?')"
                                           class="px-4 py-2 text-sm font-bold text-white transition bg-gradient-to-r from-yellow-600 to-orange-500 rounded-xl hover:scale-105 shadow-md shadow-yellow-950/30">
                                            Close Booking
                                        </a>
                                    @else
                                        <a href="{{ route('admin.open.booking', $event->id) }}"
                                           onclick="return confirm('Reopen bookings?')"
                                           class="px-4 py-2 text-sm font-bold text-white transition bg-gradient-to-r from-green-600 to-emerald-500 rounded-xl hover:scale-105 shadow-md shadow-green-950/30">
                                            Reopen
                                        </a>
                                    @endif

                                    <form action="{{ route('admin.delete.event', $event->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Delete this event permanently?')"
                                            class="px-4 py-2 text-sm font-bold text-white transition bg-gradient-to-r from-red-600 to-pink-600 rounded-xl hover:scale-105 shadow-md shadow-red-950/30">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
