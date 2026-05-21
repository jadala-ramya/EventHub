@extends('layouts.app')

@section('content')

<style>
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes glow-pulse {
        0%, 100% { box-shadow: 0 0 5px rgba(168,85,247,0.3); }
        50% { box-shadow: 0 0 20px rgba(234,179,8,0.4); }
    }
    
    .animate-slide-up {
        animation: slide-up 0.5s ease-out forwards;
    }
    
    .glass-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.15);
    }
    
    .input-glass {
        background: rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(255,255,255,0.15);
        transition: all 0.3s ease;
        font-size: 1rem;
        padding: 1rem 1.25rem;
    }
    
    .input-glass:focus {
        background: rgba(0, 0, 0, 0.6);
        border-color: #eab308;
        outline: none;
        box-shadow: 0 0 15px rgba(234,179,8,0.3);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #a855f7, #eab308);
        transition: all 0.3s ease;
        padding: 0.875rem 2rem;
    }
    
    .btn-primary:hover {
        transform: scale(1.02);
        box-shadow: 0 0 20px rgba(168,85,247,0.4);
    }
    
    .btn-secondary {
        background: linear-gradient(135deg, #eab308, #f59e0b);
        transition: all 0.3s ease;
        padding: 0.875rem 2rem;
    }
    
    .btn-secondary:hover {
        transform: scale(1.02);
        box-shadow: 0 0 20px rgba(234,179,8,0.4);
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-pink-900 py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Animated Background Orbs - Yellow Theme -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-72 h-72 bg-yellow-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-2000"></div>
    </div>

    <div class="max-w-5xl mx-auto relative z-10">
        
        <!-- Success/Error Messages -->
        @if(session('success'))
        <div class="mb-6 p-5 bg-green-500/20 border border-green-500/50 rounded-2xl text-green-300 backdrop-blur-sm animate-slide-up">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-5 bg-red-500/20 border border-red-500/50 rounded-2xl text-red-300 backdrop-blur-sm animate-slide-up">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                {{ session('error') }}
            </div>
        </div>
        @endif

        <!-- Main Profile Card -->
        <div class="glass-card rounded-3xl overflow-hidden shadow-2xl animate-slide-up">
            
            <!-- Profile Header - Yellow Theme -->
            <div class="relative p-8 md:p-10 bg-gradient-to-r from-purple-700 via-purple-600 to-yellow-500">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full filter blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-yellow-400/10 rounded-full filter blur-3xl"></div>
                
                <div class="relative flex flex-col md:flex-row items-center gap-6">
                    <!-- Avatar -->
                    <div class="relative">
                        <div class="w-28 h-28 rounded-full bg-gradient-to-br from-purple-500 to-yellow-500 flex items-center justify-center text-5xl font-bold text-white shadow-lg ring-4 ring-white/30">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="text-center md:text-left">
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            {{ auth()->user()->name }}
                        </h1>
                        <p class="mt-2 text-yellow-200">
                            {{ auth()->user()->email }}
                        </p>
                        <span class="inline-flex items-center gap-2 px-4 py-1.5 mt-3 text-sm bg-white/20 backdrop-blur-sm rounded-full text-white">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            {{ ucfirst(auth()->user()->role ?? 'Member') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid md:grid-cols-2 gap-8 p-8 md:p-10">
                
                <!-- Update Profile Section -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-yellow-500 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white">
                            Update Profile
                        </h2>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-yellow-300">
                                Full Name
                            </label>
                            <input type="text"
                                   name="name"
                                   value="{{ auth()->user()->name }}"
                                   class="w-full rounded-xl input-glass text-white placeholder-white/40 focus:outline-none">
                            @error('name')
                                <p class="mt-1 text-yellow-300 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-semibold text-yellow-300">
                                Email Address
                            </label>
                            <input type="email"
                                   name="email"
                                   value="{{ auth()->user()->email }}"
                                   class="w-full rounded-xl input-glass text-white placeholder-white/40 focus:outline-none">
                            @error('email')
                                <p class="mt-1 text-yellow-300 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn-primary w-full rounded-xl text-white font-semibold shadow-lg flex items-center justify-center gap-2 group">
                            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save Changes
                        </button>
                    </form>
                </div>

                <!-- Security Section -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-500 to-orange-500 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white">
                            Security
                        </h2>
                    </div>

                    <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-yellow-300">
                                Current Password
                            </label>
                            <input type="password"
                                   name="current_password"
                                   class="w-full rounded-xl input-glass text-white placeholder-white/40 focus:outline-none">
                            @error('current_password')
                                <p class="mt-1 text-yellow-300 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-semibold text-yellow-300">
                                New Password
                            </label>
                            <input type="password"
                                   name="new_password"
                                   class="w-full rounded-xl input-glass text-white placeholder-white/40 focus:outline-none">
                            @error('new_password')
                                <p class="mt-1 text-yellow-300 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-semibold text-yellow-300">
                                Confirm New Password
                            </label>
                            <input type="password"
                                   name="new_password_confirmation"
                                   class="w-full rounded-xl input-glass text-white placeholder-white/40 focus:outline-none">
                        </div>

                        <button type="submit" class="btn-secondary w-full rounded-xl text-white font-semibold shadow-lg flex items-center justify-center gap-2 group">
                            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Update Password
                        </button>
                    </form>
                </div>
            </div>

            <!-- Footer Stats - Yellow Theme -->
            <div class="border-t border-white/10 p-6 bg-white/5">
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <div class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-yellow-400 bg-clip-text text-transparent">Member</div>
                        <div class="text-xs text-gray-400 mt-1">Since 2024</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold bg-gradient-to-r from-yellow-400 to-orange-400 bg-clip-text text-transparent">Active</div>
                        <div class="text-xs text-gray-400 mt-1">Status</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent">Verified</div>
                        <div class="text-xs text-gray-400 mt-1">Account</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection