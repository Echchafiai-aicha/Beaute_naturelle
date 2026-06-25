<footer class="bg-sage-900 text-sage-200 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            {{-- Brand --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-sage-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l14 9-14 9V3z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">Natural<span class="text-sage-400">Shop</span></span>
                </div>
                <p class="text-sm text-sage-400 leading-relaxed">
                    Des cosmétiques 100% naturels, fabriqués avec soin au cœur du Maroc pour révéler votre beauté authentique.
                </p>
            </div>

            {{-- Links --}}
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Navigation</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-sage-400 hover:text-white transition-colors">Accueil</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-sage-400 hover:text-white transition-colors">Tous les produits</a></li>
                    <li><a href="{{ route('cart.index') }}" class="text-sage-400 hover:text-white transition-colors">Mon panier</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Contact</h4>
                <ul class="space-y-2 text-sm text-sage-400">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        contact@naturalshop.ma
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Marrakech, Maroc
                    </li>
                </ul>
            </div>

        </div>

        <div class="border-t border-sage-800 mt-10 pt-6 text-center text-xs text-sage-500">
            © {{ date('Y') }} Natural Shop. Tous droits réservés.
        </div>
    </div>
</footer>