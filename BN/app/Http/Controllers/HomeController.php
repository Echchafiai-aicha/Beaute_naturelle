<?php
// ============================================================
// app/Http/Controllers/HomeController.php
// ============================================================
namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->where('stock', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('featuredProducts'));
    }
}