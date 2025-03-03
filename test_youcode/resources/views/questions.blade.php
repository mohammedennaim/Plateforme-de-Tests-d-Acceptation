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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Bouton pour créer une nouvelle question -->
                    <div class="mb-6">
                        <button onclick="openQuestionModal()" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            + Nouvelle Question
                        </button>
                    </div>

                    <!-- Liste des questions -->
                    <div class="space-y-6">
                        @forelse ($questions as $question)
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="pr-4 flex-grow">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $loop->iteration }}. {{ $question->content }}</h3>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button onclick="openQuestionModal({{ $question->id }})" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                            Modifier
                                        </button>
                                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?')">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="mt-3 ml-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach ($question->options as $option)
                                        <div class="flex items-center p-3 rounded-lg border {{ $option->is_correct ? 'border-green-500 bg-green-50 dark:bg-green-900/20' : 'border-gray-200 dark:border-gray-600' }}">
                                            <span class="w-5 h-5 mr-2 flex items-center justify-center {{ $option->is_correct ? 'text-green-500' : 'text-gray-400' }}">
                                                @if ($option->is_correct)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                                    </svg>
                                                @endif
                                            </span>
                                            <span class="flex-grow text-sm {{ $option->is_correct ? 'font-medium text-gray-900 dark:text-gray-100' : 'text-gray-700 dark:text-gray-300' }}">
                                                {{ $option->content }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-gray-500 dark:text-gray-400">Aucune question ajoutée pour ce quiz.</p>
                                <p class="mt-2 text-sm text-gray-400 dark:text-gray-500">Cliquez sur "Nouvelle Question" pour commencer.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour créer/modifier une question -->
    <div id="questionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" x-data="questionForm()">
        <div class="relative top-20 mx-auto p-5 border max-w-2xl shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    <span id="modalTitle">Nouvelle Question</span>
                </h3>
                <form id="questionForm" method="POST" :action="formAction">
                    @csrf
                    <div id="methodField"></div>
                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contenu de la question</label>
                        <textarea name="content" id="questionContent" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600" required></textarea>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Options</h4>
                        </div>

                        <div id="optionsContainer" class="space-y-3">
                            <template x-for="(option, index) in options" :key="index">
                                <div class="flex items-start">
                                    <div class="flex-grow mr-2">
                                        <div class="flex items-center mb-1">
                                            <input type="radio" :name="'is_correct'" :id="'option_correct_'+index" :value="index" class="mr-2" x-model="correctOption">
                                            <label :for="'option_correct_'+index" class="text-sm text-gray-700 dark:text-gray-300">Correcte</label>
                                        </div>
                                        <textarea :name="'options['+index+'][content]'" rows="2" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600" x-model="option.content" required></textarea>
                                        <input type="hidden" :name="'options['+index+'][is_correct]'" :value="correctOption == index ? 1 : 0">
                                        <input type="hidden" :name="'options['+index+'][id]'" :value="option.id || ''">
                                    </div>
                                    <button @click.prevent="removeOption(index)" type="button" class="mt-8 text-red-600 hover:text-red-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>

                        <button @click.prevent="addOption" type="button" class="mt-3 inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Ajouter une option
                        </button>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" onclick="closeQuestionModal()" class="mr-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Sauvegarder
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function questionForm() {
            return {
                options: [{content: '', is_correct: false}, {content: '', is_correct: false}, {content: '', is_correct: false}, {content: '', is_correct: false}],
                correctOption: 0,
                formAction: "{{ route('questions.store') }}",
                addOption() {
                    this.options.push({content: '', is_correct: false});
                },
                removeOption(index) {
                    if (this.options.length > 2) {
                        this.options.splice(index, 1);
                        if (this.correctOption == index) {
                            this.correctOption = 0;
                        } else if (this.correctOption > index) {
                            this.correctOption--;
                        }
                    } else {
                        alert('Il faut au moins 2 options par question.');
                    }
                },
                loadQuestion(question) {
                    document.getElementById('questionContent').value = question.content;
                    this.options = [];
                    this.correctOption = -1;
                    
                    question.options.forEach((option, index) => {
                        this.options.push({
                            id: option.id,
                            content: option.content,
                            is_correct: option.is_correct
                        });
                        if (option.is_correct) {
                            this.correctOption = index;
                        }
                    });
                }
            }
        }

        function openQuestionModal(questionId = null) {
            const modal = document.getElementById('questionModal');
            const form = document.getElementById('questionForm');
            const methodField = document.getElementById('methodField');
            const modalTitle = document.getElementById('modalTitle');
            const questionApp = document.__x.$data.questionForm;

            if (questionId) {
                modalTitle.textContent = 'Modifier Question';
                form.action = `/questions/${questionId}`;
                methodField.innerHTML = '@method("PUT")';
                
                // Charger les données de la question
                fetch(`/questions/${questionId}`)
                    .then(response => response.json())
                    .then(question => {
                        questionApp.loadQuestion(question);
                        questionApp.formAction = `/questions/${questionId}`;
                    });
            } else {
                modalTitle.textContent = 'Nouvelle Question';
                form.action = '{{ route("questions.store") }}';
                methodField.innerHTML = '';
                form.reset();
                
                // Reset options to default 4 empty options
                questionApp.options = [
                    {content: '', is_correct: false},
                    {content: '', is_correct: false},
                    {content: '', is_correct: false},
                    {content: '', is_correct: false}
                ];
                questionApp.correctOption = 0;
                questionApp.formAction = "{{ route('questions.store') }}";
            }

            modal.classList.remove('hidden');
        }

        function closeQuestionModal() {
            const modal = document.getElementById('questionModal');
            modal.classList.add('hidden');
        }

        // Fermer le modal en cliquant en dehors
        window.onclick = function(event) {
            const modal = document.getElementById('questionModal');
            if (event.target === modal) {
                closeQuestionModal();
            }
        }
    </script>
    @endpush
</x-app-layout>