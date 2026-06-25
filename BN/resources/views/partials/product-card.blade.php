<div class="bg-white rounded-2xl overflow-hidden border border-cream-300 shadow-sm hover:shadow-md transition-all duration-300 group flex flex-col">

    {{-- Image --}}
    <a href="{{ route('products.show', $product->slug) }}" class="block overflow-hidden aspect-square bg-cream-100">
        @if($product->image && file_exists(public_path('storage/' . $product->image)))
            <img src="{{ asset('storage/' . $product->image) }}"
                 alt="{{ $product->name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-cream-100 to-sage-50">
                <span class="text-5xl">🌿</span>
            </div>
        @endif
    </a>

    {{-- Info --}}
    <div class="p-4 flex flex-col flex-1">
        <div class="flex-1">
            <span class="text-xs text-sage-600 font-medium uppercase tracking-wide">{{ $product->category->name ?? '' }}</span>
            <h3 class="font-semibold text-gray-900 mt-0.5 text-sm leading-snug">
                <a href="{{ route('products.show', $product->slug) }}" class="hover:text-sage-700 transition-colors">
                    {{ $product->name }}
                </a>
            </h3>
        </div>

        <div class="mt-3 flex items-center justify-between">
            <span class="text-sage-700 font-bold text-base">{{ number_format($product->price, 2) }} MAD</span>
            @if($product->stock <= 0)
                <span class="text-xs text-red-500 font-medium">Rupture</span>
            @endif
        </div>

        <div class="mt-3 flex gap-2">
            <a href="{{ route('products.show', $product->slug) }}"
               class="flex-1 text-center text-xs font-medium border border-sage-300 text-sage-700 hover:bg-sage-50 py-2 rounded-lg transition-colors">
                Voir détail
            </a>
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <button type="submit"
                        @if($product->stock <= 0) disabled @endif
                        class="w-full text-xs font-medium bg-sage-700 hover:bg-sage-800 text-white py-2 rounded-lg transition-colors disabled:opacity-40 disabled:cursor-not-allowed">
                    + Panier
                </button>
            </form>
        </div>
    </div>
</div>