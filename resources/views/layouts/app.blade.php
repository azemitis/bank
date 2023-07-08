<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        .flash-message {
            position: fixed;
            top: 90px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 35px;
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            max-width: calc(100% - 70px);
        }

        .flash-success {
            background-color: #008000;
            color: #ffffff;
        }

        .flash-error {
            background-color: #ff0000;
            color: #ffffff;
        }

        .flash-message.show {
            opacity: 1;
        }

        @keyframes flash {
            0% {
                background-color: inherit;
            }
            50% {
                background-color: #00ff00;
            }
            100% {
                background-color: inherit;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <footer>
        <div class="w-full max-w-screen-xl mx-auto p-2 md:py-4">
            <div class="flex justify-center">
                <ul class="flex flex-wrap items-center space-x-4 sm:space-x-6 text-sm font-medium text-gray-500 sm:mb-0
                dark:text-gray-400">
                    <li>
                        <a href="#" class="mr-2 hover:underline">About</a>
                    </li>
                    <li>
                        <a href="#" class="mr-2 hover:underline">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="mr-2 hover:underline">Licensing</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
            <span class="mt-4 block text-sm text-gray-500 sm:text-center dark:text-gray-400">
            © 2023 <a href="#" class="hover:underline">Your bank</a>. All Rights Reserved.
        </span>
        </div>
    </footer>
</div>
</body>
</html>
