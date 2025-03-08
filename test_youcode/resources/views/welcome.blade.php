<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YouCode - École de Développement Web</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="antialiased bg-gradient-to-br from-indigo-50 to-pink-50 dark:from-gray-900 dark:to-gray-800">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md dark:bg-gray-900/80 shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <img src="https://youcode.ma/wp-content/uploads/2020/09/logo-youcode.png" alt="YouCode Logo"
                        class="h-8 w-auto">
                </div>

                @if (Route::has('login'))
                    <div class="flex items-center space-x-4">
                        @auth
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="flex items-center space-x-3 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition duration-150">
                                    <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                        alt="{{ Auth::user()->name }}"
                                        class="h-9 w-9 rounded-full object-cover ring-2 ring-indigo-500">
                                    <span class="font-medium">{{ Auth::user()->name }}</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute right-0 mt-3 w-48 rounded-xl shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
                                    <a href="{{ url('/') }}"
                                        class="group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700">
                                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-500"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        Home
                                    </a>
                                    <a href="{{ url('/profile') }}"
                                        class="group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700">
                                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-500"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Profile
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="group flex w-full items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700">
                                            <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-500"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Déconnexion
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition duration-150">Connexion</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                                    Inscription
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <div class="relative h-90 pt-16 pb-32 flex flex-col justify-center sm:px-6 lg:px-8">
        <div class="absolute inset-0">
            <img class="h-full w-full object-cover"
                src="https://images.unsplash.com/photo-1702390600380-5dc2bb300025?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="Background">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-900 to-purple-900 mix-blend-multiply opacity-70">
            </div>
        </div>

        <div class=" mt-3 relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden">
                <div class="p-8">
                    <div class="text-center">
                        <h1 class="text-5xl font-extrabold text-white mb-6">
                            Bienvenue à YouCode
                        </h1>
                        <p class="text-2xl text-gray-200 mb-12">
                            Votre parcours vers une carrière en développement web commence ici
                        </p>
                    </div>

                    <div class="space-y-8">
                        <div class="bg-white/10 backdrop-blur rounded-xl p-8">
                            <h2 class="text-3xl font-bold text-white mb-6">
                                À propos de YouCode
                            </h2>
                            <p class="text-lg text-gray-200">
                                YouCode est une école innovante de développement web qui forme la prochaine génération
                                de développeurs. Notre programme intensif combine apprentissage pratique et théorique
                                pour vous préparer aux défis du monde professionnel.
                            </p>
                        </div>

                        <div class="bg-white/10 backdrop-blur rounded-xl p-8">
                            <h2 class="text-3xl font-bold text-white mb-6">
                                Test d'admission
                            </h2>
                            <p class="text-lg text-gray-200 mb-8">
                                Pour rejoindre notre programme, vous devez réussir un test d'admission comprenant 20
                                questions qui évalueront vos compétences et votre potentiel.
                            </p>
                            <div class="flex justify-center">
                                <a href="{{ route('quiz.start') }}"
                                    class="group inline-flex items-center px-8 py-4 text-lg font-semibold rounded-xl text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:scale-105">
                                    Commencer le Quiz
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="ml-3 h-6 w-6 group-hover:translate-x-2 transition-transform duration-200"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>