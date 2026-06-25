<nav class="bg-white/95 backdrop-blur-sm border-b border-cream-300 sticky top-0 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-8 h-8 bg-sage-600 rounded-lg flex items-center justify-center group-hover:bg-sage-700 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l14 9-14 9V3z"/>
                    </svg>
                </div>
                <span class="text-xl font-bold text-sage-800 tracking-tight">Beauté<span class="text-sage-500">Naturelle</span></span>
            </a>

            {{-- Nav links --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}"
                   class="text-sm font-medium text-gray-600 hover:text-sage-700 transition-colors {{ request()->routeIs('home') ? 'text-sage-700 font-semibold' : '' }}">
                    Accueil
                </a>
                <a href="{{ route('products.index') }}"
                   class="text-sm font-medium text-gray-600 hover:text-sage-700 transition-colors {{ request()->routeIs('products.*') ? 'text-sage-700 font-semibold' : '' }}">
                    Produits
                </a>
            </div>

            {{-- Cart icon --}}
            <a href="{{ route('cart.index') }}" class="relative flex items-center gap-2 bg-sage-50 hover:bg-sage-100 text-sage-700 px-4 py-2 rounded-full transition-colors group">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <span class="text-sm font-medium hidden sm:inline">Panier</span>
                @php $cartCount = collect(session('cart', []))->sum('quantity'); @endphp
                @if($cartCount > 0)
                    <span class="cart-badge absolute -top-1 -right-1 bg-sage-600 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
        </div>
    </div>
</nav>