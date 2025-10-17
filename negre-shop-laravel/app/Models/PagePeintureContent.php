<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagePeintureContent extends Model
{
    protected $fillable = [
        'banner_title',
        'banner_description',
        'banner_background',
        'intro_title',
        'intro_text',
        'grid_title',
        'grid_subtitle',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}

