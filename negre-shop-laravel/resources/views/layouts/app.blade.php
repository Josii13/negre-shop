<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Frederic N\'DA - Artiste Peintre & Designer')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-content">
            <div class="logo">
                <span>FREDERIC N'DA</span>
            </div>
            <button class="mobile-menu-btn" id="menuBtn">☰</button>
            <ul class="nav-links" id="navLinks">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a></li>
                <li><a href="{{ route('peinture') }}" class="{{ request()->routeIs('peinture') ? 'active' : '' }}">Peinture</a></li>
                <li><a href="{{ route('design') }}" class="{{ request()->routeIs('design') ? 'active' : '' }}">Design</a></li>
                <li><a href="{{ route('marque') }}" class="{{ request()->routeIs('marque') ? 'active' : '' }}">Marque</a></li>
                <li><a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contenu principal -->
    @yield('content')

    <!-- Footer -->
    <footer>
        <p>© {{ date('Y') }} Frederic N'DA. Tous droits réservés.</p>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
    @yield('scripts')
</body>
</html>

