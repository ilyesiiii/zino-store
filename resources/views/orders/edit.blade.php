<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la Commande</title>
           <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .input-style {
        @apply w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;
    }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen">
    @include('components.nav')

    <div class="max-w-5xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mb-8 text-center">Modifier la Commande #{{ $order->id }}</h1>

        <form action="{{ route('orders.update', $order->id) }}" method="POST" class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 border border-yellow-500">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 dark:bg-red-900 dark:border-red-600 dark:text-red-200">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="hidden" name="id" value="{{ $order->id }}">
                <div>
                    <label class="font-semibold">Nom</label>
                    <input type="text" name="nom" value="{{ $order->nom }}" class="w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                </div>
                <div>
                    <label class="font-semibold">Prénom</label>
                    <input type="text" name="prenom" value="{{ $order->prenom }}" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                </div>
                <div>
                    <label class="font-semibold">Téléphone</label>
                    <input type="text" name="phone" value="0{{ $order->phone }}" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                </div>
            <div>
             <label for="methode_livraison" class="font-semibold">Méthode de Livraison</label>
             <select name="methode_livraison" id="methode_livraison" required class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                        <option value="{{ old('methode_livraison', $order->methode_livraison) }}">-- Choisir une methode de livraison --</option>
                        <option value="domicile" @selected(old('methode_livraison', $order->methode_livraison) == 'domicile')>Domicile</option>
                        <option value="bureau" @selected(old('methode_livraison', $order->methode_livraison) == 'bureau')>Bureau</option>
                    </select>
                </div>
            </div>
                <div>
                    <label class="font-semibold">Wilaya</label>
                    <select name="wilaya" id="wilaya" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                        <option value="">-- Choisir une wilaya --</option>
                        @foreach($wilayas as $wilaya)
                            <option value="{{ $wilaya->name }}" @selected($order->wilaya == $wilaya->name)>
                                {{ $wilaya->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="font-semibold">Commune</label>
                    <select name="ville" id="commune" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                        <option value="">-- Choisir une commune --</option>
                        @foreach($communes as $commune)
                            <option value="{{ $commune->name }}" @selected($order->ville == $commune->name)>
                                {{ $commune->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="font-semibold">Adresse</label>
                    <input type="text" name="adresse" value="{{ $order->adresse }}" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                </div>
                <div>
                    <label class="font-semibold">Statut</label>
                    <select name="status" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                        <option value="en attente" @selected($order->status == 'en attente')>En attente</option>
                        <option value="expédiée" @selected($order->status == 'expédiée')>Expédiée</option>
                        <option value="livrée" @selected($order->status == 'livrée')>Livrée</option>
                        <option value="annulée" @selected($order->status == 'annulée')>Annulée</option>
                    </select>
                </div>

                <div>
                    <label class="font-semibold">Quantité</label>
                    <input type="number" name="quantite" id="quantite" value="{{ $product->pivot->quantite}}" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                </div>

                <div>
                    <label class="font-semibold">Produit</label>
                    <select name="product_id" id="product_id" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                        <option value="">-- Sélectionner un produit --</option>
                        @foreach ($products as $pr)
                            <option value="{{ $pr->id }}" data-price="{{ $pr->prix }}" {{ old('product_id') == $pr->id ? 'selected' : '' }}>
                                {{ $pr->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="font-semibold">Livraison</label>
                    <input readonly type="number" name="Livraison" id="Livraison" value="10" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition; bg-gray-100 dark:bg-gray-700">
                </div>
                <div>
                    <label class="font-semibold">Total</label>
                    <input readonly type="number" id="total" name="total" value="{{ $order->total }}" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition; bg-gray-100 dark:bg-gray-700">
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-xl font-bold mb-4 text-yellow-500">Produits commandés (non modifiables ici)</h2>
                <table class="w-full text-sm border border-yellow-500">
                    <thead>
                        <tr class="bg-yellow-100 dark:bg-yellow-800 text-black dark:text-white">
                            <th class="border border-yellow-500 px-4 py-2">Nom</th>
                            <th class="border border-yellow-500 px-4 py-2">Quantité</th>
                            <th class="border border-yellow-500 px-4 py-2">Prix unitaire</th>
                            <th class="border border-yellow-500 px-4 py-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->produits as $produit)
                            <tr class="bg-white dark:bg-gray-800">
                                <td class="border border-yellow-500 px-4 py-2">{{ $produit->nom }}</td>
                                <td class="border border-yellow-500 px-4 py-2">{{ $produit->pivot->quantite }}</td>
                                <td class="border border-yellow-500 px-4 py-2">{{ number_format($produit->prix, 2) }} DA</td>
                                <td class="border border-yellow-500 px-4 py-2">
                                    {{ number_format($produit->pivot->quantite * $produit->prix, 2) }} DA
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">* Pour modifier les produits, utilisez une autre interface.</p>
            </div>

            <div class="mt-6 flex gap-4">
                <a href="{{ route('orders.index') }}" class="inline-block px-5 py-2.5 bg-gray-500 hover:bg-gray-600 text-white rounded transition">
                    Annuler
                </a>
                <button type="submit" class="px-5 py-2.5 bg-yellow-600 hover:bg-yellow-700 text-white rounded transition">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>

    @include('components.footer')

    <script>
        function tryCalcul() {
            let select = document.querySelector('#product_id');
            let quantite = parseFloat(document.querySelector('#quantite').value || 0);
            let livraison = parseFloat(document.querySelector('#Livraison').value || 0);
            let total = document.querySelector('#total');

            let prix = 0;
            if (select && select.options[select.selectedIndex]) {
                prix = parseFloat(select.options[select.selectedIndex].dataset.price || 0);
            }

            total.value = (quantite * prix + livraison).toFixed(2);
        }

        document.querySelector('#product_id')?.addEventListener('change', tryCalcul);
        document.querySelector('#quantite')?.addEventListener('input', tryCalcul);
        document.addEventListener('DOMContentLoaded', tryCalcul);
    </script>
</body>
</html>
