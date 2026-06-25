@extends('layouts.app')
@section('title', 'Accueil — Cosmétiques Naturels')

@section('content')

{{-- Hero Section --}}
<section class="relative overflow-hidden bg-gradient-to-br from-sage-800 via-sage-700 to-sage-900 text-white">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-72 h-72 bg-cream-200 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-sage-400 rounded-full filter blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
        <div class="max-w-2xl">
            <span class="inline-block bg-sage-600/50 text-sage-200 text-xs font-semibold uppercase tracking-widest px-3 py-1 rounded-full mb-6 border border-sage-500/30">
                🌿 100% Naturel · Artisanal · Marocain
            </span>
            <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                La beauté que<br>
                <span class="text-cream-300">la nature vous offre</span>
            </h1>
            <p class="text-lg text-sage-200 mb-8 leading-relaxed">
                Découvrez notre sélection de cosmétiques naturels, formulés avec les richesses botaniques du Maroc. De l'huile d'argan au rhassoul, pour une routine beauté authentique et efficace.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center gap-2 bg-white text-sage-800 hover:bg-cream-100 font-semibold px-7 py-3.5 rounded-full transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    Découvrir nos produits
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('cart.index') }}"
                   class="inline-flex items-center gap-2 border border-sage-400 text-white hover:bg-sage-700/50 font-medium px-7 py-3.5 rounded-full transition-all">
                    Mon panier
                </a>
            </div>
        </div>
    </div>

    {{-- Decorative wave --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 60L48 50C96 40 192 20 288 15C384 10 480 20 576 27.5C672 35 768 40 864 37.5C960 35 1056 25 1152 20C1248 15 1344 15 1392 15L1440 15V60H1392C1344 60 1248 60 1152 60C1056 60 960 60 864 60C768 60 672 60 576 60C480 60 384 60 288 60C192 60 96 60 48 60H0Z" fill="#fdfcf8"/>
        </svg>
    </div>
</section>

{{-- Trust badges --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach([
            ['🌱', 'Ingrédients naturels', '100% végétal, sans parabènes'],
            ['🇲🇦', 'Fabriqué au Maroc', 'Savoir-faire artisanal local'],
            ['🚚', 'Livraison rapide', 'Partout au Maroc'],
            ['💚', 'Éco-responsable', 'Emballages recyclables'],
        ] as $badge)
        <div class="bg-white border border-cream-300 rounded-2xl p-5 text-center hover:shadow-md transition-shadow">
            <div class="text-3xl mb-2">{{ $badge[0] }}</div>
            <div class="font-semibold text-sm text-gray-800">{{ $badge[1] }}</div>
            <div class="text-xs text-gray-500 mt-1">{{ $badge[2] }}</div>
        </div>
        @endforeach
    </div>
</section>

{{-- Featured Products --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-20">
    <div class="flex items-end justify-between mb-10">
        <div>
            <p class="text-sage-600 text-sm font-medium uppercase tracking-widest mb-1">Nos favoris</p>
            <h2 class="text-3xl font-bold text-gray-900">Produits populaires</h2>
        </div>
        <a href="{{ route('products.index') }}" class="text-sage-700 hover:text-sage-800 font-medium text-sm flex items-center gap-1 group">
            Voir tout
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($featuredProducts as $product)
            @include('partials.product-card', ['product' => $product])
        @empty
            <p class="col-span-4 text-center text-gray-400 py-12">Aucun produit disponible pour le moment.</p>
        @endforelse
    </div>
</section>

{{-- CTA Banner --}}
<section class="bg-cream-200 border-y border-cream-300">
    <div class="max-w-4xl mx-auto px-4 py-16 text-center">
        <h2 class="text-3xl font-bold text-sage-900 mb-4">Prête à prendre soin de vous ?</h2>
        <p class="text-sage-700 mb-8">Explorez notre catalogue complet de cosmétiques naturels et trouvez votre routine beauté idéale.</p>
        <a href="{{ route('products.index') }}"
           class="inline-flex items-center gap-2 bg-sage-700 hover:bg-sage-800 text-white font-semibold px-8 py-4 rounded-full transition-all shadow-md hover:shadow-lg">
            Explorer le catalogue
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</section>

@endsection