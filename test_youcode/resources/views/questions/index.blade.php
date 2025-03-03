<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Questions for: {{ $quiz->title }}
            </h2>
            <a href="{{ route('quiz.questions.create', $quiz->id) }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Question
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-800 mb-4 inline-block">
                        &larr; Back to Quizzes
                    </a>
                    
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="space-y-6">
                        @forelse ($questions as $question)
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
                                <div class="flex justify-between">
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                        {{ $loop->iteration }}. {{ $question->content }}
                                    </h3>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('quiz.questions.edit', [$quiz->id, $question->id]) }}" 
                                           class="text-blue-600 hover:text-blue-800">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('quiz.questions.destroy', [$quiz->id, $question->id]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" 
                                                    onclick="return confirm('Are you sure you want to delete this question?')">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="mt-4 space-y-2">
                                    @foreach ($question->options as $option)
                                        <div class="flex items-center p-3 {{ $option->is_correct ? 'bg-green-100 dark:bg-green-900' : 'bg-gray-100 dark:bg-gray-600' }} rounded-md">
                                            <span class="mr-3 h-5 w-5 flex items-center justify-center rounded-full {{ $option->is_correct ? 'bg-green-500' : 'bg-gray-400' }} text-white font-bold">
                                                {{ $loop->iteration }}
                                            </span>
                                            <span class="{{ $option->is_correct ? 'font-medium' : '' }} text-gray-800 dark:text-gray-200">
                                                {{ $option->content }}
                                            </span>
                                            @if ($option->is_correct)
                                                <span class="ml-auto text-sm text-green-700 dark:text-green-400 font-medium">Correct Answer</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-gray-500 dark:text-gray-400">No questions added yet.</p>
                                <p class="mt-2 text-gray-500 dark:text-gray-400">Click the "Add Question" button to create your first question.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>