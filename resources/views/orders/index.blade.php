<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📦 Commandes</title>
           <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 dark:bg-gray-950 text-gray-800 dark:text-gray-100 font-sans">

@include('components.nav')

<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-4xl font-bold text-yellow-500 mb-8 text-center tracking-tight">Liste des Commandes</h1>




    <!-- Search Bar -->
    <div class="flex justify-center mb-8">
        <form action="{{ route('orders.index') }}" method="GET" class="relative w-full max-w-md">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="🔍 Rechercher une commande avec le numero de telephone"
                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-yellow-400 shadow-sm bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 text-sm"
            >
            <span class="absolute left-3 top-3 text-yellow-500">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z"/>
                </svg>
            </span>
        </form>
    </div>

     @if (session('updated'))
<div class="w-full flex justify-center mt-4 px-4">
    <div class="bg-blue-100 border border-blue-400 text-blue-800 px-6 py-4 rounded-lg shadow-md w-full max-w-xl">
        <div class="flex items-center space-x-2">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <strong class="font-semibold">Succès : </strong>
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
            <strong class="font-semibold">Succès : </strong>
            <span>{{ session('destroyed') }}</span>
        </div>
    </div>
</div>
@endif

    <!-- Table -->
    <div class="overflow-x-auto shadow-lg border border-yellow-400 rounded-xl bg-white dark:bg-gray-900">
        <table class="min-w-full text-sm divide-y divide-yellow-300">
            <thead class="bg-yellow-500 text-black text-sm uppercase rounded-t-xl">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Produit(s)</th>
                    <th class="px-4 py-3 text-left">Client</th>
                    <th class="px-4 py-3 text-left">Téléphone</th>
                    <th class="px-4 py-3 text-left">Adresse</th>
                    <th class="px-4 py-3 text-left">Total</th>
                    <th class="px-4 py-3 text-left">Statut</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                @forelse($orders as $order)
                    <tr class="hover:bg-yellow-50 dark:hover:bg-gray-800 transition duration-150">
                        <td class="px-4 py-3 font-semibold">#{{ $order->id }}</td>
                        <td class="px-4 py-3 space-y-1">
                            @foreach($order->produits as $produit)
                                <div>- {{ $produit->nom }} (x{{ $produit->pivot->quantite }})</div>
                            @endforeach
                        </td>
                        <td class="px-4 py-3">{{ $order->nom }} {{ $order->prenom }}</td>
                        <td class="px-4 py-3">0{{ $order->phone }}</td>
                        <td class="px-4 py-3 text-sm">{{ $order->adresse }}, {{ $order->ville }}, {{ $order->wilaya }}</td>
                        <td class="px-4 py-3 font-bold text-green-600">{{ number_format($order->total, 0, ',', ' ') }} DA</td>
                        <td class="px-7 py-3">
    @php
        $statusColors = [
            'en attente' => 'bg-yellow-100 text-yellow-800',
            'expédiée'   => 'bg-purple-100 text-purple-800',
            'livrée'     => 'bg-emerald-100 text-emerald-800',
            'annulée'    => 'bg-rose-100 text-rose-800',
        ];
    @endphp

    <span class="px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap {{ $statusColors[trim($order->status)] ?? 'bg-gray-200 text-gray-800' }}">
        {{ ucfirst($order->status) }}
    </span>
</td>

                        <td class="px-4 py-3 text-xs">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 space-x-1 text-sm whitespace-nowrap">
                            <a href="{{ route('orders.show', $order->id) }}"
                               class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded shadow-sm">Voir</a>
                            <a href="{{ route('orders.edit', $order->id) }}"
                               class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded shadow-sm">Éditer</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Supprimer cette commande ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded shadow-sm">
                                    Suppr
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-6 text-center text-red-600 dark:text-red-400">
                            😕 Aucune commande trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if ($orders->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $orders->links('pagination::tailwind') }}
        </div>
    @endif
</div>

@include('components.footer')
</body>
</html>
