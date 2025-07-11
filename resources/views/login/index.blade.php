<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
            <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .auth-container {
            min-height: calc(100vh - 4rem);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-black dark:to-gray-900 text-gray-800 dark:text-gray-100">

    @include('components.nav')

    <div class="flex items-center justify-center auth-container px-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-900 border border-yellow-400 dark:border-yellow-700 rounded-2xl shadow-xl p-8">
            <h2 class="text-3xl font-bold text-center text-yellow-600 dark:text-yellow-400 mb-6">Connexion</h2>

            @if(session('success'))
            <div class="mb-6 flex items-center gap-3 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3 text-sm shadow-md">
                <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if(session('errorsLogin'))
            <div class="mb-6 flex items-center gap-3 rounded-lg bg-red-100 border border-red-400 text-red-700 px-4 py-3 text-sm shadow-md">
                <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <span>{{ session('errorsLogin') }}</span>
            </div>
            @endif

            <form method="POST" action="{{ route('login.authenticate') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Adresse e-mail</label>
                    <input id="email" type="email" name="email" required autofocus
                        class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    @error('email')
                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium mb-1">Mot de passe</label>
                    <input id="password" type="password" name="password" required
                        class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    @error('password')
                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bouton -->
                <div>
                    <button type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-lg transition duration-200 font-semibold shadow">
                        Se connecter
                    </button>
                </div>
            </form>

            <!-- Lien vers inscription -->
            <div class="mt-6 text-center text-sm">
                Pas encore de compte ?
                <a href="{{ route('login.create') }}" class="text-yellow-600 dark:text-yellow-400 hover:underline font-medium">S'inscrire</a>
            </div>
        </div>
    </div>

</body>
</html>
