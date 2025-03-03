<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pass Quiz') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Quiz Title</h3>
                    <form method="POST" action="{{ route('quizzes.store') }}">
                        @csrf
                        
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Question 1: What is Laravel?</label>
                            <div class="mt-2">
                                <input type="radio" id="q1a1" name="q1" value="A" class="mr-2">
                                <label for="q1a1" class="text-gray-700">A PHP framework</label>
                            </div>
                            <div class="mt-2">
                                <input type="radio" id="q1a2" name="q1" value="B" class="mr-2">
                                <label for="q1a2" class="text-gray-700">A JavaScript library</label>
                            </div>
                            <div class="mt-2">
                                <input type="radio" id="q1a3" name="q1" value="C" class="mr-2">
                                <label for="q1a3" class="text-gray-700">A CSS framework</label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Question 2: What is Tailwind CSS?</label>
                            <div class="mt-2">
                                <input type="radio" id="q2a1" name="q2" value="A" class="mr-2">
                                <label for="q2a1" class="text-gray-700">A CSS framework</label>
                            </div>
                            <div class="mt-2">
                                <input type="radio" id="q2a2" name="q2" value="B" class="mr-2">
                                <label for="q2a2" class="text-gray-700">A JavaScript library</label>
                            </div>
                            <div class="mt-2">
                                <input type="radio" id="q2a3" name="q2" value="C" class="mr-2">
                                <label for="q2a3" class="text-gray-700">A PHP framework</label>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Submit Quiz
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
