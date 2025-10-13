<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    /**
     * Afficher la page marque
     */
    public function index()
    {
        // Récupérer la catégorie marque
        $category = Category::where('slug', 'marque')->firstOrFail();

        // Récupérer tous les produits de la marque
        $products = Product::byCategory('marque')
            ->available()
            ->ordered()
            ->get();

        return view('marques', compact('category', 'products'));
    }
}

