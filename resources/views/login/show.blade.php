<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Tableau de bord</title>
           <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-900">
    @include('components.nav')

    <div class="max-w-7xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold text-blue-700 mb-10 text-center">Tableau de Bord Administrateur</h1>

        <!-- Cartes Statistiques -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white border-l-4 border-blue-500 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-600">Total Produits</h2>
                <p class="text-3xl text-blue-600 font-bold mt-2">{{ $count1 }}</p>
            </div>

            <div class="bg-white border-l-4 border-green-500 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-600">Total Commandes</h2>
                <p class="text-3xl text-green-600 font-bold mt-2">{{ $count2 }}</p>
            </div>

            <div class="bg-white border-l-4 border-yellow-500 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-600">Total Utilisateurs</h2>
                <p class="text-3xl text-yellow-500 font-bold mt-2">{{ $users->count() }}</p>
            </div>
        </div>

        <!-- Table des utilisateurs -->
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Nom</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Rôle</th>
                        <th class="px-4 py-3 text-left">Inscription</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($users as $user)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $user->id }}</td>
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3 capitalize">{{ $user->role ?? 'utilisateur' }}</td>
                            <td class="px-4 py-3">{{ $user->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">Aucun utilisateur trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('components.footer')
</body>
</html>
