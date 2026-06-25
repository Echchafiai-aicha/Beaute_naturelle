@extends('layouts.app')
@section('title', $product->name)

@section('content')

{{-- Breadcrumb --}}
<div class="bg-cream-100 border-b border-cream-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-sage-700 transition-colors">Accueil</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('products.index') }}" class="hover:text-sage-700 transition-colors">Produits</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-800 font-medium truncate max-w-xs">{{ $product->name }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">

        {{-- Image --}}
        <div class="relative">
            <div class="aspect-square rounded-3xl overflow-hidden bg-cream-100 border border-cream-300">
               @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-cream-100 to-sage-50">
                        <span class="text-9xl">🌿</span>
                    </div>
                @endif
            </div>
            @if($product->stock <= 5 && $product->stock > 0)
                <div class="absolute top-4 left-4 bg-amber-100 text-amber-700 text-xs font-semibold px-3 py-1.5 rounded-full border border-amber-200">
                    Plus que {{ $product->stock }} en stock
                </div>
            @elseif($product->stock <= 0)
                <div class="absolute top-4 left-4 bg-red-100 text-red-700 text-xs font-semibold px-3 py-1.5 rounded-full border border-red-200">
                    Rupture de stock
                </div>
            @endif
        </div>

        {{-- Product Info --}}
        <div class="flex flex-col">
            <span class="text-sage-600 text-sm font-medium uppercase tracking-widest mb-3">
                {{ $product->category->name ?? 'Cosmétique naturel' }}
            </span>

            <h1 class="text-4xl font-bold text-gray-900 leading-tight mb-4">{{ $product->name }}</h1>

            <div class="flex items-baseline gap-3 mb-6">
                <span class="text-3xl font-bold text-sage-700">{{ number_format($product->price, 2) }} MAD</span>
                <span class="text-sm text-gray-400">TTC</span>
            </div>

            <div class="w-12 h-0.5 bg-cream-400 mb-6"></div>

            <p class="text-gray-600 leading-relaxed mb-8">{{ $product->description }}</p>

            {{-- Add to cart form --}}
            @if($product->stock > 0)
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="flex items-center gap-4 mb-6">
                        <div class="flex flex-col gap-1">
                            <label class="text-xs text-gray-500 font-medium uppercase tracking-wider">Quantité</label>
                            <div class="flex items-center border border-cream-400 rounded-xl overflow-hidden bg-white">
                                <button type="button" onclick="adjustQty(-1)"
                                        class="px-4 py-3 text-gray-500 hover:bg-cream-100 transition-colors text-lg font-medium">−</button>
                                <input type="number" name="quantity" id="qty-input" value="1" min="1" max="{{ $product->stock }}"
                                       class="w-14 text-center py-3 text-gray-800 font-semibold focus:outline-none bg-transparent border-x border-cream-400 text-sm">
                                <button type="button" onclick="adjustQty(1)"
                                        class="px-4 py-3 text-gray-500 hover:bg-cream-100 transition-colors text-lg font-medium">+</button>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full bg-sage-700 hover:bg-sage-800 active:bg-sage-900 text-white font-semibold py-4 px-8 rounded-2xl transition-all flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Ajouter au panier
                    </button>
                </form>
            @else
                <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl text-sm font-medium">
                    Ce produit est actuellement en rupture de stock.
                </div>
            @endif

            {{-- Guarantees --}}
            <div class="mt-8 grid grid-cols-3 gap-3">
                @foreach([
                    ['🌱', '100% Naturel'],
                    ['🚚', 'Livraison rapide'],
                    ['↩️', 'Retour facile'],
                ] as $item)
                <div class="bg-cream-50 border border-cream-200 rounded-xl p-3 text-center">
                    <div class="text-xl mb-1">{{ $item[0] }}</div>
                    <div class="text-xs text-gray-600 font-medium">{{ $item[1] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Back link --}}
    <div class="mt-12">
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-sage-700 hover:text-sage-800 font-medium text-sm group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
            Retour aux produits
        </a>
    </div>
</div>

<script>
function adjustQty(delta) {
    const input = document.getElementById('qty-input');
    const max = parseInt(input.max);
    let val = parseInt(input.value) + delta;
    input.value = Math.max(1, Math.min(max, val));
}
</script>

@endsection