<x-app-layout>
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
            transition: all 0.3s ease;
        }
        
        .glass-card:hover {
            border-color: rgba(234,179,8,0.4);
        }
        
        .input-glass {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255,255,255,0.15);
            transition: all 0.3s ease;
            font-size: 0.95rem;
            padding: 0.75rem 1rem;
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
        }
        
        .btn-primary:hover {
            transform: scale(1.02);
            box-shadow: 0 0 20px rgba(168,85,247,0.4);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            transition: all 0.3s ease;
        }
        
        .btn-danger:hover {
            transform: scale(1.02);
            box-shadow: 0 0 20px rgba(239,68,68,0.4);
        }
        
        label {
            color: #eab308;
            font-weight: 500;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            display: block;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-pink-900 py-12 px-4 sm:px-6 lg:px-8">
        
        <!-- Animated Background Orbs -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-72 h-72 bg-yellow-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-1000"></div>
            <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-2000"></div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 relative z-10">
            
            <!-- Profile Header Card -->
            <div class="glass-card rounded-2xl overflow-hidden animate-slide-up">
                <div class="bg-gradient-to-r from-purple-700 via-purple-600 to-yellow-500 px-8 py-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-500 to-yellow-500 flex items-center justify-center text-2xl font-bold text-white shadow-lg ring-4 ring-white/30">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">{{ __('Profile Settings') }}</h2>
                            <p class="text-yellow-200 text-sm mt-1">Manage your account information</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Update Profile Information -->
            <div class="glass-card rounded-2xl overflow-hidden animate-slide-up" style="animation-delay: 0.1s">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-yellow-500 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">{{ __('Profile Information') }}</h3>
                    </div>
                    
                    @include('profile.update-profile-information-form')
                </div>
            </div>
            
            <!-- Update Password -->
            <div class="glass-card rounded-2xl overflow-hidden animate-slide-up" style="animation-delay: 0.2s">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-500 to-orange-500 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">{{ __('Update Password') }}</h3>
                    </div>
                    
                    @include('profile.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="glass-card rounded-2xl overflow-hidden animate-slide-up" style="animation-delay: 0.3s">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">{{ __('Delete Account') }}</h3>
                    </div>
                    
                    @include('profile.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>