<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Détails de la tentative
            </h2>
            <a href="{{ route('quiz.results', $attempt->quiz) }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                Retour aux Résultats
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Informations générales -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Informations utilisateur</h3>
                            <div class="mt-4 space-y-2">
                                <div class="flex">
                                    <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Nom:</span>
                                    <span class="text-gray-900 dark:text-white">{{ $attempt->user->name }}</span>
                                </div>
                                <div class="flex">
                                    <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Email:</span>
                                    <span class="text-gray-900 dark:text-white">{{ $attempt->user->email }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Informations quiz</h3>
                            <div class="mt-4 space-y-2">
                                <div class="flex">
                                    <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Quiz:</span>
                                    <span class="text-gray-900 dark:text-white">{{ $attempt->quiz->title }}</span>
                                </div>
                                <div class="flex">
                                    <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Date:</span>
                                    <span class="text-gray-900 dark:text-white">{{ $attempt->completed_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex">
                                    <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Score:</span>
                                    <span class="text-gray-900 dark:text-white">{{ number_format($attempt->score, 1) }}%</span>
                                </div>
                                <div class="flex">
                                    <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Statut:</span>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $attempt->passed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $attempt->passed ? 'Réussi' : 'Échoué' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Réponses aux questions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-6">Réponses</h3>
                    
                    <div class="space-y-8">
                        @php
                            $answers = json_decode($attempt->answers, true);
                        @endphp
                        
                        @foreach ($attempt->quiz->questions as $question)
                            @php
                                $selectedOptionId = $answers[$question->id] ?? null;
                                $selectedOption = $selectedOptionId ? App\Models\Option::find($selectedOptionId) : null;
                                $correctOption = $question->options->where('is_correct', true)->first();
                                $isCorrect = $selectedOption && $selectedOption->is_correct;
                            @endphp
                            
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                                <div class="flex justify-between items-start mb-3">
                                    <h4 class="text-md font-medium text-gray-900 dark:text-white">
                                        {{ $loop->iteration }}. {{ $question->content }}
                                    </h4>
                                    <span class="px-3 py-1 text-xs rounded-full {{ $isCorrect ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                        {{ $isCorrect ? '<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Détails de la tentative
            </h2>
            <a href="{{ route('quiz.results', $attempt->quiz) }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                Retour aux Résultats
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Informations générales -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Informations utilisateur</h3>
                            <div class="mt-4 space-y-2">
                                <div class="flex">
                                    <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Nom:</span>
                                    <span class="text-gray-900 dark:text-white">{{ $attempt->user->name }}</span>
                                </div>
                                <div class="flex">
                                    <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Email:</span>
                                    <span class="text-gray-900 dark:text-white">{{ $attempt->user->email }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Informations quiz</h3>
                            <div class="mt-4 space-y-2">
                                <div class="flex">
                                    <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Quiz:</span>
                                    <span class="text-gray-900 dark:text-white">{{ $attempt->quiz->title }}</span>
                                </div>
                                <div class="flex">
                                    <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Date:</span>
                                    <span class="text-gray-900 dark:text-white">{{ $attempt->completed_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex">
                                    <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Score:</span>
                                    <span class="text-gray-900 dark:text-white">{{ number_format($attempt->score, 1) }}%</span>
                                </div>
                                <div class="flex">
                                    <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Statut:</span>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $attempt->passed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $attempt->passed ? 'Réussi' : 'Échoué' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Réponses aux questions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-6">Réponses</h3>
                    
                    <div class="space-y-8">
                        @php
                            $answers = json_decode($attempt->answers, true);
                        @endphp
                        
                        @foreach ($attempt->quiz->questions as $question)
                            @php
                                $selectedOptionId = $answers[$question->id] ?? null;
                                $selectedOption = $selectedOptionId ? App\Models\Option::find($selectedOptionId) : null;
                                $correctOption = $question->options->where('is_correct', true)->first();
                                $isCorrect = $selectedOption && $selectedOption->is_correct;
                            @endphp
                            
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                                <div class="flex justify-between items-start mb-3">
                                    <h4 class="text-md font-medium text-gray-900 dark:text-white">
                                        {{ $loop->iteration }}. {{ $question->content }}
                                    </h4>
                                    <span class="px-3 py-1 text-xs rounded-full {{ $isCorrect ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                        {{ $isCorrect ? '