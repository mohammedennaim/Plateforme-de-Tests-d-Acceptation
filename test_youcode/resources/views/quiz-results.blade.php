
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Questions pour: {{ $quiz->title }}
            </h2>
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                Retour aux Quiz
            </a>
        </div>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Statistiques générales -->
        <div class="mb-8 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-sm text-gray-500 dark:text-gray-400">Tentatives totales</div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $quiz->attempts->count() }}</div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-sm text-gray-500 dark:text-gray-400">Score moyen</div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ $quiz->attempts->avg('score') ? number_format($quiz->attempts->avg('score'), 1) : 0 }}%
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-sm text-gray-500 dark:text-gray-400">Taux de réussite</div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">
                    @php
                        $passCount = $quiz->attempts->where('passed', true)->count();
                        $totalCount = $quiz->attempts->count();
                        $passRate = $totalCount > 0 ? ($passCount / $totalCount * 100) : 0;
                    @endphp
                    {{ number_format($passRate, 1) }}%
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-sm text-gray-500 dark:text-gray-400">Score de passage</div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $quiz->passing_score }}%</div>
            </div>
        </div>
        
        <!-- Performance par question -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Performance par question</h3>
                
                <div class="space-y-4">
                    @foreach ($quiz->questions as $question)
                        @php
                            $totalAnswers = 0;
                            $correctAnswers = 0;
                            
                            foreach ($quiz->attempts as $attempt) {
                                $answers = json_decode($attempt->answers, true);
                                if (isset($answers[$question->id])) {
                                    $totalAnswers++;
                                    $option = App\Models\Option::find($answers[$question->id]);
                                    if ($option && $option->is_correct) {
                                        $correctAnswers++;
                                    }
                                }
                            }
                            
                            $correctRate = $totalAnswers > 0 ? ($correctAnswers / $totalAnswers * 100) : 0;
                        @endphp
                        
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="text-md font-medium text-gray-900 dark:text-white">
                                    {{ $loop->iteration }}. {{ $question->content }}
                                </h4>
                                <span class="px-2 py-1 text-xs rounded-full {{ $correctRate >= 50 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                    {{ number_format($correctRate, 1) }}% correctes
                                </span>
                            </div>
                            
                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-600">
                                <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $correctRate }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Liste des tentatives -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Tentatives récentes</h3>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Utilisateur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Réussite</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($quiz->attempts()->with('user')->latest()->take(20)->get() as $attempt)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $attempt->user->name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $attempt->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ number_format($attempt->score, 1) }}%</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $attempt->passed ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                        {{ $attempt->passed ? 'Réussi' : 'Échoué' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $attempt->completed_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('attempts.show', $attempt->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                        Détails
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>