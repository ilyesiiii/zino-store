<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le produit</title>
          <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    @include('components.nav')

    <div class="flex items-center justify-center py-12 px-4">
        <div class="mx-auto w-full max-w-[550px] bg-white rounded-2xl shadow-xl p-8">

            <h1 class="text-2xl font-bold text-center text-blue-600 mb-8">Modifier le produit</h1>

            <!-- Message d'erreur -->
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow">
                    <p class="font-bold mb-2">Erreurs :</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                 <form method="POST" action="{{ route('produits.update',$product->id) }}" enctype="multipart/form-data">

                @csrf
                @method('PUT')



                <!-- Nom -->
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nom du produit</label>
                    <input type="text" name="nom" value="{{ old('nom', $product->nom) }}" placeholder="Nom..."
                        class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-blue-500">
                </div>

                <!-- Prix -->
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Prix (DA)</label>
                    <input type="number" name="prix" value="{{ old('prix', $product->prix) }}" placeholder="Prix..."
                        class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-blue-500">
                </div>

                <!-- Taille -->
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Taille</label>
                    <input type="text" name="size" value="{{ old('size', $product->size) }}" placeholder="Taille..."
                        class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-blue-500">
                </div>

                <!-- Description -->
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="4" placeholder="Description..."
                        class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Stock -->
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Stock disponible</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" placeholder="Quantité en stock..."
                        class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-blue-500">
                </div>

                <!-- Image -->
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Image du produit</label>
                    <input type="file" name="image"
                        class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700" />
                    
                    @if ($product->image)
                        <div class="mt-4">
                            <p class="text-sm text-gray-500 mb-1">Image actuelle :</p>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Produit" class="h-40 w-full object-cover rounded-lg shadow-md">
                        </div>
                    @endif
                </div>

                <!-- Bouton -->
                <div>
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition font-semibold text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Mettre à jour le produit
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('components.footer')
</body>
</html>
