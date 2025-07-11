<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle Commande</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen">

    @include('components.nav')

    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white dark:bg-black rounded-2xl shadow-lg border border-yellow-500">
        <h1 class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 text-center mb-8">Créer une commande</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 dark:bg-red-900 dark:border-red-600 dark:text-red-200">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST" class="grid grid-cols-1 gap-6" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="nom" class="font-semibold">Nom</label>
                    <input type="text" name="nom" id="nom" required class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                </div>
                <div>
                    <label for="prenom" class="font-semibold">Prénom</label>
                    <input type="text" name="prenom" id="prenom" required class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                </div>
            </div>

            <div>
                <label for="phone" class="font-semibold">Téléphone</label>
                <input type="number" name="phone" id="phone" required class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="wilaya" class="font-semibold">Wilaya</label>
                    <select name="wilaya" id="wilaya" required class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                        <option value="">-- Choisir une wilaya --</option>
                        @foreach($wilayas as $wilaya)
                            <option value="{{ $wilaya->name }}" data-wilaya-id="{{ $wilaya->id }}">{{ $wilaya->name }}</option>
                        @endforeach
                    </select>
                </div>

                 

                <div>
                    <label for="commune" class="font-semibold">Commune</label>
                    <select name="ville" id="commune" required class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                        <option value="">-- Choisir une commune --</option>
                        @foreach($communes as $commune)
                            <option value="{{ $commune->name }}" data-wilaya-id="{{ $commune->wilaya_id }}" style="display:none;">
                                {{ $commune->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                   <div>
             <label for="methode_livraison" class="font-semibold">Méthode de Livraison</label>
             <select name="methode_livraison" id="methode_livraison" required class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                        <option value="">-- Choisir une methode de livraison --</option>
                        <option value="domicile">Domicile</option>
                        <option value="bureau">Bureau</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="adresse" class="font-semibold">Adresse complète</label>
                <textarea name="adresse" id="adresse" rows="3" required class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition resize-none"></textarea>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="font-semibold">Quantité</label>
                    <input type="number" name="quantite" id="quantite" value="{{ $product->pivot->quantite ?? 1 }}" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition;">
                </div>
                <div>
                    <label class="font-semibold">Prix (DA)</label>
                    <input readonly type="number" name="prix" id="prix" value="{{ $product->prix }}" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition; bg-gray-100 dark:bg-gray-800">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="font-semibold">Frais de livraison (DA)</label>
                    <input readonly type="number" name="livraison" id="livraison" value="0" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition bg-gray-100 dark:bg-gray-800">
                </div>
                <div>
                    <label class="font-semibold">Total (DA)</label>
                    <input readonly type="number" name="total" id="total" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition bg-gray-100 dark:bg-gray-800">
                </div>
            </div>

            @if(session('role') === 'admin')
            <div>
                <label for="status" class="font-semibold">Status</label>
                <select name="status" id="status" class=" w-full px-4 py-2 rounded-lg border border-yellow-400 dark:border-yellow-600 
               focus:outline-none focus:ring-2 focus:ring-yellow-500
               dark:bg-gray-800 dark:text-white bg-white text-gray-800 transition">
                    <option value="en attente">En attente</option>
                    <option value="expédiée">Expédiée</option>
                    <option value="livrée">Livrée</option>
                    <option value="annulée">Annulée</option>
                </select>
            </div>
            @endif

            <div class="text-center pt-4">
                <button type="submit" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-lg shadow transition">
                    Créer la commande
                </button>
            </div>
        </form>
    </div>

    <style>
        .input-style {
            @apply mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-800 dark:text-white;
        }
    </style>
<script>
    const tarifsLivraison = [
    { code: 1, domicile: 1450, bureau: 1070 },
    { code: 2, domicile: 850, bureau: 570 },
    { code: 3, domicile: 950, bureau: 670 },
    { code: 4, domicile: 800, bureau: 570 }, // Correction page 2
    { code: 5, domicile: 900, bureau: 570 },
    { code: 6, domicile: 900, bureau: 570 }, // Correction page 2 (était 850)
    { code: 7, domicile: 950, bureau: 670 },
    { code: 8, domicile: 1200, bureau: 770 }, // Correction page 2 (bureau était 1070)
    { code: 9, domicile: 700, bureau: 520 },
    { code: 10, domicile: 750, bureau: 570 }, // Page 2: "BOURA" -> BOUIRA
    { code: 11, domicile: 1650, bureau: 1270 },
    { code: 12, domicile: 950, bureau: 570 }, // Correction page 2
    { code: 13, domicile: 900, bureau: 570 },
    { code: 14, domicile: 850, bureau: 520 }, // Correction page 2
    { code: 15, domicile: 750, bureau: 570 },
    { code: 16, domicile: 600, bureau: 520 }, // Correction page 2
    { code: 17, domicile: 950, bureau: 670 },
    { code: 18, domicile: 900, bureau: 570 },
    { code: 19, domicile: 850, bureau: 570 },
    { code: 20, domicile: 900, bureau: 620 }, // Correction page 2
    { code: 21, domicile: 900, bureau: 570 },
    { code: 22, domicile: 900, bureau: 570 },
    { code: 23, domicile: 900, bureau: 570 },
    { code: 24, domicile: 850, bureau: 570 },
    { code: 25, domicile: 850, bureau: 570 },
    { code: 26, domicile: 850, bureau: 570 },
    { code: 27, domicile: 900, bureau: 570 },
    { code: 28, domicile: 900, bureau: 570 },
    { code: 29, domicile: 900, bureau: 570 },
    { code: 30, domicile: 1000, bureau: 670 }, // "OUARGLA"
    { code: 31, domicile: 850, bureau: 570 },
    { code: 32, domicile: 1100, bureau: 670 },
    { code: 33, domicile: 0, bureau: 0 },
    { code: 34, domicile: 850, bureau: 570 },
    { code: 35, domicile: 500, bureau: 420 }, // BOUMERDES
    { code: 36, domicile: 900, bureau: 570 },
    { code: 37, domicile: 0, bureau: 0 },
    { code: 38, domicile: 900, bureau: 0 },
    { code: 39, domicile: 1000, bureau: 670 }, // Correction page 2
    { code: 40, domicile: 900, bureau: 0 },
    { code: 41, domicile: 900, bureau: 570 },
    { code: 42, domicile: 800, bureau: 570 }, // Page 2: 800 confirmé
    { code: 43, domicile: 900, bureau: 570 },
    { code: 44, domicile: 900, bureau: 570 },
    // Page 2 corrections
    { code: 45, domicile: 1200, bureau: 670 },
    { code: 46, domicile: 900, bureau: 570 },
    { code: 47, domicile: 950, bureau: 670 },
    { code: 48, domicile: 900, bureau: 570 },
    { code: 49, domicile: 1450, bureau: 0 },
    { code: 50, domicile: 0, bureau: 0 },
    { code: 51, domicile: 950, bureau: 670 },
    { code: 52, domicile: 1100, bureau: 1070 },
    { code: 53, domicile: 1650, bureau: 0 },
    { code: 54, domicile: 1650, bureau: 0 },
    { code: 55, domicile: 950, bureau: 670 },
    { code: 56, domicile: 0, bureau: 0 },
    { code: 57, domicile: 950, bureau: 0 },
    { code: 58, domicile: 1100, bureau: 0 },
    ];

    function updateLivraisonEtTotal() {
        const wilayaSelect = document.querySelector('#wilaya');
        const methode = document.querySelector('#methode_livraison').value;
        const quantite = parseFloat(document.querySelector('#quantite').value) || 1;
        const prix = parseFloat(document.querySelector('#prix').value) || 0;

        const livraisonInput = document.querySelector('#livraison');
        const totalInput = document.querySelector('#total');

        const wilayaCode = parseInt(wilayaSelect.options[wilayaSelect.selectedIndex]?.getAttribute('data-wilaya-id')) || 0;
        const tarif = tarifsLivraison.find(item => item.code === wilayaCode);

        let livraison = 0;
        if (tarif && methode) {
            livraison = parseFloat(tarif[methode]) || 0;
        }

        livraisonInput.value = livraison;
        totalInput.value = (quantite * prix + livraison).toFixed(2);
    }

    function filterCommunes() {
        const wilaya = document.querySelector('#wilaya');
        const commune = document.querySelector('#commune');

        wilaya.addEventListener('change', () => {
            const selectedWilayaId = wilaya.options[wilaya.selectedIndex].getAttribute('data-wilaya-id');

            commune.querySelectorAll('option').forEach(opt => {
                opt.style.display = (opt.value === '' || opt.getAttribute('data-wilaya-id') === selectedWilayaId) ? 'block' : 'none';
            });

            commune.value = '';
            updateLivraisonEtTotal();
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelector('#quantite').addEventListener('input', updateLivraisonEtTotal);
        document.querySelector('#methode_livraison').addEventListener('change', updateLivraisonEtTotal);
        document.querySelector('#wilaya').addEventListener('change', updateLivraisonEtTotal);
        updateLivraisonEtTotal();
        filterCommunes();
    });
</script>


    @include('components.footer')
</body>
</html>
