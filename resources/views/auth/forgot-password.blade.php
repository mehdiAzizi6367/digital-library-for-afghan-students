<x-guest-layout>
        <style>
          .min-h-screen, body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%) !important;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            margin: 0;
            display: flex !important;
            justify-content: center !important; 
            align-items: center !important;     
            min-height: 100vh !important;
        }
        .register-card{
           background: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 2.5rem;
            max-width: 450px;
            width: 100%;
            margin: auto;
            transition: transform 0.3s ease, box-shadow 0.3s ease;

        }
        body{
            background-image: url('/assets/O3SwJ6Qz2B9HTt7eo44oUo0FDdEZY8sEQHMwOpVAfcjSlj9BsosM0PI-B7yDwvLt9bcP702MxTO7pHk__R8E7bEYInZWCpynFzMteTl7XYZW64brfBkz5AQIBaBEIrbYn-LCKuJk2Er-zXJYcFscmk3YEnX7rbjg0GyuUr46tPCfbn5c_flfZyz0rz1Yjfpf.jpg') !important;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            }
    </style>
    <div class="mb-4 text-sm text-gray-600 " style="padding: 10px;">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('password.email') }} " class='register-card '>
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
