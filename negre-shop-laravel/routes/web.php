<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeintureController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;

/**
 * Routes publiques du site
 */

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Page Peinture
Route::get('/peinture', [PeintureController::class, 'index'])->name('peinture');

// Page Design
Route::get('/design', [DesignController::class, 'index'])->name('design');

// Page Marque
Route::get('/marque', [MarqueController::class, 'index'])->name('marque');

// Page Gallery (NÈGRE Workshop)
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// Page Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Commandes
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
