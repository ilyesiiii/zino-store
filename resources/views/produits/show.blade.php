<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nom }}</title>
            <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-white text-black dark:bg-black dark:text-yellow-200">

    @include('components.nav')

    <main class="py-12 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-black border border-yellow-400 dark:border-yellow-500 rounded-2xl shadow-xl overflow-hidden md:flex">

                <!-- Image -->
                <div class="md:w-1/2">
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="Image de {{ $product->nom }}"
                         class="w-full h-80 object-cover md:h-full" />
                </div>

                <!-- Infos Produit -->
                <div class="p-8 flex flex-col justify-between md:w-1/2">
                    <div>
                        <h1 class="text-3xl font-bold text-yellow-700 dark:text-yellow-300 mb-3">{{ $product->nom }}</h1>

                        <p class="text-xl font-semibold text-yellow-600 mb-4">
                            {{ number_format($product->prix, 2) }} DA
                        </p>

                        <p class="text-gray-600 dark:text-yellow-200 text-sm leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </div>
                    @if ($count != 0)
    <!-- Bouton Commander -->
    <form action="{{ route('orders.create') }}" method="GET" class="mt-8 w-full sm:w-auto">
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <button type="submit"
            class="flex items-center justify-center gap-2 w-full sm:w-auto px-6 py-2.5 bg-yellow-600 text-white text-sm font-semibold rounded-2xl shadow-lg hover:bg-yellow-700 hover:scale-105 active:scale-95 transition duration-200 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Commander
        </button>
    </form>
@else
    <!-- Message de non disponibilité -->
    <div class="mt-8 px-4 py-3 bg-red-100 text-red-800 rounded-xl border border-red-400 dark:bg-red-900 dark:text-red-200 dark:border-red-600 shadow-sm">
        Ce produit n’est pas disponible actuellement.
    </div>
@endif

         

                </div>
            </div>
        </div>
    </main>

    @include('components.footer')

</body>
</html>
