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
        Schema::create('modal_contents', function (Blueprint $table) {
            $table->id();
            
            // Modal Details (pour produits/activités)
            $table->string('detail_characteristics_title')->default('Caractéristiques');
            $table->string('detail_button_order')->default('Commander');
            $table->string('detail_button_reserve')->default('Réserver sur WhatsApp');
            
            // Modal Order (formulaire de commande)
            $table->string('order_title')->default('Commander');
            $table->string('order_label_name')->default('Nom');
            $table->string('order_label_email')->default('Email');
            $table->string('order_label_phone')->default('Téléphone');
            $table->string('order_label_message')->default('Message');
            $table->string('order_button_submit')->default('Envoyer');
            
            // Messages de succès/erreur
            $table->text('success_message')->default('Votre commande a été prise en compte avec succès.');
            $table->text('success_submessage')->default('Un email de confirmation vous sera envoyé sous peu.');
            $table->string('loading_title')->default('Envoi en cours...');
            $table->text('loading_message')->default('Veuillez patienter pendant que nous traitons votre demande.');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modal_contents');
    }
};
