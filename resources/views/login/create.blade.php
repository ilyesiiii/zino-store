<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-black dark:to-gray-900 text-gray-800 dark:text-gray-100 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-xl bg-white dark:bg-gray-900 border border-yellow-400 dark:border-yellow-700 rounded-2xl shadow-lg p-8">
        <h1 class="text-3xl font-bold text-center text-yellow-600 dark:text-yellow-400 mb-6">Créer un profil utilisateur</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 p-4 rounded-lg border border-red-400 dark:border-red-600">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Nom complet -->
            <div>
                <label for="nom" class="block text-sm font-medium mb-1">Nom complet</label>
                <input type="text" name="nom" id="nom" required
                    class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block text-sm font-medium mb-1">Mot de passe</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <!-- Confirmation mot de passe -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium mb-1">Confirmation du mot de passe</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <!-- Bouton -->
            <div>
                <button type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-lg transition duration-200 font-semibold shadow">
                    Enregistrer le profil
                </button>
            </div>
        </form>
    </div>

</body>
</html>
