<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('all.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap.css') }}">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
            @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-check-circle"></i> {{ session('error') }} <a href="{{ route('home') }}">click to contact Admin!</a>
        </div>
     @endif
        <!-- Email Address -->
     

        <div>
            <x-input-label for="email" :value="__('message.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" autocomplete="off" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('message.password')" />
            <div class="user_password d-flex ">

                <x-text-input id="password1" class="block mt-1 w-full pass " autocomplete="off" type="password" name="password" required autocomplete="current-password" />
          
                <div class="cross-sign d-flex align-baseline mt-3"style="position: relative; disply:flex; margin-left:-20px">
                           <i class="fas fa-eye  show1 text-primary" title="show Password" ></i>
                           <i class="fas fa-eye hide1 " style="position:absolute;" title="Hide password "></i> 
                 </div>

            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('message.remember') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('message.forgot') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('message.login') }}
            </x-primary-button>
        </div>
    </form>
    </x-guest-layout>
<script>
    let eye=document.querySelector('.fa-eye');
    let pass=document.querySelector('.pass');
    let show=document.querySelector(".show1");
    let hide=document.querySelector(".hide1");
 

     show.addEventListener('click',function(){
         pass.type="text";
         show.style.visibility="hidden";
         hide.style.visibility="visible";

     });
     hide.addEventListener("click",function(){
        pass.type="password";
        show.style.visibility="visible";
         hide.style.visibility="hidden";
     });


</script>
