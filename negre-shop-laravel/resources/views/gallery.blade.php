@extends('layouts.app')

@section('title', 'NÈGRE Workshop Gallery - Frederic N\'DA')

@section('content')
    <!-- Page Banner -->
    <section class="page-banner">
        <div class="banner-content">
            <h1>NÈGRE Workshop Gallery</h1>
            <div class="subtitle">LE NÈGRE | workshop - gallery</div>
            <p>Un espace inspirant dédié à la création artistique, aux événements et aux échanges culturels.</p>
            <div class="workshop-description">
                <p>"Est un atelier artistique fondé par l'artiste peintre Frederic N'DA aka 'le nègre', cet espace inspirant destiné à sa pratique artistique, à la créativité, aux petits événements artistiques et aux podcasts où d'autres créateurs et artistes pourront raconter leurs histoires et leurs approches artistiques."</p>
            </div>
        </div>
    </section>

    <!-- Tabs Section -->
    <section class="tabs-section">
        <div class="tabs-container">
            <div class="tabs-header">
                <button class="tab-btn active" data-tab="atelier">L'Atelier</button>
                <button class="tab-btn" data-tab="activites">Activités</button>
                <button class="tab-btn" data-tab="evenements">Événements</button>
                <button class="tab-btn" data-tab="podcasts">Podcasts</button>
            </div>

            <!-- Tab 1: L'Atelier -->
            <div class="tab-content active" id="atelier">
                <div class="activities-grid">
                    @foreach($atelierActivities as $activity)
                    <div class="activity-card" onclick="openActivityModal({{ $loop->index }}, 'atelier')">
                        <div class="activity-image">
                            <img src="{{ asset('images/' . ($activity->image ?? 'img1.jpg')) }}" alt="{{ $activity->title }}">
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
                            <img src="{{ asset('images/' . ($activity->image ?? 'img1.jpg')) }}" alt="{{ $activity->title }}">
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
                            <img src="{{ asset('images/' . ($activity->image ?? 'img1.jpg')) }}" alt="{{ $activity->title }}">
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
                            <img src="{{ asset('images/' . ($activity->image ?? 'img1.jpg')) }}" alt="{{ $activity->title }}">
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
    const whatsappNumber = "2250768298965";
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
        document.getElementById('modalImage').src = '/images/' + (currentActivity.image || 'img1.jpg');
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
        document.getElementById('modalWhatsapp').href = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;
        
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

