<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Question for: <span class="text-indigo-600 dark:text-indigo-400">{{ $quiz->title }}</span>
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('quiz.questions.update', [$quiz->id, $question->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Question</label>
                        <input type="text" name="content" id="content" value="{{ $question->content }}" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-300" />
                    </div>

                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Options</h3>
                    <div id="options" class="space-y-4">
                        @foreach($question->options as $index => $option)
                            <div class="flex items-center">
                                <input type="text" name="options[{{ $index }}]" value="{{ $option->content }}" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-300" />
                                <input type="radio" name="correct_option" value="{{ $index }}" {{ $option->is_correct ? 'checked' : '' }} class="ml-2" /> Correct
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <button type="button" id="add-option" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            Add Option
                        </button>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                            Update Question
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('add-option').addEventListener('click', function() {
            const optionsDiv = document.getElementById('options');
            const index = optionsDiv.children.length;
            const newOption = `
                <div class="flex items-center">
                    <input type="text" name="options[${index}]" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-300" placeholder="Option ${index + 1}" />
                    <input type="radio" name="correct_option" value="${index}" class="ml-2" /> Correct
                </div>
            `;
            optionsDiv.insertAdjacentHTML('beforeend', newOption);
        });
    </script>
</x-app-layout>