<section class="w-full md:w-1/2 border-t-4 border-blue-900 bg-white p-6 rounded-md shadow-lg space-y-6">
    <header>
        <h2 class="text-lg font-medium text-black">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-black">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" class="bg-red-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500" onclick="document.querySelector('[x-data]').dispatchEvent(new CustomEvent('open-modal', { detail: 'confirm-user-deletion' }))">
        {{ __('Delete Account') }}
    </button>

    <div id="confirm-user-deletion" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-md shadow-lg w-full md:w-1/2">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-black">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-black">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                    <input id="password" name="password" type="password" class="mt-1 block w-3/4 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500" placeholder="{{ __('Password') }}" />
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500" onclick="document.getElementById('confirm-user-deletion').classList.add('hidden')">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ms-3">
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
