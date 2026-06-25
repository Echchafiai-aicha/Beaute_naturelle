@extends('layouts.app')
@section('title', 'Nos Produits')

@section('content')

{{-- Page header --}}
<div class="bg-gradient-to-b from-cream-200 to-cream-50 border-b border-cream-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-4">
            <a href="{{ route('home') }}" class="hover:text-sage-700 transition-colors">Accueil</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-800 font-medium">Produits</span>
        </nav>
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Nos Produits</h1>
        <p class="text-gray-600">{{ $products->count() }} produit{{ $products->count() > 1 ? 's' : '' }} naturels disponibles</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Sidebar categories --}}
        <aside class="lg:w-56 flex-shrink-0">
            <div class="bg-white border border-cream-300 rounded-2xl p-5 sticky top-24">
                <h3 class="text-sm font-semibold text-gray-800 uppercase tracking-wider mb-4">Catégories</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('products.index') }}"
                           class="flex items-center justify-between px-3 py-2 rounded-xl text-sm font-medium transition-colors
                                  {{ !request('category') ? 'bg-sage-700 text-white' : 'text-gray-600 hover:bg-sage-50 hover:text-sage-700' }}">
                            <span>Tous les produits</span>
                            <span class="text-xs opacity-70">{{ $products->count() }}</span>
                        </a>
                    </li>
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('products.index', ['category' => $category->id]) }}"
                           class="flex items-center justify-between px-3 py-2 rounded-xl text-sm font-medium transition-colors
                                  {{ request('category') == $category->id ? 'bg-sage-700 text-white' : 'text-gray-600 hover:bg-sage-50 hover:text-sage-700' }}">
                            <span>{{ $category->name }}</span>
                            <span class="text-xs opacity-70">{{ $category->products->count() }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        {{-- Products grid --}}
        <div class="flex-1">
            @if(request('category'))
                <div class="mb-5 flex items-center gap-2 text-sm text-gray-600">
                    <span>Filtre actif :</span>
                    <span class="bg-sage-100 text-sage-700 px-3 py-1 rounded-full font-medium flex items-center gap-1">
                        {{ $categories->find(request('category'))->name ?? '' }}
                        <a href="{{ route('products.index') }}" class="ml-1 hover:text-red-500">✕</a>
                    </span>
                </div>
            @endif

            @if($products->isEmpty())
                <div class="text-center py-20 text-gray-400">
                    <div class="text-6xl mb-4">🌿</div>
                    <p class="text-lg font-medium">Aucun produit dans cette catégorie</p>
                    <a href="{{ route('products.index') }}" class="mt-4 inline-block text-sage-700 hover:underline">Voir tous les produits</a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@endsection