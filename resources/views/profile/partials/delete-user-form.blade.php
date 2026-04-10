<section class="space-y-6">

    <!-- Header -->
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('profile.delete_acount') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('profile.delete_acount_information') }}
        </p>
    </header>

    <!-- Delete Button -->
    <x-danger-button
        x-data="{}"
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        {{ __('profile.delete_acount') }}
    </x-danger-button>

    <!-- Confirmation Modal -->
    @php
        $showModal = $errors->userDeletion->isNotEmpty() ?? false;
    @endphp

    <x-modal name="confirm-user-deletion" :show="$showModal" focusable>
        <form method="POST" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('profile.confirm_acount_delete') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('profile.delete_acount_information') }}
            </p>

            <!-- Password Input -->
            <div class="mt-6">
                <x-input-label for="password" value="{{ __('message.password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('message.password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <!-- Buttons -->
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('message.cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('profile.delete_acount') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

</section>