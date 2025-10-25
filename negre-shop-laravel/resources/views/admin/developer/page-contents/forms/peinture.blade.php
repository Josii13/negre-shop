{{-- Banner Section --}}
<h5 class="text-primary">Section Bannière</h5>
<div class="form-group">
    <label for="banner_title">Titre de la Bannière</label>
    <input type="text" class="form-control" id="banner_title" name="banner_title" value="{{ $content->banner_title ?? '' }}" required>
</div>
<div class="form-group">
    <label for="banner_description">Description</label>
    <textarea class="form-control" id="banner_description" name="banner_description" rows="3">{{ $content->banner_description ?? '' }}</textarea>
</div>
<div class="form-group">
    <label for="banner_background_file">Image de fond de la Bannière</label>
    
    {{-- Prévisualisation de l'image actuelle --}}
    @if(isset($content->banner_background) && $content->banner_background)
    <div class="mb-3">
        <img id="banner_background_preview" 
             src="{{ asset('images/' . $content->banner_background) }}" 
             alt="Banner Background" 
             class="img-thumbnail" 
             style="max-height: 200px; object-fit: cover;">
    </div>
    @else
    <div class="mb-3">
        <div id="banner_background_preview_placeholder" class="alert alert-info">
            <i class="fas fa-image"></i> Aucune image de fond définie
        </div>
    </div>
    @endif
    
    {{-- Champ d'upload --}}
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="banner_background_file" name="banner_background_file" accept="image/*" onchange="previewBannerBackground(event)">
        <label class="custom-file-label" for="banner_background_file">Choisir une image de fond...</label>
    </div>
    <small class="form-text text-muted">Format accepté : JPG, PNG, GIF, WEBP (max 2MB). Cette image sera utilisée en arrière-plan de la bannière.</small>
    
    {{-- Champ caché pour conserver l'ancienne valeur --}}
    <input type="hidden" name="banner_background_current" value="{{ $content->banner_background ?? '' }}">
</div>

<script>
function previewBannerBackground(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Vérifier si l'élément preview existe
            let previewImg = document.getElementById('banner_background_preview');
            const placeholder = document.getElementById('banner_background_preview_placeholder');
            
            if (!previewImg) {
                // Créer l'élément img si il n'existe pas
                if (placeholder) {
                    placeholder.parentElement.innerHTML = '<img id="banner_background_preview" src="" alt="Banner Background" class="img-thumbnail" style="max-height: 200px; object-fit: cover;">';
                    previewImg = document.getElementById('banner_background_preview');
                }
            }
            
            if (previewImg) {
                previewImg.src = e.target.result;
            }
        }
        reader.readAsDataURL(file);
        
        // Mettre à jour le label avec le nom du fichier
        const fileName = file.name;
        const label = event.target.nextElementSibling;
        label.textContent = fileName;
    }
}
</script>

<hr class="my-4">

{{-- Introduction --}}
<h5 class="text-primary">Section Introduction</h5>
<div class="form-group">
    <label for="intro_title">Titre</label>
    <input type="text" class="form-control" id="intro_title" name="intro_title" value="{{ $content->intro_title ?? '' }}">
</div>
<div class="form-group">
    <label for="intro_text">Texte Intro</label>
    <textarea class="form-control" id="intro_text" name="intro_text" rows="4">{{ $content->intro_text ?? '' }}</textarea>
</div>

<hr class="my-4">

{{-- Grid Section --}}
<h5 class="text-primary">Section Grille de Produits</h5>
<div class="form-group">
    <label for="grid_title">Titre de la Grille</label>
    <input type="text" class="form-control" id="grid_title" name="grid_title" value="{{ $content->grid_title ?? '' }}">
</div>
<div class="form-group">
    <label for="grid_subtitle">Sous-titre</label>
    <input type="text" class="form-control" id="grid_subtitle" name="grid_subtitle" value="{{ $content->grid_subtitle ?? '' }}">
</div>

<hr class="my-4">

{{-- SEO Section --}}
<h5 class="text-primary">SEO Meta Tags</h5>
<div class="form-group">
    <label for="meta_title">Meta Title</label>
    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $content->meta_title ?? '' }}">
</div>
<div class="form-group">
    <label for="meta_description">Meta Description</label>
    <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ $content->meta_description ?? '' }}</textarea>
</div>
<div class="form-group">
    <label for="meta_keywords">Meta Keywords</label>
    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ $content->meta_keywords ?? '' }}">
</div>

