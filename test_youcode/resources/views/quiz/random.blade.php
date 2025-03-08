<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Random Quiz') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Ready for a random challenge?</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-8 max-w-md mx-auto">
                        We'll select a random quiz for you to test your knowledge. Good luck!
                    </p>
                    
                    <a href="{{ route('quiz.start') }}" 
                       class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-lg hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Start Random Quiz
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>