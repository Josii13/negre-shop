@extends('layouts.app')

@section('title', 'Marque - Frederic N\'DA')

@section('styles')
<style>
    /* Styles spécifiques à la page Marques */

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

    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .product-price {
        font-size: 1.2rem;
        font-weight: 500;
        color: #000000;
    }

    .product-info {
        padding: 1.25rem;
    }

    .whatsapp-btn {
        background-color: #25D366;
    }

    .whatsapp-btn:hover {
        background-color: #1DA851;
    }

    .brand-description {
        margin-top: 2rem;
        padding: 2rem;
        background-color: #FAFAFA;
        border-left: 3px solid #000000;
        border-radius: 2px;
    }

    .brand-description p {
        font-size: 1rem;
        line-height: 1.8;
        color: #555;
        font-weight: 300;
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

    .brand-description {
        margin-top: 2rem;
        padding: 2rem;
        background-color: #FAFAFA;
        border-left: 3px solid #000000;
        border-radius: 2px;
    }

    .brand-description p {
        font-size: 1rem;
        line-height: 1.8;
        color: #555;
        font-weight: 300;
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
    }
</style>
@endsection

@section('content')
    <!-- Page Banner -->
    <section class="page-banner">
        <div class="banner-content">
            <h1>{{ $category->banner_title ?? $category->name }}</h1>
            <p>{{ $category->banner_description ?? $category->description }}</p>
            @if($category->description)
            <div class="brand-description">
                <p>{{ $category->description }}</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Products Grid -->
    <section class="products-section">
        <div class="products-grid">
            @forelse($products as $product)
            <div class="product-card">
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
                    <button class="product-btn whatsapp-btn" onclick="orderOnWhatsApp({{ $loop->index }})">Commander sur WhatsApp</button>
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
                            <span class="characteristic-label">Matière</span>
                            <span class="characteristic-value" id="detailMaterial"></span>
                        </div>
                        <div class="characteristic-item">
                            <span class="characteristic-label">Tailles disponibles</span>
                            <span class="characteristic-value" id="detailSizes"></span>
                        </div>
                        <div class="characteristic-item">
                            <span class="characteristic-label">Style</span>
                            <span class="characteristic-value" id="detailStyle"></span>
                        </div>
                        <div class="characteristic-item">
                            <span class="characteristic-label">Collection</span>
                            <span class="characteristic-value" id="detailCollection"></span>
                        </div>
                    </div>
                </div>
                <button class="product-btn whatsapp-btn" onclick="orderFromDetail()">Commander sur WhatsApp</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const products = @json($products);
    const whatsappNumber = "{{ $whatsappNumber ?? '2250769465904' }}"; // Numéro WhatsApp depuis .env
    
    // Variable pour stocker le produit actuel
    let currentProductMarque = null;

    window.openDetailModal = function(index) {
        currentProductMarque = products[index];
        document.getElementById('detailImage').src = '/images/' + (currentProductMarque.image || 'img1.jpg');
        document.getElementById('detailTitle').textContent = currentProductMarque.name;
        document.getElementById('detailPrice').textContent = currentProductMarque.formatted_price || '';
        document.getElementById('detailDescription').textContent = currentProductMarque.description || '';
        document.getElementById('detailMaterial').textContent = currentProductMarque.materials || 'N/A';
        document.getElementById('detailSizes').textContent = currentProductMarque.sizes || 'N/A';
        document.getElementById('detailStyle').textContent = currentProductMarque.style || 'N/A';
        document.getElementById('detailCollection').textContent = currentProductMarque.collection || 'N/A';
        document.getElementById('detailModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    window.closeDetailModal = function() {
        document.getElementById('detailModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    window.orderFromDetail = function() {
        closeDetailModal();
        orderOnWhatsAppWithProduct(currentProductMarque);
    }

    window.orderOnWhatsApp = function(index) {
        orderOnWhatsAppWithProduct(products[index]);
    }

    function orderOnWhatsAppWithProduct(product) {
        const message = `Bonjour, je souhaite commander le produit suivant :\n\n*${product.name}*\nPrix : ${product.formatted_price || product.price + ' FCFA'}\n\nMerci de me recontacter pour finaliser la commande.`;
        const encodedMessage = encodeURIComponent(message);
        const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;
        window.open(whatsappUrl, '_blank');
    }

    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) closeDetailModal();
    });
});
</script>
@endsection

