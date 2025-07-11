<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de la Commande #{{ $order->id }}</title>
            <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-black dark:text-yellow-100">

@include('components.nav')

<div class="max-w-5xl mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold text-yellow-500 mb-8">🧾 Détail de la commande #{{ $order->id }}</h1>

    <!-- Section client + commande -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <!-- Client -->
        <div class="bg-white dark:bg-gray-900 border border-yellow-400 rounded-lg p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-yellow-500 mb-4">👤 Informations Client</h2>
            <p><span class="font-semibold">Nom :</span> {{ $order->nom }}</p>
            <p><span class="font-semibold">Prénom :</span> {{ $order->prenom }}</p>
            <p><span class="font-semibold">Téléphone :</span> 0{{ $order->phone }}</p>
            <p><span class="font-semibold">Adresse :</span><br>
                {{ $order->adresse }}<br>
                {{ $order->ville ?? 'Commune inconnue' }}, {{ $order->wilaya ?? 'Wilaya inconnue' }}
            </p>
            <p><span class="font-semibold">Méthode de Livraison :</span> {{ $order->methode_livraison  }}</p>
        </div>

        <!-- Commande -->
        <div class="bg-white dark:bg-gray-900 border border-yellow-400 rounded-lg p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-yellow-500 mb-4">📋 Détails de la Commande</h2>
            <p><span class="font-semibold">Date :</span> {{ $order->created_at->format('d/m/Y à H:i') }}</p>
            <p><span class="font-semibold">Total :</span> <span class="text-green-600 font-bold">{{ number_format($order->total, 0, ',', ' ') }} DA</span></p>
            <p>
                <span class="font-semibold">Statut :</span>
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold
                    @if($order->status == 'en attente') bg-yellow-100 text-yellow-800
                    @elseif($order->status == 'expédiée') bg-blue-100 text-blue-800
                    @elseif($order->status == 'livrée') bg-green-100 text-green-800
                    @elseif($order->status == 'annulée') bg-red-100 text-red-800
                    @endif">
                    @if($order->status == 'en attente') ⏳
                    @elseif($order->status == 'expédiée') 🚚
                    @elseif($order->status == 'livrée') ✅
                    @elseif($order->status == 'annulée') ❌
                    @endif
                    {{ ucfirst($order->status) }}
                </span>
            </p>
        </div>
    </div>

    <!-- Produits -->
    <div class="bg-white dark:bg-gray-900 border border-yellow-400 rounded-lg p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-yellow-500 mb-6">🛒 Produits commandés</h2>

        <table class="w-full text-sm border border-yellow-500 rounded overflow-hidden">
            <thead>
                <tr class="bg-yellow-500 text-black dark:text-white uppercase text-xs">
                    <th class="px-4 py-2 text-left">Produit</th>
                    <th class="px-4 py-2 text-left">Quantité</th>
                    <th class="px-4 py-2 text-left">Prix unitaire</th>
                    <th class="px-4 py-2 text-left">Sous-total</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800">
                @foreach ($order->produits as $produit)
                    <tr class="border-t border-yellow-300">
                        <td class="px-4 py-2">{{ $produit->nom }}</td>
                        <td class="px-4 py-2">{{ $produit->pivot->quantite }}</td>
                        <td class="px-4 py-2">{{ number_format($produit->prix, 2) }} DA</td>
                        <td class="px-4 py-2 font-semibold">
                            {{ number_format($produit->pivot->quantite * $produit->prix, 2) }} DA
                        </td>
                        


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Retour -->
    <div class="mt-8 text-center">
        <a href="{{ route('orders.index') }}"
           class="inline-block px-6 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg shadow">
            ⬅️ Retour à la liste des commandes
        </a>
    </div>
</div>

@include('components.footer')
</body>
</html>
