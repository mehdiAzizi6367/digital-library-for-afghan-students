<x-guest-layout >
    <style>
          .min-h-screen, body {
           
            background-image: url('https://www.freepik.com/search?query=library') !important;
        background-size: cover;
        background-position: center;
            background-repeat: no-repeat;
    
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
            background-image: url('/assets/l2.jpg') !important;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            }
    </style>

    <form method="POST" class="register-card" action="{{ route('register') }}" >
        @csrf
          <h1 class="text-center"> Registraion page </h1>
        
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('message.name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('message.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 ">
            <x-input-label for="password" :value="__('message.password')" />
             <div class="user_password">
                <x-text-input id="password" class="block mt-1 w-full" type="password"
                name="password"
                required autocomplete="new-password" />
                <i class="fas fa-eye show_password" title="show password"></i>
                <span class="cross-sign">
                    <i class="fas fa-eye hidden" title="hide password"></i>
                </span>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('message.confirm_password')" />
         
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"   name="password_confirmation"
                 required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                <span class="mt-2 d-flex" style="margin-left:15px; margin-top: 15px;">
                    <input type="checkbox" class="checkbox " title="show password">
                    <input type="checkbox" class="checkbox1" checked  aria-colspan="hide password"> 
                </span>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('message.have_acount') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('message.register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
{{-- link component --}}
<x-link-component/>
