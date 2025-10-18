<!-- Navigation -->
<nav>
    <div class="nav-content">
        <div class="logo">
            <!-- <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo-image"> -->
            <span>FREDERIC N'DA</span>
        </div>
        <button class="mobile-menu-btn" id="menuBtn">☰</button>
        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><a href="{{ route('peinture') }}">Peinture</a></li>
            <li><a href="{{ route('design') }}">Design</a></li>
            <li><a href="{{ route('marques') }}">Marque</a></li>
            <li><a href="{{ route('gallery') }}">Gallery</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            @auth
                @if(in_array(Auth::user()->type, ['admin', 'super_admin']))
                    <li><a href="{{ route('dashboard') }}" style="background: #000; color: #fff; padding: 0.5rem 1rem; border-radius: 4px;">Dashboard</a></li>
                @endif
            @endauth
        </ul>
    </div>
</nav>

