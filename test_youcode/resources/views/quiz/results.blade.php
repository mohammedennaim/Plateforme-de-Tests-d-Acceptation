<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Quiz Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('welcome') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 dark:text-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                        Back to Home
                    </a>
                    <div class="mb-8 mt-8 bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $attempt->quiz->title }}
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">{{ $attempt->quiz->description }}</p>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
                            <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Your Score</p>
                                <p
                                    class="text-3xl font-bold {{ $attempt->passed ? 'text-green-500' : 'text-red-500' }}">
                                    {{ number_format($attempt->score, 1) }}%
                                </p>
                            </div>

                            <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                                <p
                                    class="text-xl font-semibold {{ $attempt->passed ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $attempt->passed ? 'PASSED' : 'FAILED' }}
                                </p>
                            </div>

                            <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Passing Score</p>
                                <p class="text-xl font-semibold text-gray-700 dark:text-gray-300">
                                    {{ $attempt->quiz->passing_score }}%
                                </p>
                            </div>

                            <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Completed On</p>
                                <p class="text-xl font-semibold text-gray-700 dark:text-gray-300">
                                    {{ $attempt->completed_at->format('M j, Y g:i A') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Answer Review</h3>

                    <div class="space-y-8">
                        @php
                            $userAnswers = json_decode($attempt->answers, true);
                        @endphp

                        @foreach ($attempt->quiz->questions as $question)
                                                @php
                                                    $userAnswerId = $userAnswers[$question->id] ?? null;
                                                    $correctOption = $question->options->firstWhere('is_correct', true);
                                                    $isCorrect = $userAnswerId && $correctOption && $userAnswerId == $correctOption->id;
                                                @endphp

                                                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                                                    <div class="flex justify-between items-start mb-4">
                                                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">
                                                            {{ $loop->iteration }}. {{ $question->content }}
                                                        </h4>
                                                        <span
                                                            class="px-2 py-1 text-xs font-semibold rounded {{ $isCorrect ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                            {{ $isCorrect ? 'Correct' : 'Incorrect' }}
                                                        </span>
                                                    </div>

                                                    <div class="space-y-3">
                                                        @foreach ($question->options as $option)
                                                                                <div class="flex items-center p-3 rounded-lg {{
                                                            $option->is_correct
                                                            ? 'bg-green-50 border border-green-200 dark:bg-green-900/20 dark:border-green-800'
                                                            : ((!$option->is_correct && $userAnswerId == $option->id)
                                                                ? 'bg-red-50 border border-red-200 dark:bg-red-900/20 dark:border-red-800'
                                                                : 'bg-gray-50 border border-gray-200 dark:bg-gray-600 dark:border-gray-500'
                                                            )
                                                                                                                }}">
                                                                                    <div class="mr-3">
                                                                                        @if ($option->is_correct)
                                                                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                                                                                viewBox="0 0 24 24">
                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                                    d="M5 13l4 4L19 7"></path>
                                                                                            </svg>
                                                                                        @elseif ($userAnswerId == $option->id)
                                                                                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                                                                                viewBox="0 0 24 24">
                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                                    d="M6 18L18 6M6 6l12 12"></path>
                                                                                            </svg>
                                                                                        @endif
                                                                                    </div>
                                                                                    <span class="text-gray-700 dark:text-gray-300">{{ $option->content }}</span>

                                                                                    @if ($userAnswerId == $option->id)
                                                                                        <span class="ml-auto text-sm text-gray-500 dark:text-gray-400">Your answer</span>
                                                                                    @endif
                                                                                </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>