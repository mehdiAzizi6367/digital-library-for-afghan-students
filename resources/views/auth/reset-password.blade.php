<x-guest-layout>

<!-- Clean outer wrapper for centering -->

        <!-- Single Card element containing the content -->
        <div class="reset-password-card">
            
            <!-- UX Context Headers -->
            <h2 class="card-title">{{ __('Reset your password') }}</h2>
            <p class="card-subtitle">{{ __('Please enter your details to create a secure new password.') }}</p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
        
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
        
                <!-- Email Address -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email Address')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
        
                <!-- Password -->
                <div class="form-group">
                    <x-input-label for="password" :value="__('New Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        
                <!-- Confirm Password -->
                <div class="form-group">
                    <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
        
                <!-- Call to Action -->
                <div class="flex items-center justify-end mt-6">
                    <x-primary-button style="width: 100%; justify-content: center; padding: 0.75rem 1rem; font-weight: 600;">
                        {{ __('Update Password') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
        
</x-guest-layout>