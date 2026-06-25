<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Affiche la page checkout.
     * Redirige vers le panier si celui-ci est vide.
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide. Ajoutez des produits avant de commander.');
        }

        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        return view('checkout.index', compact('cart', 'total'));
    }

    /**
     * Valide le formulaire et enregistre la commande.
     */
    public function store(Request $request)
    {
        // Vérification anti-bypass : panier non vide
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        // Validation des champs du formulaire
        $validated = $request->validate([
            'customer_name'  => 'required|string|max:150',
            'customer_email' => 'required|email|max:150',
            'customer_phone' => 'required|string|max:30',
            'address'        => 'required|string|max:255',
            'city'           => 'required|string|max:100',
            'notes'          => 'nullable|string|max:1000',
        ], [
            'customer_name.required'  => 'Le nom complet est obligatoire.',
            'customer_email.required' => 'L\'adresse email est obligatoire.',
            'customer_email.email'    => 'Veuillez entrer un email valide.',
            'customer_phone.required' => 'Le numéro de téléphone est obligatoire.',
            'address.required'        => 'L\'adresse de livraison est obligatoire.',
            'city.required'           => 'La ville est obligatoire.',
        ]);

        // Calcul du total côté serveur (jamais depuis le client)
        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        // Création de la commande
        $order = Order::create([
            'customer_name'  => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'address'        => $validated['address'],
            'city'           => $validated['city'],
            'notes'          => $validated['notes'] ?? null,
            'total_price'    => $total,
            'status'         => 'pending',
        ]);

        // Création des lignes de commande (snapshot du prix)
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],   // prix au moment de l'achat
            ]);
        }

        // Vider le panier après confirmation
        session()->forget('cart');

        return redirect()->route('checkout.thankyou', $order->id);
    }

    /**
     * Affiche la page de confirmation.
     */
    public function thankYou(int $orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);

        return view('checkout.thankyou', compact('order'));
    }
}