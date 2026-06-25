<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Affiche la page panier.
     */
    public function index()
    {
        $cart  = session()->get('cart', []);
        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Ajoute un produit au panier.
     */
    public function add(Request $request, int $id)
    {
        $request->validate([
            'quantity' => 'sometimes|integer|min:1|max:99',
        ]);

        $product  = Product::findOrFail($id);
        $quantity = max(1, (int) $request->input('quantity', 1));
        $cart     = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Produit déjà présent : on incrémente la quantité
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => (float) $product->price,
                'image'    => $product->image,
                'slug'     => $product->slug,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', '"' . $product->name . '" ajouté au panier !');
    }

    /**
     * Met à jour la quantité d'un produit.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = (int) $request->input('quantity');
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Panier mis à jour.');
    }

    /**
     * Supprime un produit du panier.
     */
    public function remove(int $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $name = $cart[$id]['name'];
            unset($cart[$id]);
            session()->put('cart', $cart);

            return redirect()->route('cart.index')
                ->with('success', '"' . $name . '" retiré du panier.');
        }

        return redirect()->route('cart.index');
    }
}