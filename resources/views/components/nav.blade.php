<!-- Ajoutez FontAwesome dans votre layout principal -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<style>
    /* Animations personnalisées */
    @keyframes slideDown {
        from { transform: translateY(-10px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    @keyframes glow {
        0%, 100% { box-shadow: 0 0 20px rgba(255, 193, 7, 0.3); }
        50% { box-shadow: 0 0 30px rgba(255, 193, 7, 0.6); }
    }
    
    .animate-slideDown {
        animation: slideDown 0.3s ease-out;
    }
    
    .animate-glow {
        animation: glow 2s ease-in-out infinite;
    }
    
    /* Effet glassmorphisme */
    .glass-effect {
        background: rgba(0, 0, 0, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 193, 7, 0.2);
    }
    
    /* Style pour les icônes */
    .icon-bounce {
        transition: transform 0.3s ease;
    }
    
    .icon-bounce:hover {
        transform: scale(1.1) rotate(5deg);
    }
    
    /* Notification badge */
    .notification-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ef4444;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: bold;
        animation: pulse 2s infinite;
    }
</style>

<nav class="glass-effect border-b border-yellow-500/30 py-4 sticky top-0 z-50 transition-all duration-300">
    <div class="flex flex-wrap items-center justify-between max-w-7xl px-6 mx-auto">
        <!-- Logo Premium -->
        <a href="{{ route('produits.index') }}" class="flex items-center group">
            <div class="relative">
                <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center animate-glow overflow-hidden">
    <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="w-full h-full object-cover rounded-full">
</div>

                <!-- Badge de notification (optionnel) -->
                @auth
                    @if(session('cart_count', 0) > 0)
                        <div class="notification-badge">{{ session('cart_count', 0) }}</div>
                    @endif
                @endauth
            </div>
            <div class="ml-4">
                <span class="text-2xl font-bold bg-gradient-to-r from-yellow-400 to-yellow-600 bg-clip-text text-transparent">
                    Zinou Shop
                </span>
                <div class="text-xs text-gray-400">Premium Store</div>
            </div>
        </a>

        <!-- Bouton menu mobile premium -->
        <button onclick="toggleMenu()" type="button"
            class="inline-flex items-center p-3 ml-1 text-white bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl lg:hidden hover:from-yellow-600 hover:to-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-300 transition-all duration-300 shadow-lg">
            <i id="menu-icon" class="fas fa-bars text-lg"></i>
        </button>

        <!-- Menu Desktop Premium -->
        <div class="hidden w-full lg:flex lg:w-auto lg:order-1" id="desktop-menu">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-2 lg:mt-0">
                <li>
                    <a href="{{ route('produits.index') }}" 
                       class="flex items-center px-4 py-2 rounded-xl transition-all duration-300 group
                       {{ request()->routeIs('produits.index') ? 'bg-yellow-500 text-black font-semibold' : 'text-yellow-400 hover:bg-yellow-500 hover:text-black' }}">
                        <i class="fas fa-home mr-2 icon-bounce"></i>
                        <span>Accueil</span>
                    </a>
                </li>
                
                @guest
                    <li>
                        <a href="{{ route('login.index') }}" 
                           class="flex items-center px-4 py-2 rounded-xl transition-all duration-300 group
                           {{ request()->routeIs('login.index') ? 'bg-blue-500 text-white font-semibold' : 'text-yellow-400 hover:bg-blue-500 hover:text-white' }}">
                            <i class="fas fa-sign-in-alt mr-2 icon-bounce"></i>
                            <span>Se connecter</span>
                        </a>
                    </li>
                @endguest
                
            @if(session('role') == 'admin')
                    <li>
                        <a href="{{ route('produits.create') }}" 
                           class="flex items-center px-4 py-2 rounded-xl transition-all duration-300 group
                           {{ request()->routeIs('produits.create') ? 'bg-green-500 text-white font-semibold' : 'text-yellow-400 hover:bg-green-500 hover:text-white' }}">
                            <i class="fas fa-plus-circle mr-2 icon-bounce"></i>
                            <span>Ajouter Produit</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}" 
                           class="flex items-center px-4 py-2 rounded-xl transition-all duration-300 group
                           {{ request()->routeIs('orders.index') ? 'bg-purple-500 text-white font-semibold' : 'text-yellow-400 hover:bg-purple-500 hover:text-white' }}">
                            <i class="fas fa-clipboard-list mr-2 icon-bounce"></i>
                            <span>Commandes</span>
                        </a>

                    </li>
                    <li>
                        <form action="{{ route('login.show', Auth::user()->id) }}" method="POST">
                                        @csrf
                                          <button type="submit"
                                          class="w-full flex items-center gap-2 px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors rounded-md">
                                            <i class="fas fa-user-circle text-lg"></i>
                                                        <span>Mon Profil</span>
                                              </button>
                                        </form>
                    </li>

            @endif
                
                @auth
                    <!-- Profil utilisateur (optionnel) -->
                    <li class="relative group">
                        <button class="flex items-center px-4 py-2 rounded-xl transition-all duration-300 text-yellow-400 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-user mr-2 icon-bounce"></i>
                            <span>{{ auth()->user()->name ?? 'Utilisateur' }}</span>
                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                        </button>
                        
                        <!-- Dropdown menu (optionnel) -->
                        <div class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="py-2">
                              

                                <hr class="border-gray-700 my-2">
                                <form action="{{ route('logout') }}" method="POST"  class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-red-500 hover:text-white transition-colors">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
             @endauth
            </ul>
        </div>
    </div>

    <!-- Menu Mobile Premium -->
    <div class="hidden w-full lg:hidden transition-all duration-300 ease-in-out animate-slideDown" id="mobile-menu-2">
        <div class="px-6 py-4 bg-black/50 backdrop-blur-sm rounded-b-2xl mt-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('produits.index') }}" 
                       class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group
                       {{ request()->routeIs('produits.index') ? 'bg-yellow-500 text-black font-semibold' : 'text-yellow-400 hover:bg-yellow-500 hover:text-black' }}">
                        <i class="fas fa-home mr-3 text-lg"></i>
                        <span>Accueil</span>
                    </a>
                </li>
                
                @guest
                    <li>
                        <a href="{{ route('login.index') }}" 
                           class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group
                           {{ request()->routeIs('login.index') ? 'bg-blue-500 text-white font-semibold' : 'text-yellow-400 hover:bg-blue-500 hover:text-white' }}">
                            <i class="fas fa-sign-in-alt mr-3 text-lg"></i>
                            <span>Se connecter</span>
                        </a>
                    </li>
                @endguest
                
                @if(session('role') == 'admin')
                    <li>
                        <a href="{{ route('produits.create') }}" 
                           class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group
                           {{ request()->routeIs('produits.create') ? 'bg-green-500 text-white font-semibold' : 'text-yellow-400 hover:bg-green-500 hover:text-white' }}">
                            <i class="fas fa-plus-circle mr-3 text-lg"></i>
                            <span>Ajouter Produit</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}" 
                           class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group
                           {{ request()->routeIs('orders.index') ? 'bg-purple-500 text-white font-semibold' : 'text-yellow-400 hover:bg-purple-500 hover:text-white' }}">
                            <i class="fas fa-clipboard-list mr-3 text-lg"></i>
                            <span>Commandes</span>
                        </a>
                    </li>
                @endif
                
                @auth
                    <!-- Profil mobile -->
                    <li>
                        <div class="px-4 py-3 border-t border-gray-700 mt-4">
                            <div class="flex items-center text-yellow-400 mb-2">
                                <i class="fas fa-user mr-3 text-lg"></i>
                                <span class="font-semibold">{{ auth()->user()->name ?? 'Utilisateur' }}</span>
                            </div>
                           <form action="{{ route('login.show', Auth::user()->id) }}" method="POST">
                              @csrf
                              <button type="submit"
                               class="w-full flex items-center gap-2 px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors rounded-md">
                                    <i class="fas fa-user-circle text-lg"></i>
                               <span>Mon Profil</span>
                                </button>
                               </form>       

                        </div>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 text-yellow-400 hover:bg-red-500 hover:text-white group w-full text-left">
                                <i class="fas fa-sign-out-alt mr-3 text-lg"></i>
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<script>
    function toggleMenu() {
        const menu = document.getElementById('mobile-menu-2');
        const menuIcon = document.getElementById('menu-icon');
        
        menu.classList.toggle('hidden');
        
        // Changer l'icône
        if (menu.classList.contains('hidden')) {
            menuIcon.classList.remove('fa-times');
            menuIcon.classList.add('fa-bars');
        } else {
            menuIcon.classList.remove('fa-bars');
            menuIcon.classList.add('fa-times');
        }
        
        // Animation
        if (!menu.classList.contains('hidden')) {
            menu.style.maxHeight = menu.scrollHeight + 'px';
            setTimeout(() => {
                menu.style.maxHeight = 'none';
            }, 300);
        } else {
            menu.style.maxHeight = menu.scrollHeight + 'px';
            setTimeout(() => {
                menu.style.maxHeight = '0';
            }, 10);
        }
    }

    // Fermer le menu mobile au clic sur un lien
    document.querySelectorAll('#mobile-menu-2 a').forEach(link => {
        link.addEventListener('click', () => {
            const menu = document.getElementById('mobile-menu-2');
            const menuIcon = document.getElementById('menu-icon');
            
            menu.classList.add('hidden');
            menuIcon.classList.remove('fa-times');
            menuIcon.classList.add('fa-bars');
        });
    });

    // Effet de scroll sur la navigation
    window.addEventListener('scroll', () => {
        const nav = document.querySelector('nav');
        if (window.scrollY > 50) {
            nav.classList.add('backdrop-blur-md');
        } else {
            nav.classList.remove('backdrop-blur-md');
        }
    });

    // Fermer les dropdowns au clic extérieur
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.group')) {
            document.querySelectorAll('.group').forEach(group => {
                group.classList.remove('hover');
            });
        }
    });
</script>