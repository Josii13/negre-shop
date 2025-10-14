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
    <link rel="stylesheet" href="{{ asset('css/modals.css') }}">
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

    <!-- Modales Globales -->
    <!-- Modal de succès -->
    <div id="globalSuccessModal" class="success-modal">
        <div class="success-modal-content">
            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <h2>Succès !</h2>
            <p class="success-message">Votre demande a été prise en compte avec succès.</p>
            <p class="success-sub-message">Un email de confirmation vous sera envoyé sous peu.</p>
            <p class="loading-container" style="margin-top: 1.5rem; font-size: 0.9rem; color: #999;">
                <span id="loadingText">Envoi de la confirmation</span>
                <span class="loading-spinner"></span>
            </p>
        </div>
    </div>

    <!-- Modal d'erreur -->
    <div id="globalErrorModal" class="error-modal">
        <div class="error-modal-content">
            <div class="error-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <h2>Erreur</h2>
            <p class="error-message">Une erreur est survenue.</p>
            <p class="error-sub-message">Veuillez réessayer ultérieurement.</p>
            <button class="modal-close-btn" onclick="closeErrorModal()">Fermer</button>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- EmailJS SDK -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <!-- EmailJS Handler Global -->
    <script src="{{ asset('js/emailjs-handler.js') }}"></script>
    <!-- Configuration depuis .env -->
    <script>
        // Initialiser la configuration EmailJS depuis le serveur
        @if(isset($emailjsConfig))
        setEmailJSConfig(@json($emailjsConfig));
        @endif
    </script>
    @yield('scripts')
</body>
</html>

