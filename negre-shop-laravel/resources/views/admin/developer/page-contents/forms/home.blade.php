{{-- Hero Section (Image + Texte en dessous du carousel) --}}
<h5 class="text-primary">Section Hero (Image + Biographie)</h5>
<div class="form-group">
    <label for="hero_image">Image Hero</label>
    <input type="text" class="form-control" id="hero_image" name="hero_image" value="{{ $content->hero_image ?? 'img2.jpg' }}">
    <small class="form-text text-muted">Nom du fichier dans public/images/ (ex: img2.jpg)</small>
</div>
<div class="form-group">
    <label for="hero_title">Titre Principal</label>
    <input type="text" class="form-control" id="hero_title" name="hero_title" value="{{ $content->hero_title ?? 'Frederic N\'DA' }}" required>
</div>
<div class="form-group">
    <label for="hero_paragraph_1">Paragraphe 1</label>
    <textarea class="form-control" id="hero_paragraph_1" name="hero_paragraph_1" rows="2">{{ $content->hero_paragraph_1 ?? '' }}</textarea>
    <small class="form-text text-muted">Premier paragraphe de présentation</small>
</div>
<div class="form-group">
    <label for="hero_paragraph_2">Paragraphe 2</label>
    <textarea class="form-control" id="hero_paragraph_2" name="hero_paragraph_2" rows="2">{{ $content->hero_paragraph_2 ?? '' }}</textarea>
    <small class="form-text text-muted">Deuxième paragraphe de présentation</small>
</div>
<div class="form-group">
    <label for="hero_paragraph_3">Paragraphe 3</label>
    <textarea class="form-control" id="hero_paragraph_3" name="hero_paragraph_3" rows="2">{{ $content->hero_paragraph_3 ?? '' }}</textarea>
    <small class="form-text text-muted">Troisième paragraphe de présentation</small>
</div>

<hr class="my-4">

{{-- About Section --}}
<h5 class="text-primary">Section À Propos</h5>
<div class="form-group">
    <label for="about_title">Titre</label>
    <input type="text" class="form-control" id="about_title" name="about_title" value="{{ $content->about_title ?? '' }}">
</div>
<div class="form-group">
    <label for="about_description">Description</label>
    <textarea class="form-control" id="about_description" name="about_description" rows="4">{{ $content->about_description ?? '' }}</textarea>
</div>
<div class="form-group">
    <label for="about_image">Image (URL ou chemin)</label>
    <input type="text" class="form-control" id="about_image" name="about_image" value="{{ $content->about_image ?? '' }}">
    <small class="form-text text-muted">URL de l'image ou chemin dans public/images/</small>
</div>

<hr class="my-4">

{{-- Features Section --}}
<h5 class="text-primary">Section Features/Domaines</h5>
<div class="form-group">
    <label for="features_title">Titre</label>
    <input type="text" class="form-control" id="features_title" name="features_title" value="{{ $content->features_title ?? '' }}">
</div>
<div class="form-group">
    <label for="features_description">Description</label>
    <textarea class="form-control" id="features_description" name="features_description" rows="3">{{ $content->features_description ?? '' }}</textarea>
</div>

<hr class="my-4">

{{-- CTA Section --}}
<h5 class="text-primary">Section Call-to-Action</h5>
<div class="form-group">
    <label for="cta_title">Titre</label>
    <input type="text" class="form-control" id="cta_title" name="cta_title" value="{{ $content->cta_title ?? '' }}">
</div>
<div class="form-group">
    <label for="cta_description">Description</label>
    <textarea class="form-control" id="cta_description" name="cta_description" rows="2">{{ $content->cta_description ?? '' }}</textarea>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="cta_button_text">Texte du Bouton</label>
        <input type="text" class="form-control" id="cta_button_text" name="cta_button_text" value="{{ $content->cta_button_text ?? '' }}">
    </div>
    <div class="form-group col-md-6">
        <label for="cta_button_link">Lien du Bouton</label>
        <input type="text" class="form-control" id="cta_button_link" name="cta_button_link" value="{{ $content->cta_button_link ?? '' }}">
    </div>
</div>

<hr class="my-4">

{{-- SEO Section --}}
<h5 class="text-primary">SEO Meta Tags</h5>
<div class="form-group">
    <label for="meta_title">Meta Title</label>
    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $content->meta_title ?? '' }}">
    <small class="form-text text-muted">Titre qui apparaît dans les résultats de recherche (60 caractères max)</small>
</div>
<div class="form-group">
    <label for="meta_description">Meta Description</label>
    <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ $content->meta_description ?? '' }}</textarea>
    <small class="form-text text-muted">Description pour les moteurs de recherche (160 caractères max)</small>
</div>
<div class="form-group">
    <label for="meta_keywords">Meta Keywords</label>
    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ $content->meta_keywords ?? '' }}">
    <small class="form-text text-muted">Mots-clés séparés par des virgules</small>
</div>

