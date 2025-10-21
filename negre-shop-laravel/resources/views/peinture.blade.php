@extends('layouts.app')

@section('title', 'Peinture - Frederic N\'DA')

@section('styles')
<style>
    /* Styles spécifiques à la page Peinture */
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

    /* Responsive */
    @media (max-width: 768px) {
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
                    <img src="{{ asset($product->image ? 'storage/' . $product->image : 'storage/images/img1.jpg') }}" alt="{{ $product->name }}">
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

    <!-- Modales (utilisation des partials dynamiques) -->
    @include('partials.modals.detail-modal', [
        'modalId' => 'detailModal',
        'imageId' => 'detailImage',
        'titleId' => 'detailTitle',
        'priceId' => 'detailPrice',
        'descriptionId' => 'detailDescription',
        'characteristics' => [
            ['label' => 'Dimensions', 'id' => 'detailDimensions'],
            ['label' => 'Technique', 'id' => 'detailTechnique'],
            ['label' => 'Support', 'id' => 'detailSupport'],
            ['label' => 'Année', 'id' => 'detailYear']
        ]
    ])

    @include('partials.modals.order-modal', [
        'modalId' => 'orderModal',
        'formId' => 'orderForm',
        'formAction' => route('order.store')
    ])
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Données des produits
    const products = @json($products);

    // Variable pour stocker le produit actuel
    let currentProductPeinture = null;

    // Ouvrir le modal de détails
    window.openDetailModal = function(index) {
        currentProductPeinture = products[index];
        const detailModal = document.getElementById('detailModal');
        const detailImage = document.getElementById('detailImage');
        const detailTitle = document.getElementById('detailTitle');
        const detailPrice = document.getElementById('detailPrice');
        const detailDescription = document.getElementById('detailDescription');
        const detailDimensions = document.getElementById('detailDimensions');
        const detailTechnique = document.getElementById('detailTechnique');
        const detailSupport = document.getElementById('detailSupport');
        const detailYear = document.getElementById('detailYear');

        if (!detailModal) {
            console.error('Modal de détails introuvable');
            return;
        }

        // Construire le chemin correct de l'image
        const imagePath = currentProductPeinture.image 
            ? '/storage/' + currentProductPeinture.image 
            : '/images/img1.jpg';
        detailImage.src = imagePath;
        
        detailTitle.textContent = currentProductPeinture.name;
        detailPrice.textContent = currentProductPeinture.formatted_price || '';
        detailDescription.textContent = currentProductPeinture.description || '';
        detailDimensions.textContent = currentProductPeinture.dimensions || 'N/A';
        detailTechnique.textContent = currentProductPeinture.technique || 'N/A';
        detailSupport.textContent = currentProductPeinture.support || 'N/A';
        detailYear.textContent = currentProductPeinture.year || 'N/A';
        detailModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Fermer le modal de détails
    window.closeDetailModal = function() {
        const detailModal = document.getElementById('detailModal');
        if (detailModal) {
            detailModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }

    // Commander depuis le modal de détails
    window.orderFromDetail = function() {
        closeDetailModal();
        openOrderModalWithProduct(currentProductPeinture);
    }

    // Ouvrir le modal de commande
    window.openOrderModal = function(index) {
        const product = products[index];
        openOrderModalWithProduct(product);
    }

    function openOrderModalWithProduct(product) {
        const orderModal = document.getElementById('orderModal');
        const productIdField = document.getElementById('product_id');
        const messageField = document.getElementById('message');

        if (!orderModal || !productIdField || !messageField) {
            console.error('Éléments du formulaire introuvables');
            return;
        }

        productIdField.value = product.id;
        messageField.value = `Je souhaite commander l'œuvre "${product.name}" au prix de ${product.formatted_price || product.price + ' FCFA'}.`;
        orderModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Fermer le modal de commande
    window.closeOrderModal = function() {
        const orderModal = document.getElementById('orderModal');
        if (orderModal) {
            orderModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }

    // Gestion de la soumission du formulaire avec le système global
    const orderForm = document.getElementById('orderForm');
    if (orderForm) {
        orderForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Fonction pour préparer les données email client
            const prepareEmailData = (formData, serverData) => ({
                to_email: formData.get('customer_email'),
                to_name: formData.get('customer_name'),
                product_name: serverData.product_name,
                product_price: serverData.product_price,
                customer_phone: formData.get('customer_phone'),
                message: formData.get('message')
            });

            // Fonction pour préparer les données email admin
            const prepareAdminEmailData = (formData, serverData) => ({
                to_email: '{{ $adminEmail }}',
                to_name: '{{ $adminName }}',
                customer_name: formData.get('customer_name'),
                customer_email: formData.get('customer_email'),
                customer_phone: formData.get('customer_phone'),
                product_name: serverData.product_name,
                product_price: serverData.product_price,
                message: formData.get('message'),
                order_date: new Date().toLocaleDateString('fr-FR', { 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric', 
                    hour: '2-digit', 
                    minute: '2-digit' 
                })
            });

            // Utiliser le gestionnaire global avec double envoi d'email
            handleFormSubmit(orderForm, prepareEmailData, {
                showSuccessModal: true,
                sendEmail: true,
                prepareAdminEmailData: prepareAdminEmailData,
                reloadOnSuccess: true,
                reloadDelay: 3000,
                successMessage: 'Votre commande a été prise en compte avec succès.',
                successSubMessage: 'Un email de confirmation vous sera envoyé sous peu.'
            }).then(() => {
                // Fermer la modale de commande après succès
                closeOrderModal();
            });
        });
    }

    // Fermer les modals en cliquant à l'extérieur
    const detailModal = document.getElementById('detailModal');
    const orderModal = document.getElementById('orderModal');

    if (detailModal) {
        detailModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeDetailModal();
            }
        });
    }

    if (orderModal) {
        orderModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeOrderModal();
            }
        });
    }
});
</script>
@endsection

