<?php

namespace App\Http\Controllers;

use App\Models\CarouselSlide;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Afficher la page d'accueil
     */
    public function index()
    {
        // Récupérer les slides du carousel
        $slides = CarouselSlide::active()->ordered()->get();

        // Récupérer les catégories pour les cartes
        $categories = Category::active()->ordered()->get();

        // Récupérer les produits en vedette
        $featuredProducts = Product::featured()->available()->take(4)->get();

        return view('home', compact('slides', 'categories', 'featuredProducts'));
    }
}

