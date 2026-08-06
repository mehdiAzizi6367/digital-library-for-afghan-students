<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ in_array(app()->getLocale(), ['ps']) ? 'rtl' : 'ltr' }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Beautiful Premium UI/UX Gradient Base directly inside the layout skeleton */
           
            /* Seamlessly blend layout defaults with your high-end design variables */
            .app-login-card {
                border: none !important;
                border-radius: 16px !important;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
                transition: transform 0.3s ease, box-shadow 0.3s ease !important;
            }
            .app-login-card:hover {
                transform: translateY(-2px) !important;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08) !important;
            }
            body{
            background-image: url('/assets/l2.jpg') !important;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            }
          
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased"  >
        <!-- Replaced standard bg-gray-100 with your beautiful premium gradient layout framework -->
        <div class="w-75 flex flex-col sm:justify-center items-center pt-6 sm:pt-0  app-guest-bg" >
    
            <!-- Enhanced the inner card with matching shadow mechanics and soft corner rounds -->
            <div class="w-full sm:max-w-md mt-4 px-8 py-8 bg-white overflow-hidden app-login-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
