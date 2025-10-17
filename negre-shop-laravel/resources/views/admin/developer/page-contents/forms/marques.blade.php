{{-- Banner Section --}}
<h5 class="text-primary">Section Bannière</h5>
<div class="form-group">
    <label for="banner_default_description">Description par Défaut</label>
    <textarea class="form-control" id="banner_default_description" name="banner_default_description" rows="3">{{ $content->banner_default_description ?? '' }}</textarea>
    <small class="form-text text-muted">Utilisée quand aucune catégorie n'est sélectionnée</small>
</div>
<div class="form-group">
    <label for="banner_background">Image de fond (URL ou chemin)</label>
    <input type="text" class="form-control" id="banner_background" name="banner_background" value="{{ $content->banner_background ?? '' }}">
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

{{-- WhatsApp --}}
<h5 class="text-primary">Configuration WhatsApp</h5>
<div class="form-group">
    <label for="whatsapp_message_template">Template de Message WhatsApp</label>
    <textarea class="form-control" id="whatsapp_message_template" name="whatsapp_message_template" rows="3">{{ $content->whatsapp_message_template ?? '' }}</textarea>
    <small class="form-text text-muted">
        Variables disponibles : {product_name}, {product_price}<br>
        Exemple : "Bonjour, je souhaite commander {product_name} au prix de {product_price}"
    </small>
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

