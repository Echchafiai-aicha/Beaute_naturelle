@extends('layouts.app')
@section('title', 'Finaliser la commande')

@section('content')

<div class="bg-cream-100 border-b border-cream-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-3">
            <a href="{{ route('cart.index') }}" class="hover:text-sage-700 transition-colors">Panier</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-800 font-medium">Commande</span>
        </nav>
        <h1 class="text-3xl font-bold text-gray-900">Finaliser la commande</h1>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Checkout Form --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Customer Info --}}
                <div class="bg-white border border-cream-300 rounded-2xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <span class="w-7 h-7 bg-sage-700 text-white rounded-full text-xs font-bold flex items-center justify-center">1</span>
                        Vos informations
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Nom complet --}}
                        <div class="sm:col-span-2">
                            <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Nom complet <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="customer_name" name="customer_name"
                                   value="{{ old('customer_name') }}"
                                   placeholder="Aicha Echchafiai"
                                   class="w-full px-4 py-3 rounded-xl border {{ $errors->has('customer_name') ? 'border-red-400 bg-red-50' : 'border-cream-400 bg-white' }} focus:outline-none focus:ring-2 focus:ring-sage-400 focus:border-transparent transition text-sm">
                            @error('customer_name')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Email <span class="text-red-400">*</span>
                            </label>
                            <input type="email" id="customer_email" name="customer_email"
                                   value="{{ old('customer_email') }}"
                                   placeholder="aicha@exemple.ma"
                                   class="w-full px-4 py-3 rounded-xl border {{ $errors->has('customer_email') ? 'border-red-400 bg-red-50' : 'border-cream-400 bg-white' }} focus:outline-none focus:ring-2 focus:ring-sage-400 focus:border-transparent transition text-sm">
                            @error('customer_email')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Téléphone --}}
                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Téléphone <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="customer_phone" name="customer_phone"
                                   value="{{ old('customer_phone') }}"
                                   placeholder="+212 6 00 00 00 00"
                                   class="w-full px-4 py-3 rounded-xl border {{ $errors->has('customer_phone') ? 'border-red-400 bg-red-50' : 'border-cream-400 bg-white' }} focus:outline-none focus:ring-2 focus:ring-sage-400 focus:border-transparent transition text-sm">
                            @error('customer_phone')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Delivery Info --}}
                <div class="bg-white border border-cream-300 rounded-2xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <span class="w-7 h-7 bg-sage-700 text-white rounded-full text-xs font-bold flex items-center justify-center">2</span>
                        Adresse de livraison
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Adresse --}}
                        <div class="sm:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Adresse complète <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="address" name="address"
                                   value="{{ old('address') }}"
                                   placeholder="123, Rue Mohammed V, Guéliz"
                                   class="w-full px-4 py-3 rounded-xl border {{ $errors->has('address') ? 'border-red-400 bg-red-50' : 'border-cream-400 bg-white' }} focus:outline-none focus:ring-2 focus:ring-sage-400 focus:border-transparent transition text-sm">
                            @error('address')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Ville --}}
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Ville <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="city" name="city"
                                   value="{{ old('city') }}"
                                   placeholder="Marrakech"
                                   class="w-full px-4 py-3 rounded-xl border {{ $errors->has('city') ? 'border-red-400 bg-red-50' : 'border-cream-400 bg-white' }} focus:outline-none focus:ring-2 focus:ring-sage-400 focus:border-transparent transition text-sm">
                            @error('city')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Notes --}}
                        <div class="sm:col-span-2">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Notes <span class="text-gray-400 font-normal">(optionnel)</span>
                            </label>
                            <textarea id="notes" name="notes" rows="3"
                                      placeholder="Instructions de livraison, préférences..."
                                      class="w-full px-4 py-3 rounded-xl border border-cream-400 focus:outline-none focus:ring-2 focus:ring-sage-400 focus:border-transparent transition text-sm resize-none">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Order Summary Sidebar --}}
            <div class="lg:col-span-1">
                <div class="bg-white border border-cream-300 rounded-2xl p-6 shadow-sm sticky top-24">
                    <h2 class="text-lg font-bold text-gray-900 mb-5">Votre commande</h2>

                    <div class="space-y-3 mb-5 max-h-60 overflow-y-auto">
                        @foreach($cart as $item)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-cream-100 overflow-hidden flex-shrink-0">
                                 @if(!empty($item['image']))
                                    <img src="{{ asset('storage/' . $item['image']) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-lg">🌿</div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-medium text-gray-800 truncate">{{ $item['name'] }}</p>
                                <p class="text-xs text-gray-400">× {{ $item['quantity'] }}</p>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 whitespace-nowrap">
                                {{ number_format($item['price'] * $item['quantity'], 2) }}
                            </span>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-cream-300 pt-4 space-y-2 mb-6">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Sous-total</span>
                            <span>{{ number_format($total, 2) }} MAD</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Livraison</span>
                            <span class="text-sage-600 font-medium">Gratuite</span>
                        </div>
                        <div class="flex justify-between text-base font-bold text-gray-900 pt-2 border-t border-cream-300">
                            <span>Total TTC</span>
                            <span class="text-sage-700 text-lg">{{ number_format($total, 2) }} MAD</span>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full bg-sage-700 hover:bg-sage-800 active:bg-sage-900 text-white font-semibold py-4 rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Confirmer la commande
                    </button>

                    <div class="mt-4 flex items-center justify-center gap-1.5 text-xs text-gray-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Commande sécurisée
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

@endsection