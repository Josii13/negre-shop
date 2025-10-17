<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageMarquesContent extends Model
{
    protected $fillable = [
        'banner_default_description',
        'banner_background',
        'intro_title',
        'intro_text',
        'grid_title',
        'grid_subtitle',
        'whatsapp_message_template',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}

