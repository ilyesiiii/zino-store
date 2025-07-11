<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Component</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
        }
        
        .glow-effect {
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.3);
        }
        
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .social-hover:hover {
            transform: translateY(-3px) scale(1.1);
            transition: all 0.3s ease;
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .wave-effect {
            background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.4), transparent);
            animation: wave 3s infinite;
        }
        
        @keyframes wave {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    
    <!-- Footer -->
    <footer class="gradient-bg text-white relative overflow-hidden">
        <!-- Effet de vague animé -->
        <div class="absolute top-0 left-0 w-full h-1 wave-effect"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section principale -->
          
            
            <!-- Réseaux sociaux -->
            <div class="py-8 border-t border-yellow-400/20">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="text-center md:text-left">
                        <p class="text-gray-300">Suivez-nous sur les réseaux sociaux</p>
                    </div>
                    
                    <div class="flex space-x-4">
                        <!-- Facebook -->
                        <a href="#" class="w-12 h-12 rounded-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-black flex items-center justify-center social-hover glow-effect">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                                <path d="M22 12a10 10 0 1 0-11.63 9.87v-6.99H8.4v-2.88h1.97V9.41c0-1.94 1.15-3.01 2.9-3.01.84 0 1.72.15 1.72.15v1.9h-.97c-.96 0-1.25.6-1.25 1.21v1.46h2.13l-.34 2.88h-1.79v6.99A10 10 0 0 0 22 12" />
                            </svg>
                        </a>
                        
                        <!-- Instagram -->
                        <a href="#" class="w-12 h-12 rounded-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-black flex items-center justify-center social-hover glow-effect">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                                <path d="M7.75 2h8.5A5.76 5.76 0 0 1 22 7.75v8.5A5.76 5.76 0 0 1 16.25 22h-8.5A5.76 5.76 0 0 1 2 16.25v-8.5A5.76 5.76 0 0 1 7.75 2zm0 2A3.75 3.75 0 0 0 4 7.75v8.5A3.75 3.75 0 0 0 7.75 20h8.5A3.75 3.75 0 0 0 20 16.25v-8.5A3.75 3.75 0 0 0 16.25 4h-8.5zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6zm4.5-2a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                        </a>
                        
                   
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="py-6 border-t border-yellow-400/20 text-center">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-gray-300">
                        © 2025 <span class="text-yellow-400 font-semibold">Zinou Shop</span> - Tous droits réservés
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Politique de confidentialité</a>
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Conditions d'utilisation</a>
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Cookies</a>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-yellow-400/10">
                    <p class="text-sm text-gray-400">
                        Développé avec ❤️ par <a href="#" class="text-yellow-400 hover:text-yellow-300 transition-colors duration-300 font-medium">ilyes_dev</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
</body>
</html>