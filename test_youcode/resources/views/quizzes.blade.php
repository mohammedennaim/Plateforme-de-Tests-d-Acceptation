<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Technical Assessment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <!-- Quiz Info -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $quiz->title ?? 'YouCode Assessment' }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $quiz->description ?? 'Complete all questions to submit your assessment.' }}</p>
                    </div>
                    
                    <!-- Quiz Progress Bar -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Progress</span>
                            <span class="text-sm font-medium text-indigo-600 dark:text-indigo-400">{{ $questions->currentPage() }} of {{ $questions->lastPage() }}</span>
                        </div>
                        <div class="w-full h-3 bg-gray-200 rounded-full dark:bg-gray-700 overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full transition-all duration-500 ease-out" style="width: {{ ($questions->currentPage() / $questions->lastPage()) * 100 }}%"></div>
                        </div>
                    </div>

                    <!-- Timer Display -->
                    <div class="mb-6 bg-gray-100 dark:bg-gray-700 rounded-lg p-4 flex items-center justify-between" x-data="timer({{ $quiz->duration_minutes ?? 60 }})" x-init="startTimer">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Time Remaining:</span>
                        </div>
                        <span class="text-lg font-semibold text-indigo-600 dark:text-indigo-400" x-text="formatTime"></span>
                    </div>

                    <form method="POST" action="{{ route('quiz.store') }}" id="quizForm">
                        @csrf
                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                        <input type="hidden" name="current_page" value="{{ $questions->currentPage() }}">

                        @foreach($questions as $question)
                        <div class="mb-8 bg-white dark:bg-gray-700 rounded-xl shadow-md overflow-hidden border border-gray-200 dark:border-gray-600">
                            <div class="bg-gray-50 dark:bg-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white">
                                    Question {{ ($questions->currentPage() - 1) * $questions->perPage() + $loop->iteration }}
                                </h4>
                            </div>
                            
                            <div class="p-6">
                                <p class="text-base text-gray-800 dark:text-gray-200 mb-6">
                                    {{ $question->content }}
                                </p>
                                
                                <div class="space-y-3">
                                    @foreach($question->options as $option)
                                    <label for="q{{ $question->id }}_{{ $loop->iteration }}"
                                           class="flex items-center p-4 border rounded-lg cursor-pointer transition-all duration-200
                                           @if(old('answers.' . $question->id) == $option->id)
                                               bg-indigo-50 border-indigo-200 dark:bg-indigo-900/30 dark:border-indigo-700
                                           @else
                                               border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700
                                           @endif">
                                        <input type="radio" 
                                               id="q{{ $question->id }}_{{ $loop->iteration }}" 
                                               name="answers[{{ $question->id }}]" 
                                               value="{{ $option->id }}"
                                               class="h-5 w-5 text-indigo-600 border-gray-300 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                               {{ old("answers.{$question->id}") == $option->id ? 'checked' : '' }}
                                               required>
                                        <span class="ml-3 block text-gray-700 dark:text-gray-300">
                                            {{ $option->content }}
                                        </span>
                                    </label>
                                    @endforeach
                                </div>

                                @error("answers.{$question->id}")
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        @endforeach

                        <div class="mt-8 flex items-center justify-between">
                            @if($questions->currentPage() > 1)
                            <a href="{{ url('/quiz/start?page='.($questions->currentPage()-1)) }}"
                               class="inline-flex items-center px-5 py-2.5 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-150 shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Previous
                            </a>
                            @else
                            <div></div>
                            @endif

                            @if($questions->hasMorePages())
                            <button type="submit" 
                                    name="action" 
                                    value="next"
                                    class="inline-flex items-center px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150 shadow-md">
                                Next
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                            @else
                            <button type="submit" 
                                    name="action" 
                                    value="finish"
                                    class="inline-flex items-center px-5 py-2.5 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150 shadow-md">
                                Submit Quiz
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js Timer Script -->
    <script>
        function timer(minutes) {
            return {
                minutes: minutes,
                seconds: 0,
                formatTime: '',
                startTimer() {
                    // Load saved time from localStorage if it exists
                    const savedTime = localStorage.getItem('quizTimeRemaining');
                    if (savedTime) {
                        const timeData = JSON.parse(savedTime);
                        this.minutes = timeData.minutes;
                        this.seconds = timeData.seconds;
                    }
                    
                    this.formatTime = `${this.minutes}:${this.seconds.toString().padStart(2, '0')}`;
                    
                    setInterval(() => {
                        if (this.seconds > 0) {
                            this.seconds--;
                        } else if (this.minutes > 0) {
                            this.minutes--;
                            this.seconds = 59;
                        }
                        
                        this.formatTime = `${this.minutes}:${this.seconds.toString().padStart(2, '0')}`;
                        
                        // Save time to localStorage
                        localStorage.setItem('quizTimeRemaining', JSON.stringify({
                            minutes: this.minutes,
                            seconds: this.seconds
                        }));
                        
                        if (this.minutes === 0 && this.seconds === 0) {
                            localStorage.removeItem('quizTimeRemaining');
                            document.getElementById('quizForm').submit();
                        }
                    }, 1000);
                }
            }
        }
    </script>
</x-app-layout>