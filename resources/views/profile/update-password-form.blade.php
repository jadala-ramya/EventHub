<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="block text-sm font-medium text-yellow-300 mb-2">{{ __('Current Password') }}</label>
            <input id="current_password" name="current_password" type="password" class="input-glass w-full rounded-xl" autocomplete="current-password">
            @error('current_password')
                <p class="mt-1 text-yellow-300 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-yellow-300 mb-2">{{ __('New Password') }}</label>
            <input id="password" name="password" type="password" class="input-glass w-full rounded-xl" autocomplete="new-password">
            @error('password')
                <p class="mt-1 text-yellow-300 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-yellow-300 mb-2">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="input-glass w-full rounded-xl" autocomplete="new-password">
            @error('password_confirmation')
                <p class="mt-1 text-yellow-300 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary px-6 py-2.5 rounded-xl text-white font-semibold">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-green-300 bg-green-600 px-4 py-2 rounded-lg shadow-md">
                    ✓ {{ __('Password updated successfully!') }}
                </p>
            @endif
        </div>
    </form>
</section>