 @extends('layouts.app')
@section('title', 'Mon Panier')

@section('content')

<div class="bg-cream-100 border-b border-cream-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900">Mon Panier</h1>
        <p class="text-gray-500 mt-1">
            @php $count = collect($cart)->sum('quantity'); @endphp
            {{ $count }} article{{ $count > 1 ? 's' : '' }}
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    @if(empty($cart))
        {{-- Empty cart --}}
        <div class="text-center py-24">
            <div class="w-24 h-24 bg-cream-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-semibold text-gray-700 mb-2">Votre panier est vide</h2>
            <p class="text-gray-400 mb-8">Ajoutez des produits pour commencer vos achats</p>
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center gap-2 bg-sage-700 hover:bg-sage-800 text-white font-semibold px-8 py-3.5 rounded-full transition-all shadow-md">
                Découvrir nos produits
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Cart items --}}
            <div class="lg:col-span-2 space-y-4">
                @foreach($cart as $id => $item)
                <div class="bg-white border border-cream-300 rounded-2xl p-5 flex gap-4 items-center shadow-sm">
                    {{-- Product image --}}
                    <div class="w-20 h-20 rounded-xl overflow-hidden bg-cream-100 flex-shrink-0">
                         @if(!empty($item['image']))
                            <img src="{{ asset('storage/' . $item['image']) }}"
                                 alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-2xl">🌿</div>
                        @endif
                    </div>

                    {{-- Details --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 text-sm leading-snug truncate">{{ $item['name'] }}</h3>
                        <p class="text-sage-600 font-medium text-sm mt-0.5">{{ number_format($item['price'], 2) }} MAD / unité</p>
                    </div>

                    {{-- Quantity update --}}
                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        <div class="flex items-center border border-cream-400 rounded-xl overflow-hidden bg-white">
                            <button type="button"
                                    onclick="this.closest('form').querySelector('input').value = Math.max(1, parseInt(this.closest('form').querySelector('input').value) - 1)"
                                    class="px-2.5 py-1.5 text-gray-500 hover:bg-cream-100 transition-colors text-sm">−</button>
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                   class="w-10 text-center text-sm py-1.5 focus:outline-none border-x border-cream-400 bg-transparent font-medium">
                            <button type="button"
                                    onclick="this.closest('form').querySelector('input').value = parseInt(this.closest('form').querySelector('input').value) + 1"
                                    class="px-2.5 py-1.5 text-gray-500 hover:bg-cream-100 transition-colors text-sm">+</button>
                        </div>
                        <button type="submit"
                                class="text-xs text-gray-400 hover:text-sage-700 font-medium transition-colors whitespace-nowrap">
                            Màj
                        </button>
                    </form>

                    {{-- Subtotal --}}
                    <div class="text-right flex-shrink-0 hidden sm:block">
                        <p class="font-bold text-gray-900">{{ number_format($item['price'] * $item['quantity'], 2) }} MAD</p>
                    </div>

                    {{-- Remove --}}
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors"
                                onclick="return confirm('Supprimer ce produit ?')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
                @endforeach

                <div class="mt-4">
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center gap-1.5 text-sm text-sage-700 hover:text-sage-800 font-medium group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
                        Continuer les achats
                    </a>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-1">
                <div class="bg-white border border-cream-300 rounded-2xl p-6 shadow-sm sticky top-24">
                    <h2 class="text-lg font-bold text-gray-900 mb-5">Résumé</h2>

                    <div class="space-y-3 mb-5">
                        @foreach($cart as $item)
                        <div class="flex justify-between text-sm text-gray-600">
                            <span class="truncate mr-2">{{ $item['name'] }} <span class="text-gray-400">×{{ $item['quantity'] }}</span></span>
                            <span class="font-medium whitespace-nowrap">{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-cream-300 pt-4 mb-6">
                        <div class="flex justify-between text-base font-bold text-gray-900">
                            <span>Total</span>
                            <span class="text-sage-700 text-lg">{{ number_format($total, 2) }} MAD</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Livraison calculée à la commande</p>
                    </div>

                    <a href="{{ route('checkout.index') }}"
                       class="block w-full text-center bg-sage-700 hover:bg-sage-800 text-white font-semibold py-4 rounded-xl transition-all shadow-md hover:shadow-lg">
                        Passer la commande →
                    </a>

                    <div class="mt-4 flex items-center justify-center gap-2 text-xs text-gray-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Paiement sécurisé
                    </div>
                </div>
            </div>

        </div>
    @endif
</div>

@endsection