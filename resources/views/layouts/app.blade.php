<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

        <!-- Load jQuery (Required for Select2) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Load FontAwesome for Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


        <!-- Load Select2 CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


        <style>
            .logo_pojok>img
            {
                width  :40px !important;
            }
            .deskripsi>ol
            {
                list-style: auto;
                padding: revert;
            }

            /* Select2 default styling */
            .select2-container .select2-selection--multiple {
                background-color: #ffffff; /* Light mode */
                border: 1px solid #ccc;
                color: #000;
                padding: 5px;
                border-radius: 6px;
            }

            /* Select2 dropdown styling */
            .select2-container--default .select2-results__option {
                background-color: #ffffff; /* Light mode */
                color: #000;
            }

            /* Select2 hover effect */
            .select2-container--default .select2-results__option--highlighted[aria-selected] {
                background-color: #4f46e5;
                color: #ffffff;
            }

            /* === Mode Dark === */
            .dark .select2-container .select2-selection--multiple {
                background-color: #1e293b !important; /* Dark Mode Background */
                border: 1px solid #334155 !important;
                color: #e5e7eb !important;
            }

            /* Mengubah warna teks dalam dropdown */
            .dark .select2-container--default .select2-results__option {
                background-color: #1e293b !important;
                color: #e5e7eb !important;
            }

            /* Saat dropdown Select2 dibuka */
            .dark .select2-container--default .select2-dropdown {
                background-color: #1e293b !important;
                border: 1px solid #334155 !important;
                color: #e5e7eb !important;
            }

            /* Saat hover dalam mode dark */
            .dark .select2-container--default .select2-results__option--highlighted[aria-selected] {
                background-color: #4f46e5 !important;
                color: #ffffff !important;
            }

            /* Select2 selected option in dark mode */
            .dark .select2-container--default .select2-selection__choice {
                background-color: #334155 !important;
                color: #ffffff !important;
                border: 1px solid #475569 !important;
            }

            /* Close button inside selected item */
            .dark .select2-container--default .select2-selection__choice__remove {
                color: #e5e7eb !important;
            }

            /* Close button on hover */
            .dark .select2-container--default .select2-selection__choice__remove:hover {
                color: #ff4c4c !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {!! $header !!}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const themeToggle = document.getElementById('theme-toggle');
                const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
                const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

                // Cek mode saat ini dari localStorage
                if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                    themeToggleDarkIcon.classList.remove('hidden');
                } else {
                    document.documentElement.classList.remove('dark');
                    themeToggleLightIcon.classList.remove('hidden');
                }

                // Saat tombol toggle ditekan
                themeToggle.addEventListener('click', function () {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                        themeToggleDarkIcon.classList.add('hidden');
                        themeToggleLightIcon.classList.remove('hidden');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                        themeToggleLightIcon.classList.add('hidden');
                        themeToggleDarkIcon.classList.remove('hidden');
                    }
                });
            });
        </script>




        <!-- Load Select2 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <!-- Allow Additional Scripts -->
        @stack('scripts')
    </body>
</html>
