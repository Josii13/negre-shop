<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageGalleryContent extends Model
{
    protected $fillable = [
        'banner_title',
        'banner_subtitle',
        'banner_description',
        'banner_quote',
        'banner_background',
        'tab_atelier',
        'tab_activites',
        'tab_evenements',
        'tab_podcasts',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}

