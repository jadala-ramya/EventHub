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
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .animate-slide-up {
        animation: slide-up 0.5s ease-out forwards;
    }
    
    .animate-float {
        animation: float 4s ease-in-out infinite;
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
        padding: 0.875rem 1.25rem;
    }
    
    .input-glass:focus {
        background: rgba(0, 0, 0, 0.6);
        border-color: #eab308;
        outline: none;
        box-shadow: 0 0 15px rgba(234,179,8,0.3);
    }
    
    textarea.input-glass {
        padding: 0.875rem 1.25rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #a855f7, #eab308);
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: scale(1.02);
        box-shadow: 0 0 20px rgba(168,85,247,0.4);
    }
    
    label {
        color: #eab308;
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    /* File input styling */
    input[type="file"] {
        color: #eab308;
        cursor: pointer;
    }
    
    input[type="file"]::file-selector-button {
        background: linear-gradient(135deg, #a855f7, #eab308);
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.75rem;
        color: white;
        cursor: pointer;
        margin-right: 1rem;
        transition: all 0.3s ease;
    }
    
    input[type="file"]::file-selector-button:hover {
        transform: scale(1.02);
        box-shadow: 0 0 10px rgba(168,85,247,0.4);
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-pink-900 py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Animated Background Orbs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-72 h-72 bg-yellow-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-2000"></div>
    </div>

    <div class="max-w-3xl mx-auto relative z-10">
        
        <!-- Main Card -->
        <div class="glass-card rounded-3xl overflow-hidden shadow-2xl animate-slide-up">
            
            <!-- Header -->
            <div class="relative bg-gradient-to-r from-purple-700 via-purple-600 to-yellow-500 px-8 py-8">
                <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full filter blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-yellow-400/10 rounded-full filter blur-2xl"></div>
                
                <div class="relative flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500 to-yellow-500 flex items-center justify-center text-3xl shadow-lg animate-float">
                        🚀
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            Become an Organizer
                        </h1>
                        <p class="text-yellow-200 mt-1 text-sm">
                            Join our community of event creators
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="p-8 md:p-10">
                
                <!-- Login Warning for Guests -->
                @if(auth()->guest())
                <div class="mb-8 p-5 bg-yellow-500/20 border border-yellow-500/50 rounded-2xl backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <p class="text-yellow-300 text-sm">
                            You need to log in before submitting your organizer request.
                        </p>
                    </div>
                    <div class="flex gap-3 mt-4">
                        <a href="{{ route('login') }}" class="px-5 py-2 bg-gradient-to-r from-purple-600 to-yellow-500 rounded-xl text-white text-sm font-semibold hover:scale-105 transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-5 py-2 bg-white/10 border border-white/20 rounded-xl text-white text-sm font-semibold hover:bg-white/20 transition">
                            Register
                        </a>
                    </div>
                </div>
                @endif

                <form action="{{ route('become.organizer') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label>Full Name</label>
                        <input type="text"
                               name="full_name"
                               class="input-glass w-full rounded-xl text-white placeholder-white/40"
                               placeholder="Enter your full name"
                               required>
                    </div>

                    <!-- Contact Email -->
                    <div>
                        <label>Contact Email</label>
                        <input type="email"
                               name="contact_email"
                               class="input-glass w-full rounded-xl text-white placeholder-white/40"
                               placeholder="your@email.com"
                               required>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label>Phone Number</label>
                        <input type="text"
                               name="phone"
                               class="input-glass w-full rounded-xl text-white placeholder-white/40"
                               placeholder="+91 XXXXX XXXXX"
                               required>
                    </div>

                    <!-- Organization Name -->
                    <div>
                        <label>Organization Name</label>
                        <input type="text"
                               name="organization_name"
                               class="input-glass w-full rounded-xl text-white placeholder-white/40"
                               placeholder="Your organization/business name"
                               required>
                    </div>

                    <!-- Event Details -->
                    <div>
                        <label>Event Details</label>
                        <textarea name="event_details"
                                  rows="5"
                                  class="input-glass w-full rounded-xl text-white placeholder-white/40 resize-none"
                                  placeholder="Tell us about the events you want to organize..."></textarea>
                    </div>

                    <!-- ID Proof Upload -->
                    <div>
                        <label>Upload Valid ID Proof</label>
                        <input type="file"
                               name="id_proof"
                               class="input-glass w-full rounded-xl text-white"
                               accept=".pdf,.jpg,.jpeg,.png"
                               required>
                        <p class="text-gray-400 text-xs mt-1">Accepted formats: PDF, JPG, PNG (Max 5MB)</p>
                    </div>

                    <!-- Submit Button -->
                    @guest
                        <a href="{{ route('login') }}"
                           class="btn-primary w-full flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl text-white font-semibold shadow-lg text-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Login to Submit Request
                        </a>
                    @else
                        <button type="submit"
                                class="btn-primary w-full flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl text-white font-semibold shadow-lg group">
                            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Submit Request
                        </button>
                    @endguest
                </form>

                <!-- Footer Note -->
                <div class="mt-8 pt-6 border-t border-white/10 text-center">
                    <div class="flex items-center justify-center gap-2 text-gray-400 text-xs">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                        <span>We'll review your application within 2-3 business days</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="grid md:grid-cols-3 gap-4 mt-8">
            <div class="glass-card rounded-xl p-4 text-center">
                <div class="text-2xl mb-2">🎯</div>
                <p class="text-white text-sm font-semibold">Reach More Audience</p>
                <p class="text-gray-400 text-xs">Connect with thousands of event seekers</p>
            </div>
            <div class="glass-card rounded-xl p-4 text-center">
                <div class="text-2xl mb-2">📊</div>
                <p class="text-white text-sm font-semibold">Analytics Dashboard</p>
                <p class="text-gray-400 text-xs">Track your event performance</p>
            </div>
            <div class="glass-card rounded-xl p-4 text-center">
                <div class="text-2xl mb-2">💳</div>
                <p class="text-white text-sm font-semibold">Secure Payments</p>
                <p class="text-gray-400 text-xs">Get paid directly to your account</p>
            </div>
        </div>
    </div>
</div>

@endsection