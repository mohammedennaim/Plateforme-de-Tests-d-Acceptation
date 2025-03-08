<?php

use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuizQuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResultController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quiz.index');
    Route::prefix('quiz')->group(function () {
        Route::get('/', [QuizController::class, 'show'])->name('quiz.show');
        Route::get('/start', [QuizController::class, 'start'])->name('quiz.start');
        Route::post('/submit', [QuizController::class, 'submit'])->name('quiz.submit');
        Route::post('/store', [QuizController::class, 'store'])->name('quiz.store');
        Route::get('/results/{attempt}', [QuizController::class, 'showResults'])->name(name: 'quiz.results');
        Route::get('/show', [QuizController::class, 'show'])->name('quiz.show');
        Route::get('/crud', [QuizController::class, 'crud'])->name('quiz.crud');
    });
});



// Routes accessibles uniquement aux administrateurs
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Quiz CRUD routes
    Route::prefix('quizzes')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('quizzes.index');
        Route::get('/create', [DashboardController::class, 'create'])->name('quizzes.create');
        Route::post('/', [DashboardController::class, 'store'])->name('quizzes.store');
        Route::get('/{quiz}', [DashboardController::class, 'show'])->name('quizzes.show');
        Route::get('/{quiz}/edit', [DashboardController::class, 'edit'])->name('quizzes.edit');
        Route::put('/{quiz}', [DashboardController::class, 'update'])->name('quizzes.update');
        Route::delete('/{quiz}', [DashboardController::class, 'destroy'])->name('quizzes.destroy');
    });
    Route::prefix('quizzes/{quiz}/questions')->name('quiz.questions.')->group(function () {
        Route::get('/', [QuizQuestionController::class, 'index'])->name('index');
        Route::get('/create', [QuizQuestionController::class, 'create'])->name('create');
        Route::post('/', [QuizQuestionController::class, 'store'])->name('store');
        Route::get('/{question}/edit', [QuizQuestionController::class, 'edit'])->name('edit');
        Route::put('/{question}', [QuizQuestionController::class, 'update'])->name('update');
        Route::delete('/{question}', [QuizQuestionController::class, 'destroy'])->name('destroy');
    });
    // Route séparée pour l'API AJAX
    Route::get('/questions/{question}', [QuizQuestionController::class, 'show'])->name('quiz.questions.show');


    Route::prefix('options')->group(function () {
        Route::get('/', [OptionController::class, 'index'])->name('options.index');
        Route::get('/create', [OptionController::class, 'create'])->name('options.create');
        Route::post('/', [OptionController::class, 'store'])->name('options.store');
        Route::get('/{options}', [OptionController::class, 'show'])->name('options.show');
        Route::get('/{options}/edit', [OptionController::class, 'edit'])->name('options.edit');
        Route::put('/{options}', [OptionController::class, 'update'])->name('options.update');
        Route::delete('/{options}', [OptionController::class, 'destroy'])->name('options.destroy');
    });
});


Route::middleware(['auth', 'role:cme'])->group(function () {
    // Routes spécifiques CME
});

require __DIR__ . '/auth.php';