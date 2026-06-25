<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();

        $query = Product::with('category');

        if (request()->has('category') && request('category')) {
            $query->where('category_id', request('category'));
        }

        $products = $query->latest()->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(string $slug)
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('products.show', compact('product'));
    }
}