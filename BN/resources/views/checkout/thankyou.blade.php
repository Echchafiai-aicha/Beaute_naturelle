@extends('layouts.app')
@section('title', 'Commande confirmée !')

@section('content')

<div class="min-h-screen bg-gradient-to-b from-cream-100 to-cream-50 flex items-center py-16">
    <div class="max-w-2xl mx-auto px-4 w-full">

        {{-- Success card --}}
        <div class="bg-white border border-cream-300 rounded-3xl shadow-lg overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-br from-sage-700 to-sage-900 px-8 py-10 text-center text-white">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold mb-2">Merci pour votre commande !</h1>
                <p class="text-sage-200 text-sm">Votre commande a été enregistrée avec succès.</p>
            </div>

            {{-- Order details --}}
            <div class="px-8 py-6">

                {{-- Order number --}}
                <div class="text-center mb-6 pb-6 border-b border-cream-300">
                    <p class="text-sm text-gray-500 mb-1">Numéro de commande</p>
                    <p class="text-3xl font-bold text-sage-700 font-mono tracking-wider">
                        #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                    </p>
                </div>

                {{-- Customer info --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div class="bg-cream-50 rounded-xl p-4">
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1.5">Client</p>
                        <p class="font-semibold text-gray-800 text-sm">{{ $order->customer_name }}</p>
                        <p class="text-gray-500 text-xs mt-0.5">{{ $order->customer_email }}</p>
                        <p class="text-gray-500 text-xs">{{ $order->customer_phone }}</p>
                    </div>
                    <div class="bg-cream-50 rounded-xl p-4">
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1.5">Livraison</p>
                        <p class="font-semibold text-gray-800 text-sm">{{ $order->city }}</p>
                        <p class="text-gray-500 text-xs mt-0.5">{{ $order->address }}</p>
                    </div>
                </div>

                {{-- Order items --}}
                <div class="mb-6">
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-3">Articles commandés</h3>
                    <div class="space-y-2">
                        @foreach($order->orderItems as $item)
                        <div class="flex items-center justify-between py-2.5 border-b border-cream-200 last:border-0">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg bg-cream-100 flex items-center justify-center text-sm overflow-hidden flex-shrink-0">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                    @else
                                        🌿
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">{{ $item->product->name ?? 'Produit' }}</p>
                                    <p class="text-xs text-gray-400">{{ $item->quantity }} × {{ number_format($item->price, 2) }} MAD</p>
                                </div>
                            </div>
                            <span class="text-sm font-semibold text-gray-700">
                                {{ number_format($item->quantity * $item->price, 2) }} MAD
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Total --}}
                <div class="bg-sage-50 border border-sage-200 rounded-xl px-5 py-4 flex justify-between items-center mb-6">
                    <span class="font-bold text-gray-800">Total payé</span>
                    <span class="text-xl font-bold text-sage-700">{{ number_format($order->total_price, 2) }} MAD</span>
                </div>

                @if($order->notes)
                <div class="bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 mb-6 text-sm text-amber-800">
                    <span class="font-semibold">Note :</span> {{ $order->notes }}
                </div>
                @endif

                {{-- CTA --}}
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('home') }}"
                       class="flex-1 text-center bg-sage-700 hover:bg-sage-800 text-white font-semibold py-3.5 rounded-xl transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Retour à l'accueil
                    </a>
                    <a href="{{ route('products.index') }}"
                       class="flex-1 text-center border border-sage-300 text-sage-700 hover:bg-sage-50 font-medium py-3.5 rounded-xl transition-all">
                        Continuer mes achats
                    </a>
                </div>
            </div>
        </div>

        {{-- Small message --}}
        <p class="text-center text-xs text-gray-400 mt-6">
            Un email de confirmation sera envoyé à <strong>{{ $order->customer_email }}</strong>
        </p>

    </div>
</div>

@endsection