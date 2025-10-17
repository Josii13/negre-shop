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
    <label for="banner_background">Image de fond (URL ou chemin)</label>
    <input type="text" class="form-control" id="banner_background" name="banner_background" value="{{ $content->banner_background ?? '' }}">
    <small class="form-text text-muted">URL de l'image ou chemin dans public/images/</small>
</div>

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

