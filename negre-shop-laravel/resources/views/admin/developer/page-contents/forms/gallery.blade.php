{{-- Banner Section --}}
<h5 class="text-primary">Section Bannière</h5>
<div class="form-group">
    <label for="banner_title">Titre Principal</label>
    <input type="text" class="form-control" id="banner_title" name="banner_title" value="{{ $content->banner_title ?? '' }}" required>
</div>
<div class="form-group">
    <label for="banner_subtitle">Sous-titre</label>
    <input type="text" class="form-control" id="banner_subtitle" name="banner_subtitle" value="{{ $content->banner_subtitle ?? '' }}">
</div>
<div class="form-group">
    <label for="banner_description">Description</label>
    <textarea class="form-control" id="banner_description" name="banner_description" rows="3">{{ $content->banner_description ?? '' }}</textarea>
</div>
<div class="form-group">
    <label for="banner_quote">Citation/Quote</label>
    <textarea class="form-control" id="banner_quote" name="banner_quote" rows="4">{{ $content->banner_quote ?? '' }}</textarea>
    <small class="form-text text-muted">Texte descriptif de l'atelier</small>
</div>
<div class="form-group">
    <label for="banner_background">Image de fond (URL ou chemin)</label>
    <input type="text" class="form-control" id="banner_background" name="banner_background" value="{{ $content->banner_background ?? '' }}">
</div>

<hr class="my-4">

{{-- Tabs Section --}}
<h5 class="text-primary">Onglets de Navigation</h5>
<div class="form-row">
    <div class="form-group col-md-3">
        <label for="tab_atelier">Onglet 1</label>
        <input type="text" class="form-control" id="tab_atelier" name="tab_atelier" value="{{ $content->tab_atelier ?? '' }}">
    </div>
    <div class="form-group col-md-3">
        <label for="tab_activites">Onglet 2</label>
        <input type="text" class="form-control" id="tab_activites" name="tab_activites" value="{{ $content->tab_activites ?? '' }}">
    </div>
    <div class="form-group col-md-3">
        <label for="tab_evenements">Onglet 3</label>
        <input type="text" class="form-control" id="tab_evenements" name="tab_evenements" value="{{ $content->tab_evenements ?? '' }}">
    </div>
    <div class="form-group col-md-3">
        <label for="tab_podcasts">Onglet 4</label>
        <input type="text" class="form-control" id="tab_podcasts" name="tab_podcasts" value="{{ $content->tab_podcasts ?? '' }}">
    </div>
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

