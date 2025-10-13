@extends('layouts.app')

@section('title', 'Peinture - Frederic N\'DA')

@section('styles')
<style>
    /* Products Section */
    .products-section {
        padding: 4rem 2rem;
    }

    .products-grid {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }

    .product-card {
        background-color: #FFFFFF;
        transition: all 0.3s ease;
        border: 1px solid #F0F0F0;
        border-radius: 4px;
        overflow: hidden;
    }

    .product-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        width: 100%;
        height: 280px;
        background-color: #F7F7F7;
        overflow: hidden;
        position: relative;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .view-eye {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        width: 50px;
        height: 50px;
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .product-card:hover .view-eye {
        transform: translate(-50%, -50%) scale(1);
    }

    .view-eye:hover {
        background-color: #000000;
    }

    .view-eye svg {
        width: 24px;
        height: 24px;
        stroke: #000000;
        transition: stroke 0.3s ease;
    }

    .view-eye:hover svg {
        stroke: #FFFFFF;
    }

    .product-info {
        padding: 1.25rem;
    }

    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .product-info h3 {
        font-size: 1.1rem;
        font-weight: 400;
        letter-spacing: -0.01em;
    }

    .product-price {
        font-size: 1.2rem;
        font-weight: 500;
        color: #000000;
    }

    .product-btn {
        width: 100%;
        padding: 0.85rem;
        background-color: #000000;
        color: #FFFFFF;
        border: none;
        font-size: 0.9rem;
        font-weight: 400;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
        letter-spacing: 0.02em;
        border-radius: 2px;
    }

    .product-btn:hover {
        background-color: #333;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Modal de détails */
    .detail-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.85);
        z-index: 2000;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .detail-modal.active {
        display: flex;
    }

    .detail-modal-content {
        background-color: #FFFFFF;
        max-width: 900px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        animation: slideUp 0.4s ease;
        border-radius: 4px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .detail-image-container {
        background-color: #F7F7F7;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .detail-image-container img {
        max-width: 100%;
        max-height: 500px;
        object-fit: contain;
    }

    .detail-info-container {
        padding: 3rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .detail-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #000;
        transition: all 0.3s ease;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        z-index: 10;
    }

    .detail-close:hover {
        background: #000000;
        color: #FFFFFF;
        transform: rotate(90deg);
    }

    .detail-title {
        font-size: 2rem;
        font-weight: 400;
        margin-bottom: 1rem;
        letter-spacing: -0.02em;
    }

    .detail-price {
        font-size: 1.8rem;
        font-weight: 500;
        color: #000000;
        margin-bottom: 1.5rem;
    }

    .detail-description {
        margin-bottom: 2rem;
        padding: 1.5rem;
        background-color: #FAFAFA;
        border-left: 3px solid #000000;
        border-radius: 2px;
    }

    .detail-description p {
        font-size: 0.95rem;
        line-height: 1.7;
        color: #333;
    }

    .detail-characteristics {
        margin-bottom: 2rem;
    }

    .detail-characteristics h4 {
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #666;
        margin-bottom: 1rem;
    }

    .characteristic-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #F0F0F0;
    }

    .characteristic-label {
        color: #666;
        font-size: 0.95rem;
    }

    .characteristic-value {
        font-weight: 400;
        font-size: 0.95rem;
    }

    /* Modal de commande */
    .order-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.75);
        z-index: 2000;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .order-modal.active {
        display: flex;
    }

    .order-modal-content {
        background-color: #FFFFFF;
        max-width: 550px;
        width: 100%;
        padding: 3rem;
        position: relative;
        animation: slideUp 0.4s ease;
        border-radius: 4px;
    }

    .order-modal h2 {
        font-size: 2rem;
        font-weight: 400;
        margin-bottom: 2rem;
        letter-spacing: -0.02em;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        font-weight: 400;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 0.9rem;
        border: 1px solid #E0E0E0;
        background-color: #FAFAFA;
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        border-radius: 2px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #000000;
        background-color: #FFFFFF;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .submit-btn {
        width: 100%;
        padding: 1rem;
        background-color: #000000;
        color: #FFFFFF;
        border: none;
        font-size: 1rem;
        font-weight: 400;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
        letter-spacing: 0.02em;
        border-radius: 2px;
    }

    .submit-btn:hover {
        background-color: #333;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: 1fr;
        }

        .detail-modal-content {
            grid-template-columns: 1fr;
            max-height: 85vh;
        }

        .detail-info-container {
            padding: 2rem;
        }

        .order-modal-content {
            padding: 2rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- Page Banner -->
    <section class="page-banner">
        <div class="banner-content">
            <h1>{{ $category->banner_title ?? $category->name }}</h1>
            <p>{{ $category->banner_description ?? $category->description }}</p>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="products-section">
        <div class="products-grid" id="productsGrid">
            @forelse($products as $product)
            <div class="product-card" data-product-id="{{ $product->id }}">
                <div class="product-image">
                    <img src="{{ asset('images/' . ($product->image ?? 'img1.jpg')) }}" alt="{{ $product->name }}">
                    <div class="view-eye" onclick="openDetailModal({{ $loop->index }})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-header">
                        <h3>{{ $product->name }}</h3>
                        <span class="product-price"></span>
                    </div>
                    <button class="product-btn" onclick="openOrderModal({{ $loop->index }})">Commander</button>
                </div>
            </div>
            @empty
            <p style="text-align: center; grid-column: 1/-1; padding: 3rem;">Aucun produit disponible pour le moment.</p>
            @endforelse
        </div>
    </section>

    <!-- Modal de détails -->
    <div id="detailModal" class="detail-modal">
        <div class="detail-modal-content">
            <button class="detail-close" onclick="closeDetailModal()">✕</button>
            <div class="detail-image-container">
                <img id="detailImage" src="" alt="">
            </div>
            <div class="detail-info-container">
                <div>
                    <h2 class="detail-title" id="detailTitle"></h2>
                    <div class="detail-price" id="detailPrice"></div>
                    <div class="detail-description">
                        <p id="detailDescription"></p>
                    </div>
                    <div class="detail-characteristics">
                        <h4>Caractéristiques</h4>
                        <div class="characteristic-item">
                            <span class="characteristic-label">Dimensions</span>
                            <span class="characteristic-value" id="detailDimensions"></span>
                        </div>
                        <div class="characteristic-item">
                            <span class="characteristic-label">Technique</span>
                            <span class="characteristic-value" id="detailTechnique"></span>
                        </div>
                        <div class="characteristic-item">
                            <span class="characteristic-label">Support</span>
                            <span class="characteristic-value" id="detailSupport"></span>
                        </div>
                        <div class="characteristic-item">
                            <span class="characteristic-label">Année</span>
                            <span class="characteristic-value" id="detailYear"></span>
                        </div>
                    </div>
                </div>
                <button class="product-btn" onclick="orderFromDetail()">Commander cette œuvre</button>
            </div>
        </div>
    </div>

    <!-- Modal de commande -->
    <div id="orderModal" class="order-modal">
        <div class="order-modal-content">
            <button class="detail-close" onclick="closeOrderModal()">✕</button>
            <h2>Commander</h2>
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <input type="hidden" id="product_id" name="product_id">
                <div class="form-group">
                    <label for="customer_name">Nom</label>
                    <input type="text" id="customer_name" name="customer_name" required>
                </div>
                <div class="form-group">
                    <label for="customer_email">Email</label>
                    <input type="email" id="customer_email" name="customer_email" required>
                </div>
                <div class="form-group">
                    <label for="customer_phone">Téléphone</label>
                    <input type="tel" id="customer_phone" name="customer_phone" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" readonly></textarea>
                </div>
                <button type="submit" class="submit-btn">Envoyer</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Données des produits
    const products = @json($products);

    // Variable pour stocker le produit actuel (utilise celle du script global)
    if (typeof currentProduct === 'undefined') {
        var currentProduct = null;
    }

    // Ouvrir le modal de détails
    window.openDetailModal = function(index) {
        currentProduct = products[index];
        document.getElementById('detailImage').src = '/images/' + (currentProduct.image || 'img1.jpg');
        document.getElementById('detailTitle').textContent = currentProduct.name;
        document.getElementById('detailPrice').textContent = currentProduct.formatted_price || '';
        document.getElementById('detailDescription').textContent = currentProduct.description || '';
        document.getElementById('detailDimensions').textContent = currentProduct.dimensions || 'N/A';
        document.getElementById('detailTechnique').textContent = currentProduct.technique || 'N/A';
        document.getElementById('detailSupport').textContent = currentProduct.support || 'N/A';
        document.getElementById('detailYear').textContent = currentProduct.year || 'N/A';
        document.getElementById('detailModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Fermer le modal de détails
    window.closeDetailModal = function() {
        document.getElementById('detailModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Commander depuis le modal de détails
    window.orderFromDetail = function() {
        closeDetailModal();
        openOrderModalWithProduct(currentProduct);
    }

    // Ouvrir le modal de commande
    window.openOrderModal = function(index) {
        const product = products[index];
        openOrderModalWithProduct(product);
    }

    function openOrderModalWithProduct(product) {
        document.getElementById('product_id').value = product.id;
        document.getElementById('message').value = `Je souhaite commander l'œuvre "${product.name}" au prix de ${product.formatted_price || product.price + ' FCFA'}.`;
        document.getElementById('orderModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Fermer le modal de commande
    window.closeOrderModal = function() {
        document.getElementById('orderModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Fermer les modals en cliquant à l'extérieur
    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDetailModal();
        }
    });

    document.getElementById('orderModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeOrderModal();
        }
    });
</script>
@endsection

