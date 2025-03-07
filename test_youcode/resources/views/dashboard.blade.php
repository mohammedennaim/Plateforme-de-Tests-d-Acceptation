<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestion des Quiz') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                        <!-- Total Students Card -->
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-5 border-l-4 border-blue-500">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Étudiants</p>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">
                                        {{ $stats['totalStudents'] ?? 0 }}</p>
                                </div>
                                <div
                                    class="bg-blue-100 dark:bg-blue-900 rounded-full p-2 h-10 w-10 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Completed Quizzes Card -->
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-5 border-l-4 border-green-500">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Quiz Complétés</p>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">
                                        {{ $stats['completedQuizzes'] ?? 0 }}</p>
                                </div>
                                <div
                                    class="bg-green-100 dark:bg-green-900 rounded-full p-2 h-10 w-10 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Total Quizzes Card -->
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-5 border-l-4 border-purple-500">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Quiz</p>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">
                                        {{ $stats['totalQuizzes'] ?? 0 }}</p>
                                </div>
                                <div
                                    class="bg-purple-100 dark:bg-purple-900 rounded-full p-2 h-10 w-10 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-purple-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Active Staff Card -->
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-5 border-l-4 border-yellow-500">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Staff Actif</p>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">
                                        {{ $stats['activeStaff'] ?? 0 }}</p>
                                </div>
                                <div
                                    class="bg-yellow-100 dark:bg-yellow-900 rounded-full p-2 h-10 w-10 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-yellow-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton pour créer un nouveau quiz -->
                    <div class="mb-6 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Liste des Quiz</h3>
                        <button onclick="openQuizModal()"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Nouveau Quiz
                        </button>
                    </div>

                    <!-- Liste des quiz -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Titre</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Description</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Durée (min)</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Note de passage</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Tentatives</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Moyenne</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @forelse($quizzes as $quiz)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $quiz->title }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-xs">
                                                {{ $quiz->description }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $quiz->duration_minutes }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $quiz->passing_score }}%</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $quiz->attempts_count }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ number_format($quiz->attempts_avg_score, 1) }}%</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href=""
                                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600"
                                                    title="Gérer les questions">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <button onclick="editQuiz({{ $quiz->id }})"
                                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-600"
                                                    title="Modifier">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <button onclick="confirmDelete({{ $quiz->id }})"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600"
                                                    title="Supprimer">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            Aucun quiz trouvé. Créez votre premier quiz !
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour ajouter/modifier un quiz -->
    <!-- Quiz Create/Edit Modal -->
<div id="quizModal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 id="modalTitle" class="text-xl font-bold">Créer un Quiz</h2>
            <button onclick="closeQuizModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="quizForm" action="{{ route('quizzes.store') }}" method="POST">
            @csrf
            <input type="hidden" id="quiz_id" name="quiz_id">
            
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                <input type="text" id="title" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            </div>
            
            <div class="mb-4">
                <label for="duration_minutes" class="block text-sm font-medium text-gray-700">Durée (minutes)</label>
                <input type="number" id="duration_minutes" name="duration_minutes" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            
            <div class="mb-4">
                <label for="passing_score" class="block text-sm font-medium text-gray-700">Score de réussite (%)</label>
                <input type="number" id="passing_score" name="passing_score" min="0" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeQuizModal()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Annuler
                </button>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Confirmer la suppression</h2>
            <button onclick="closeDeleteModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <p class="mb-4">Êtes-vous sûr de vouloir supprimer ce quiz ? Cette action est irréversible.</p>
        
        <form id="deleteForm" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeDeleteModal()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Annuler
                </button>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Supprimer
                </button>
            </div>
        </form>
    </div>
</div>

    <!-- Modal de confirmation de suppression -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Confirmer la suppression</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-gray-500 dark:text-gray-400">Êtes-vous sûr de vouloir supprimer ce quiz ? Cette
                        action est irréversible.</p>
                </div>
                <div class="flex justify-center mt-4 space-x-4">
                    <button onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Annuler
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openQuizModal() {
            document.getElementById('quizForm').reset();

            const methodField = document.querySelector('#quizForm input[name="_method"]');
            if (methodField) {
                methodField.remove();
            }

            document.getElementById('modalTitle').innerText = 'Créer un Quiz';
            document.getElementById('quizForm').action = "{{ route('quizzes.store') }}";
            document.getElementById('quiz_id').value = '';
            document.getElementById('quizModal').classList.remove('hidden');
        }

        function closeQuizModal() {
            document.getElementById('quizModal').classList.add('hidden');
        }

        function editQuiz(id) {
            fetch(`/quizzes/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('quiz_id').value = data.id;
                    document.getElementById('title').value = data.title;
                    document.getElementById('description').value = data.description;
                    document.getElementById('duration_minutes').value = data.duration_minutes; // Fixed field name
                    document.getElementById('passing_score').value = data.passing_score;

                    document.getElementById('modalTitle').innerText = 'Modifier le Quiz';
                    document.getElementById('quizForm').action = `/quizzes/${id}`;

                    const methodField = document.querySelector('#quizForm input[name="_method"]');
                    if (methodField) {
                        methodField.value = 'PUT';
                    } else {
                        const newMethodField = document.createElement('input');
                        newMethodField.setAttribute('type', 'hidden');
                        newMethodField.setAttribute('name', '_method');
                        newMethodField.setAttribute('value', 'PUT');
                        document.getElementById('quizForm').appendChild(newMethodField);
                    }

                    document.getElementById('quizModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching quiz data:', error);
                    alert('Erreur lors de la récupération des données du quiz');
                });
        }

        function confirmDelete(id) {
            document.getElementById('deleteForm').action = `/quizzes/${id}`;

            const methodField = document.querySelector('#deleteForm input[name="_method"]');
            if (methodField) {
                methodField.value = 'DELETE';
            } else {
                const newMethodField = document.createElement('input');
                newMethodField.setAttribute('type', 'hidden');
                newMethodField.setAttribute('name', '_method');
                newMethodField.setAttribute('value', 'DELETE');
                document.getElementById('deleteForm').appendChild(newMethodField);
            }

            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</x-app-layout>