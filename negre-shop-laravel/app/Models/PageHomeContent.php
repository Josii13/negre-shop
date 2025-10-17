<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageHomeContent extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_description',
        'hero_cta_text',
        'hero_cta_link',
        'about_title',
        'about_description',
        'about_image',
        'features_title',
        'features_description',
        'cta_title',
        'cta_description',
        'cta_button_text',
        'cta_button_link',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}

