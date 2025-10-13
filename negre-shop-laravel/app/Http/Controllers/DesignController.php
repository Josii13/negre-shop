<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    /**
     * Afficher la page design mobilier
     */
    public function index()
    {
        // Récupérer la catégorie design
        $category = Category::where('slug', 'design')->firstOrFail();

        // Récupérer tous les produits de design
        $products = Product::byCategory('design')
            ->available()
            ->ordered()
            ->get();

        return view('design', compact('category', 'products'));
    }
}

