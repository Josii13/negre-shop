@extends('layouts.app')

@section('title', $pageContent->meta_title ?? 'NÈGRE Workshop Gallery - Frederic N\'DA')

@section('styles')
<style>
    /* Page Banner */
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

    .banner-content .subtitle {
        font-size: 1.5rem;
        font-weight: 300;
        color: #666;
        margin-bottom: 2rem;
        letter-spacing: 0.05em;
    }

    .banner-content p {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #555;
        font-weight: 300;
    }

    .workshop-description {
        max-width: 800px;
        margin: 3rem auto 0;
        text-align: left;
        font-style: italic;
        color: #666;
        border-left: 3px solid #000;
        padding-left: 2rem;
    }

    /* Tabs Section */
    .tabs-section {
        padding: 4rem 2rem;
    }

    .tabs-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .tabs-header {
        display: flex;
        justify-content: center;
        margin-bottom: 3rem;
        border-bottom: 1px solid #F0F0F0;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .tab-btn {
        padding: 1rem 2rem;
        background: none;
        border: none;
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        font-weight: 400;
        color: #666;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        border-bottom: 2px solid transparent;
    }

    .tab-btn:hover {
        color: #000;
    }

    .tab-btn.active {
        color: #000;
        border-bottom-color: #000;
    }

    .tab-content {
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .tab-content.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Activities Grid */
    .activities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
    }

    .activity-card {
        background: #FFFFFF;
        border: 1px solid #F0F0F0;
        border-radius: 4px;
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .activity-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .activity-image {
        height: 250px;
        background: linear-gradient(135deg, #FAFAFA 0%, #F5F5F5 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        border-bottom: 1px solid #F0F0F0;
        position: relative;
        overflow: hidden;
    }

    .activity-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .activity-card:hover .activity-image img {
        transform: scale(1.05);
    }

    .activity-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .activity-card:hover .activity-icon {
        opacity: 1;
    }

    .activity-icon svg {
        width: 24px;
        height: 24px;
        stroke: #000;
    }

    .activity-info {
        padding: 1.5rem;
    }

    .activity-info h3 {
        font-size: 1.3rem;
        font-weight: 400;
        margin-bottom: 0.5rem;
        letter-spacing: -0.01em;
    }

    .activity-info p {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .activity-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
        color: #999;
    }

    .activity-type {
        background: #F5F5F5;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
    }

    /* Modal */
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
        max-height: 400px;
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
        font-size: 1.5rem;
        font-weight: 500;
        color: #000;
        margin-bottom: 1.5rem;
        padding: 0.75rem 1.25rem;
        background: linear-gradient(135deg, #F5F5F5 0%, #FAFAFA 100%);
        border-left: 3px solid #000;
        display: inline-block;
        border-radius: 2px;
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

    .whatsapp-btn {
        width: 100%;
        padding: 1rem;
        background-color: #25D366;
        color: #FFFFFF;
        border: none;
        font-size: 1rem;
        font-weight: 400;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
        letter-spacing: 0.02em;
        border-radius: 2px;
        text-decoration: none;
        text-align: center;
        display: block;
    }

    .whatsapp-btn:hover {
        background-color: #128C7E;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .banner-content h1 {
            font-size: 2.5rem;
        }

        .banner-content .subtitle {
            font-size: 1.2rem;
        }

        .workshop-description {
            padding-left: 1rem;
            margin-top: 2rem;
        }

        .tabs-header {
            flex-direction: column;
            align-items: center;
        }

        .tab-btn {
            width: 100%;
            text-align: center;
        }

        .activities-grid {
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
    <section class="page-banner" @if($pageContent && $pageContent->banner_background) style="background-image: linear-gradient(135deg, rgba(250, 250, 250, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%), url('{{ asset('images/' . $pageContent->banner_background) }}'); background-size: cover; background-position: center;" @endif>
        <div class="banner-content">
            <h1>{{ $pageContent->banner_title ?? 'NÈGRE Workshop Gallery' }}</h1>
            <div class="subtitle">{{ $pageContent->banner_subtitle ?? 'LE NÈGRE | workshop - gallery' }}</div>
            <p>{{ $pageContent->banner_description ?? 'Un espace inspirant dédié à la création artistique, aux événements et aux échanges culturels.' }}</p>
            @if($pageContent && $pageContent->banner_quote)
            <div class="workshop-description">
                <p>"{{ $pageContent->banner_quote }}"</p>
            </div>
            @else
            <div class="workshop-description">
                <p>"Est un atelier artistique fondé par l'artiste peintre Frederic N'DA aka 'le nègre', cet espace inspirant destiné à sa pratique artistique, à la créativité, aux petits événements artistiques et aux podcasts où d'autres créateurs et artistes pourront raconter leurs histoires et leurs approches artistiques."</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Tabs Section -->
    <section class="tabs-section">
        <div class="tabs-container">
            <div class="tabs-header">
                <button class="tab-btn active" data-tab="atelier">{{ $pageContent->tab_atelier ?? 'L\'Atelier' }}</button>
                <button class="tab-btn" data-tab="activites">{{ $pageContent->tab_activites ?? 'Activités' }}</button>
                <button class="tab-btn" data-tab="evenements">{{ $pageContent->tab_evenements ?? 'Événements' }}</button>
                <button class="tab-btn" data-tab="podcasts">{{ $pageContent->tab_podcasts ?? 'Podcasts' }}</button>
            </div>

            <!-- Tab 1: L'Atelier -->
            <div class="tab-content active" id="atelier">
                <div class="activities-grid">
                    @foreach($atelierActivities as $activity)
                    <div class="activity-card" onclick="openActivityModal({{ $loop->index }}, 'atelier')">
                        <div class="activity-image">
                            <img src="{{ asset($activity->image ? 'storage/' . $activity->image : 'images/img1.jpg') }}" alt="{{ $activity->title }}">
                            <div class="activity-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="activity-info">
                            <h3>{{ $activity->title }}</h3>
                            <p>{{ Str::limit($activity->description, 100) }}</p>
                            <div class="activity-meta">
                                <span class="activity-type">{{ $activity->type }}</span>
                                <span>{{ $activity->capacity }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab 2: Activités -->
            <div class="tab-content" id="activites">
                <div class="activities-grid">
                    @foreach($activities as $activity)
                    <div class="activity-card" onclick="openActivityModal({{ $loop->index }}, 'activites')">
                        <div class="activity-image">
                            <img src="{{ asset($activity->image ? 'storage/' . $activity->image : 'images/img1.jpg') }}" alt="{{ $activity->title }}">
                            <div class="activity-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="activity-info">
                            <h3>{{ $activity->title }}</h3>
                            <p>{{ Str::limit($activity->description, 100) }}</p>
                            <div class="activity-meta">
                                <span class="activity-type">{{ $activity->type }}</span>
                                <span>{{ $activity->frequency }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab 3: Événements -->
            <div class="tab-content" id="evenements">
                <div class="activities-grid">
                    @forelse($evenements as $activity)
                    <div class="activity-card" onclick="openActivityModal({{ $loop->index }}, 'evenements')">
                        <div class="activity-image">
                            <img src="{{ asset($activity->image ? 'storage/' . $activity->image : 'images/img1.jpg') }}" alt="{{ $activity->title }}">
                            <div class="activity-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="activity-info">
                            <h3>{{ $activity->title }}</h3>
                            <p>{{ Str::limit($activity->description, 100) }}</p>
                            <div class="activity-meta">
                                <span class="activity-type">{{ $activity->type }}</span>
                                <span>{{ $activity->frequency }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p style="text-align: center; grid-column: 1/-1; padding: 3rem;">Aucun événement disponible pour le moment.</p>
                    @endforelse
                </div>
            </div>

            <!-- Tab 4: Podcasts -->
            <div class="tab-content" id="podcasts">
                <div class="activities-grid">
                    @forelse($podcasts as $activity)
                    <div class="activity-card" onclick="openActivityModal({{ $loop->index }}, 'podcasts')">
                        <div class="activity-image">
                            <img src="{{ asset($activity->image ? 'storage/' . $activity->image : 'images/img1.jpg') }}" alt="{{ $activity->title }}">
                            <div class="activity-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="activity-info">
                            <h3>{{ $activity->title }}</h3>
                            <p>{{ Str::limit($activity->description, 100) }}</p>
                            <div class="activity-meta">
                                <span class="activity-type">{{ $activity->type }}</span>
                                <span>{{ $activity->frequency }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p style="text-align: center; grid-column: 1/-1; padding: 3rem;">Aucun podcast disponible pour le moment.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div id="activityModal" class="detail-modal">
        <div class="detail-modal-content">
            <button class="detail-close" onclick="closeActivityModal()">✕</button>
            <div class="detail-image-container">
                <img id="modalImage" src="" alt="">
            </div>
            <div class="detail-info-container">
                <div>
                    <h2 class="detail-title" id="modalTitle"></h2>
                    <div class="detail-price" id="modalPrice" style="display: none;"></div>
                    <div class="detail-description">
                        <p id="modalDescription"></p>
                    </div>
                    <div class="detail-characteristics">
                        <h4>Détails</h4>
                        <div class="characteristic-item">
                            <span class="characteristic-label">Type</span>
                            <span class="characteristic-value" id="modalType"></span>
                        </div>
                        <div class="characteristic-item">
                            <span class="characteristic-label">Fréquence</span>
                            <span class="characteristic-value" id="modalFrequency"></span>
                        </div>
                        <div class="characteristic-item">
                            <span class="characteristic-label">Capacité</span>
                            <span class="characteristic-value" id="modalCapacity"></span>
                        </div>
                        <div class="characteristic-item">
                            <span class="characteristic-label">Public</span>
                            <span class="characteristic-value" id="modalAudience"></span>
                        </div>
                    </div>
                </div>
                <a href="#" class="whatsapp-btn" id="modalWhatsapp">Réserver sur WhatsApp</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    const allActivities = {
        atelier: @json($atelierActivities),
        activites: @json($activities),
        evenements: @json($evenements),
        podcasts: @json($podcasts)
    };
    const whatsappNumber = "{{ $whatsappNumber ?? '2250769465904' }}";
    let currentActivity = null;

    // Gestion des tabs
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            
            this.classList.add('active');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Ouvrir le modal d'activité
    function openActivityModal(index, tab) {
        currentActivity = allActivities[tab][index];
        const imagePath = currentActivity.image ? '/storage/' + currentActivity.image : '/images/img1.jpg';
        document.getElementById('modalImage').src = imagePath;
        document.getElementById('modalTitle').textContent = currentActivity.title;
        
        const priceElement = document.getElementById('modalPrice');
        if (currentActivity.price) {
            priceElement.textContent = currentActivity.price;
            priceElement.style.display = 'inline-block';
        } else {
            priceElement.style.display = 'none';
        }
        
        document.getElementById('modalDescription').textContent = currentActivity.description;
        document.getElementById('modalType').textContent = currentActivity.type;
        document.getElementById('modalFrequency').textContent = currentActivity.frequency || 'N/A';
        document.getElementById('modalCapacity').textContent = currentActivity.capacity || 'N/A';
        document.getElementById('modalAudience').textContent = currentActivity.audience || 'N/A';
        
        const message = `Bonjour, je souhaite réserver : ${currentActivity.title}`;
        const encodedMessage = encodeURIComponent(message);
        // Utiliser web.whatsapp.com qui gère mieux les messages pré-remplis
        document.getElementById('modalWhatsapp').href = `https://web.whatsapp.com/send?phone=${whatsappNumber}&text=${encodedMessage}`;
        
        document.getElementById('activityModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeActivityModal() {
        document.getElementById('activityModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    document.getElementById('activityModal').addEventListener('click', function(e) {
        if (e.target === this) closeActivityModal();
    });
</script>
@endsection

