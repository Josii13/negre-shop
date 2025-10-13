@extends('layouts.app')

@section('title', 'Frederic N\'DA - Artiste Peintre & Designer')

@section('styles')
<style>
    /* Carousel Section */
    .carousel-section {
        width: 100%;
        max-width: 1400px;
        margin: 100px auto 60px;
        padding: 0 2rem;
    }

    .carousel-container {
        position: relative;
        width: 100%;
        height: 600px;
        overflow: hidden;
        border-radius: 4px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .carousel-slides {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .carousel-slide {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.6s ease-in-out;
    }

    .carousel-slide.active {
        opacity: 1;
    }

    .carousel-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .carousel-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        color: white;
        padding: 3rem 2rem 2rem;
    }

    .carousel-caption h3 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        font-weight: 400;
        letter-spacing: -0.02em;
    }

    .carousel-caption p {
        font-size: 1.1rem;
        opacity: 0.9;
        font-weight: 300;
    }

    .carousel-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.95);
        border: none;
        color: #000000;
        font-size: 2rem;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    .carousel-btn:hover {
        background: #000000;
        color: #FFFFFF;
        transform: translateY(-50%) scale(1.1);
    }

    .carousel-btn.prev {
        left: 20px;
    }

    .carousel-btn.next {
        right: 20px;
    }

    .carousel-dots {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 10;
    }

    .dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dot.active {
        background: white;
        width: 30px;
        border-radius: 6px;
    }

    /* Hero Section */
    .hero {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem 4rem;
    }

    .hero-content {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 4rem;
        margin-bottom: 4rem;
        align-items: center;
    }

    .hero-image {
        width: 100%;
        height: 500px;
        overflow: hidden;
        border-radius: 4px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        background-color: #F7F7F7;
    }

    .hero-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .hero-image:hover img {
        transform: scale(1.05);
    }

    .hero-text {
        padding: 2rem 0;
    }

    .hero-text h1 {
        font-size: 3rem;
        font-weight: 300;
        margin-bottom: 2rem;
        letter-spacing: -0.03em;
    }

    .hero-text p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 1.5rem;
        font-weight: 300;
    }

    @media (max-width: 768px) {
        .carousel-section {
            margin: 80px auto 40px;
            padding: 0 1rem;
        }

        .carousel-container {
            height: 400px;
        }

        .hero-content {
            grid-template-columns: 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .hero-image {
            height: 400px;
        }

        .hero-text h1 {
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- Carousel Section -->
    <section class="carousel-section">
        <div class="carousel-container">
            <div class="carousel-slides" id="carouselSlides">
                @foreach($slides as $index => $slide)
                <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('images/' . $slide->image) }}" alt="{{ $slide->title }}">
                    <div class="carousel-caption">
                        <h3>{{ $slide->title }}</h3>
                        <p>{{ $slide->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-btn prev" id="prevBtn">‹</button>
            <button class="carousel-btn next" id="nextBtn">›</button>
            <div class="carousel-dots" id="carouselDots"></div>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-image">
                <img src="{{ asset('images/img2.jpg') }}" alt="Frederic N'DA">
            </div>
            <div class="hero-text">
                <h1>Frederic N'DA</h1>
                <p>Artiste peintre et designer ivoirien, Frederic N'DA développe un univers artistique où la peinture
                    contemporaine dialogue avec le design mobilier.</p>
                <p>Son travail explore les formes, les textures et les couleurs, créant des pièces uniques qui
                    transcendent les frontières entre l'art et le fonctionnel.</p>
                <p>Basé à Cocody, Abidjan, il conçoit chaque œuvre comme une invitation à la contemplation et à la
                    découverte.</p>
            </div>
        </div>

        <div class="category-cards">
            @foreach($categories as $category)
            <a href="{{ route($category->slug) }}" class="category-card">
                <img src="{{ asset('images/' . ($category->image ?? 'img1.jpg')) }}" alt="{{ $category->name }}">
                <div class="category-overlay">
                    <h2>{{ $category->name }}</h2>
                    <p class="category-desc">{{ $category->description }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Carousel functionality
    const slides = document.querySelectorAll('.carousel-slide');
    const dotsContainer = document.getElementById('carouselDots');
    let currentSlide = 0;

    // Create dots
    slides.forEach((_, index) => {
        const dot = document.createElement('span');
        dot.classList.add('dot');
        if (index === 0) dot.classList.add('active');
        dot.addEventListener('click', () => goToSlide(index));
        dotsContainer.appendChild(dot);
    });

    const dots = document.querySelectorAll('.dot');

    function showSlide(n) {
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));

        currentSlide = (n + slides.length) % slides.length;
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    function goToSlide(n) {
        showSlide(n);
    }

    document.getElementById('nextBtn').addEventListener('click', nextSlide);
    document.getElementById('prevBtn').addEventListener('click', prevSlide);

    // Auto-advance carousel
    setInterval(nextSlide, 5000);
</script>
@endsection

