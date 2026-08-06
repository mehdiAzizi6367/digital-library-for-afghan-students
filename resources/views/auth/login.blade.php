<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('all.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap.css') }}">

    <!-- Fixed UI/UX Layout CSS Isolation -->
    <style>
        /* Target the layout wrapper directly to fix background and centering issues */
        .min-h-screen, body {
               
            /* background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%) !important; */
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            margin: 0;
            display: flex !important;
            justify-content: center !important; 
            align-items: center !important;     
            min-height: 100vh !important;
        }
        
        .login-card {
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
        
        .login-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        }
        
        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .brand-icon {
            background: #eef2ff;
            color: #4f46e5;
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }
        
        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            display: block;
        }
        
        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .input-group-custom input {
            padding-right: 2.75rem !important;
            border-radius: 8px !important;
            border: 1px solid #d1d5db !important;
            transition: all 0.2s ease !important;
            height: 46px;
            width: 100%;
        }
        
        .input-group-custom input:focus {
            border-color: #4f46e5 !important;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1) !important;
            outline: none;
        }
        
        .password-toggle-wrapper {
            position: absolute;
            right: 12px;
            height: 100%;
            display: flex;
            align-items: center;
            z-index: 10;
            cursor: pointer;
        }
        
        .password-toggle-wrapper i {
            font-size: 1.1rem;
            color: #9ca3af;
            transition: color 0.2s ease;
        }
        
        .password-toggle-wrapper i:hover {
            color: #4f46e5;
        }
        
        .remember-forgot-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.25rem;
            margin-bottom: 1.5rem;
        }
        
        .checkbox-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 0.875rem;
            color: #4b5563;
        }
        
        .checkbox-label input {
            cursor: pointer;
            border-radius: 4px;
            border-color: #d1d5db;
            color: #4f46e5;
            transition: all 0.2s ease;
        }
        
        .forgot-link {
            font-size: 0.875rem;
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        
        .forgot-link:hover {
            color: #3730a3;
            text-decoration: underline;
        }
        
        .submit-btn-wrapper {
            margin-top: 1rem;
        }
        
        .submit-btn-wrapper button, .submit-btn-wrapper x-primary-button {
            width: 100%;
            height: 46px;
            justify-content: center;
            background-color: #4f46e5 !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            letter-spacing: 0.025em;
            transition: all 0.2s ease !important;
        }
        
        .submit-btn-wrapper button:hover, .submit-btn-wrapper x-primary-button:hover {
            background-color: #4338ca !important;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25) !important;
        }
        
        .alert-custom {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            border: none;
        }
    </style>

    <!-- UI/UX Design Content Wrapper Container -->
    <div class="login-card">
        <div class="brand-header">
            <div class="brand-icon">
            <a href="{{route('home')}}">
                <x-application-logo class="w-48 h-48 fill-current text-indigo-600" />
            </a>
            </div>
            <h2 style="font-size: 1.5rem; font-weight: 700; color: #111827; margin: 0;">Welcome Back</h2>
            <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem;">Please enter your details to sign in</p>
        </div>

        <!-- Session Status Notifications -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            @if(session('error'))
                <div class="alert alert-danger alert-custom d-flex align-items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i> 
                    <div>
                        {{ session('error') }} 
                        <a href="{{ route('home') }}" class="alert-link font-medium underline">click to contact Admin!</a>
                    </div>
                </div>
            @endif

            <!-- Email Address Input Component -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('message.email')" class="form-label" />
                <div class="input-group-custom">
                    <x-text-input id="email" class="block w-full" type="email" autocomplete="off" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password Input Component -->
            <div class="mb-2">
                <x-input-label for="password1" :value="__('message.password')" class="form-label" />
                <div class="input-group-custom">
                    <x-text-input id="password1" class="block w-full pass" autocomplete="off" type="password" name="password" required autocomplete="current-password" />
                    
                    <div class="password-toggle-wrapper">
                        <i class="fas fa-eye show1" title="Show Password"></i>
                        <i class="fas fa-eye-slash hide1" style="display: none;" title="Hide Password"></i> 
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Context Operations Navigation Bar -->
            <div class="remember-forgot-container">
                <label for="remember_me" class="checkbox-label">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2">{{ __('message.remember') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        {{ __('message.forgot') }}
                    </a>
                @endif
            </div>

            <!-- Execution Action Wrapper Buttons -->
            <div class="submit-btn-wrapper">
                <x-primary-button>
                    {{ __('message.login') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pass = document.querySelector('.pass');
        const show = document.querySelector(".show1");
        const hide = document.querySelector(".hide1");
        const wrapper = document.querySelector(".password-toggle-wrapper");

        if (wrapper && pass && show && hide) {
            wrapper.addEventListener('click', function() {
                if (pass.type === "password") {
                    pass.type = "text";
                    show.style.display = "none";
                    hide.style.display = "block";
                } else {
                    pass.type = "password";
                    show.style.display = "block";
                    hide.style.display = "none";
                }
            });
        }
    });
</script>
