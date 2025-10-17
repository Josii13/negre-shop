<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

        <!-- Public CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        
        <style>
            /* Admin Navigation Override (si connecté) */
            @auth
                body {
                    padding-top: 0 !important;
                }
            @endauth

            /* Page Banner Styles */
            .page-banner {
                margin-top: 80px;
                padding: 5rem 2rem 3rem;
                background: linear-gradient(135deg, #FAFAFA 0%, #FFFFFF 100%);
                text-align: center;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }

            .banner-content {
                max-width: 800px;
                margin: 0 auto;
            }

            .banner-content h1 {
                font-size: 3.5rem;
                font-weight: 300;
                letter-spacing: -0.03em;
                margin-bottom: 1.5rem;
            }

            .banner-content p {
                font-size: 1.15rem;
                line-height: 1.8;
                color: #555;
                font-weight: 300;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .page-banner {
                    margin-top: 70px;
                    padding: 3rem 1.5rem 2rem;
                }

                .banner-content h1 {
                    font-size: 2.5rem;
                }

                .banner-content p {
                    font-size: 1.05rem;
                }
            }
        </style>

        @yield('styles')
    </head>
    <body>
        @auth
            @include('layouts.navigation')
        @else
            @include('layouts.public-navigation')
        @endauth

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        @guest
            @include('layouts.footer')
        @endguest

        <!-- Mobile menu toggle script -->
        <script>
            const menuBtn = document.getElementById('menuBtn');
            const navLinks = document.getElementById('navLinks');

            if (menuBtn && navLinks) {
                menuBtn.addEventListener('click', () => {
                    navLinks.classList.toggle('active');
                });
            }
        </script>

        <!-- Public JS -->
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/emailjs-handler.js') }}"></script>

        @yield('scripts')
    </body>
</html>
