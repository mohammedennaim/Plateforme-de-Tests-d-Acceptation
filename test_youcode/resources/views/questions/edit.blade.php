<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifier la question
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <a href="{{ route('quizzes.questions.index', $question->quiz_id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                            &larr; Retour à la liste des questions
                        </a>
                    </div>

                    <form action="{{ route('questions.update', $question->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Question</label>
                            <textarea name="content" id="content" rows="3" required
                                      class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                      placeholder="Entrez la question ici...">{{ old('content', $question->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Options</label>
                            <div id="options-container" class="space-y-4">
                                @foreach($question->options as $index => $option)
                                    <div class="flex items-center">
                                        <input type="radio" name="correct_option" id="correct_option_{{ $index }}" value="{{ $index }}" 
                                               class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                               {{ old('correct_option', ($option->is_correct ? $index : null)) == $index ? 'checked' : '' }}>
                                        <label for="correct_option_{{ $index }}" class="ml-2 mr-4 text-sm text-gray-700 dark:text-gray-300">Correcte</label>
                                        
                                        <input type="hidden" name="options[{{ $index }}][id]" value="{{ $option->id }}">
                                        <input type="text" name="options[{{ $index }}][content]" 
                                               class="flex-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                               placeholder="Option {{ $index + 1 }}" 
                                               value="{{ old("options.$index.content", $option->content) }}" required>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Mettre à jour la question
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>