<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
           <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-between">
    @include('components.nav')

    <div class="flex-grow flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8">

            <h1 class="text-2xl font-bold text-center text-blue-600 mb-6">Ajouter un nouveau produit</h1>

            <!-- Messages d'erreur -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 p-4 mb-6 rounded-lg shadow">
                    <p class="font-bold mb-2">Erreurs :</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('produits.store') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- Nom -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom du produit</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Nom..."
                        class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-blue-500" />
                </div>

                <!-- Prix -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Prix (DA)</label>
                    <input type="number" name="prix" value="{{ old('prix') }}" placeholder="Prix..."
                        class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-blue-500" />
                </div>

                <!-- Taille -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Taille</label>
                    <input type="text" name="size" value="{{ old('size') }}" placeholder="Taille..."
                        class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-blue-500" />
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="3" placeholder="Description..."
                        class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-blue-500">{{ old('description') }}</textarea>
                </div>

                <!-- Stock -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock') }}" placeholder="Quantité en stock..."
                        class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-blue-500" />
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                    <input type="file" name="image" accept="image/*" onchange="previewImage(event)"
                        class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700" />
                    
                    <div class="mt-4">
                        <img id="image-preview" class="hidden w-full h-64 object-cover rounded-lg shadow" />
                    </div>
                </div>

                <!-- Bouton -->
                <div>
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Ajouter le produit
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('components.footer')

    <!-- Aperçu de l'image JS -->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imgPreview = document.getElementById('image-preview');

            reader.onload = function () {
                imgPreview.src = reader.result;
                imgPreview.classList.remove('hidden');
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
