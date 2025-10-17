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
        Schema::create('page_design_contents', function (Blueprint $table) {
            $table->id();
            // Banner Section
            $table->string('banner_title')->default('Design');
            $table->text('banner_description')->nullable();
            $table->string('banner_background')->nullable();
            
            // Introduction
            $table->string('intro_title')->nullable();
            $table->text('intro_text')->nullable();
            
            // Grid Section
            $table->string('grid_title')->default('Mes Créations');
            $table->text('grid_subtitle')->nullable();
            
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
        Schema::dropIfExists('page_design_contents');
    }
};

