<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" class="btn-danger px-6 py-2.5 rounded-xl text-white font-semibold" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input id="password" name="password" type="password" class="input-glass w-full rounded-xl" placeholder="{{ __('Password') }}">
                @error('userDeletion')
                    <p class="mt-1 text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" class="px-4 py-2 rounded-xl bg-gray-600 text-white hover:bg-gray-700 transition" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </button>
                <button type="submit" class="btn-danger px-4 py-2 rounded-xl text-white font-semibold">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>