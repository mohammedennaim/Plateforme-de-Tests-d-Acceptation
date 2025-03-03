<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
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
                                        {{ $isCorrect ? 'Correct' : 'Incorrect' }}
                                    </span>
                                </div>
                                
                                <div class="mt-4 space-y-2">
                                    @foreach ($question->options as $option)
                                        <div class="p-3 rounded-lg flex items-center {{ 
                                            $option->is_correct ? 'bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800' : 
                                            ($selectedOption && $selectedOption->id == $option->id ? 'bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800' : 
                                            'bg-gray-50 dark:bg-gray-600 border border-gray-200 dark:border-gray-500') 
                                        }}">
                                            <div class="flex-shrink-0 h-4 w-4 mr-2">
                                                @if ($selectedOption && $selectedOption->id == $option->id)
                                                    <svg class="{{ $option->is_correct ? 'text-green-500' : 'text-red-500' }}" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                    </svg>
                                                @elseif ($option->is_correct)
                                                    <svg class="text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
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
                                        {{ $isCorrect ? 'Correct' : 'Incorrect' }}
                                    </span>
                                </div>
                                
                                <div class="mt-4 space-y-2">
                                    @foreach ($question->options as $option)
                                        <div class="p-3 rounded-lg flex items-center {{ 
                                            $option->is_correct ? 'bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800' : 
                                            ($selectedOption && $selectedOption->id == $option->id ? 'bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800' : 
                                            'bg-gray-50 dark:bg-gray-600 border border-gray-200 dark:border-gray-500') 
                                        }}">
                                            <div class="flex-shrink-0 h-4 w-4 mr-2">
                                                @if ($selectedOption && $selectedOption->id == $option->id)
                                                    <svg class="{{ $option->is_correct ? 'text-green-500' : 'text-red-500' }}" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                    </svg>
                                                @elseif ($option->is_correct)
                                                    <svg class="text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1