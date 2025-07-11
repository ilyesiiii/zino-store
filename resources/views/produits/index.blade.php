<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>
             <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-white dark:bg-gray-950 text-gray-800 dark:text-gray-200">

@include('components.nav')

<!-- Message succès -->
@if (session('success'))
<div class="w-full flex justify-center mt-4 px-4">
    <div class="bg-green-100 border border-green-400 text-green-800 px-6 py-4 rounded-lg shadow-md w-full max-w-xl">
        <div class="flex items-center space-x-2">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <strong class="font-semibold">Succès :</strong>
            <span>{{ session('success') }}</span>
        </div>
    </div>
</div>
@endif





@if (session('updated'))
<div class="w-full flex justify-center mt-4 px-4">
    <div class="bg-blue-100 border border-blue-400 text-blue-800 px-6 py-4 rounded-lg shadow-md w-full max-w-xl">
        <div class="flex items-center space-x-2">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <strong class="font-semibold">Succès :</strong>
            <span>{{ session('updated') }}</span>
        </div>
    </div>
</div>
@endif


@if (session('destroyed'))
<div class="w-full flex justify-center mt-4 px-4">
    <div class="bg-red-100 border border-red-400 text-red-800 px-6 py-4 rounded-lg shadow-md w-full max-w-xl">
        <div class="flex items-center space-x-2">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <strong class="font-semibold">Succès :</strong>
            <span>{{ session('destroyed') }}</span>
        </div>
    </div>
</div>
@endif

<!-- Barre de recherche -->
<form action="{{ route('produits.index') }}" method="GET" class="mt-6 flex justify-center px-4">
    <div class="flex w-full max-w-xl bg-white dark:bg-gray-800 border border-blue-400 dark:border-blue-600 rounded-lg shadow-sm">
        <input type="search" name="search" placeholder="Rechercher..." class="w-full px-4 py-2 text-gray-700 dark:text-gray-200 dark:bg-gray-800 placeholder-gray-400 rounded-l-lg focus:outline-none">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-r-lg font-medium transition">Chercher</button>
    </div>
</form>

<!-- Nombre de produits -->
@if($count !== null && $count != 0)
<div class="mt-6 flex justify-center px-4">
    <div class="bg-white dark:bg-gray-900 border border-yellow-400 rounded-lg px-6 py-3 shadow text-blue-800 dark:text-blue-300 font-semibold">
        Nombre de produits disponibles : <span class="text-blue-600 dark:text-blue-400">{{ $count }}</span>
    </div>
</div>
@endif

<!-- Produits -->
<div class="py-12 px-6 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($produits as $produit)
        <article class="bg-white dark:bg-gray-900 border border-yellow-400 rounded-xl shadow-md hover:shadow-lg transition overflow-hidden">
            <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" class="w-full h-56 object-cover">

            <div class="p-4">
                <h2 class="text-xl font-bold text-yellow-700 dark:text-yellow-300">{{ $produit->nom }}</h2>
                <p class="text-sm text-yellow-600 dark:text-yellow-400 mt-1 line-clamp-2">{{ $produit->description }}</p>
                <div class="mt-2 text-lg font-bold text-black dark:text-white">{{ number_format($produit->prix, 2) }} DA</div>
            </div>

            <div class="px-4 py-2 border-t border-yellow-300 text-sm text-gray-700 dark:text-gray-300 flex justify-between items-center">
                <span>Stock : {{ $produit->stock ?? 'N/A' }}</span>
                <a href="{{ route('produits.show', $produit->id) }}" class="text-blue-600 hover:text-blue-400">Voir plus</a>
            </div>

            @if(session('role') == 'admin')
            <div class="px-4 py-4 border-t border-yellow-300 flex flex-col sm:flex-row gap-2">
                <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?')"
                        class="w-full px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-md font-medium transition">
                        Supprimer
                    </button>
                </form>

                <form action="{{ route('produits.edit', $produit->id) }}" method="GET" class="w-full">
                    <button type="submit"
                        class="w-full px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md font-medium transition">
                        Modifier
                    </button>
                </form>
            </div>
            @endif
        </article>
        @endforeach
    </div>

    @if($produits->hasPages())
    <div class="mt-12 flex justify-center">
        {{ $produits->links() }}
    </div>
    @endif
</div>

@include('components.footer')

</body>
</html>
