<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Http\Requests\StoreOrderRequest;
use App\Models\User;
    
class OrderController extends Controller
{
    /**
     * Traiter une commande
     */
    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();

        // Récupérer le produit pour sauvegarder ses informations
        $product = Product::findOrFail($validated['product_id']);

        // Créer la commande
        Order::create([
            'product_id' => $validated['product_id'],
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'message' => $validated['message'] ?? null,
            'product_name' => $product->name,
            'product_price' => $product->price,
            'status' => 'pending',
        ]);

        // Créer ou mettre à jour l'utilisateur
        User::updateOrCreate(
            ['email' => $validated['customer_email']],
            [
                'name' => $validated['customer_name'],
                'phone' => $validated['customer_phone'],
                'type' => 'customer',
            ]
        );

        // Retourner une réponse JSON pour les requêtes AJAX
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Merci pour votre commande ! Nous vous contacterons bientôt.',
                'product_name' => $product->name,
                'product_price' => $product->formatted_price ?? $product->price . ' FCFA',
            ]);
        }

        return back()->with('success', 'Merci pour votre commande ! Nous vous contacterons bientôt.');
    }

    /**
     * Afficher les détails d'une commande
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }
}

