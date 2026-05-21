<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-medium text-yellow-300 mb-2">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="input-glass w-full rounded-xl" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <p class="mt-1 text-yellow-300 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-yellow-300 mb-2">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="input-glass w-full rounded-xl" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <p class="mt-1 text-yellow-300 text-xs">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-400">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-yellow-400 hover:text-yellow-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-white bg-green-600 px-3 py-2 rounded-lg shadow-md inline-block">
                            ✓ {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary px-6 py-2.5 rounded-xl text-white font-semibold">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-green-300 bg-green-600 px-4 py-2 rounded-lg shadow-md">
                    ✓ {{ __('Profile updated successfully!') }}
                </p>
            @endif
        </div>
    </form>
</section>