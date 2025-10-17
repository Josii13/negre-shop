<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_marques_contents', function (Blueprint $table) {
            $table->id();
            // Banner Section (dynamique par catégorie)
            $table->text('banner_default_description')->nullable();
            $table->string('banner_background')->nullable();
            
            // Introduction
            $table->string('intro_title')->nullable();
            $table->text('intro_text')->nullable();
            
            // Grid Section
            $table->string('grid_title')->default('Nos Produits');
            $table->text('grid_subtitle')->nullable();
            
            // WhatsApp Message Template
            $table->text('whatsapp_message_template')->default('Bonjour, je souhaite commander le produit suivant : {product_name}');
            
            // Meta SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_marques_contents');
    }
};

