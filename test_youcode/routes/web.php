<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResultController;


Route::get('/', function () {
    return view('welcome');
});


// Route::get('/passQuiz', [QuizController::class, 'show'])->middleware(['auth'])->name('quiz.show');
// Route::post('/passQuiz', [QuizController::class, 'submit'])->middleware(['auth'])->name('quiz.submit');
// Routes accessibles aux administrateurs et au staff
// Route::middleware(['auth', 'admin:admin,staff'])->group(function () {
//     Route::get('/admin/dashboard', [QuizController::class, 'dashboard'])->name('admin.dashboard');
// });

// Routes accessibles uniquement aux administrateurs
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard route
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
});

// User quiz routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quiz.index');
    Route::prefix('quiz')->group(function () {
        Route::get('/', [QuizController::class, 'show'])->name('quiz.show');
        Route::get('/start', [QuizController::class, 'start'])->name('quiz.start');
        Route::post('/submit', [QuizController::class, 'submit'])->name('quiz.submit');
        Route::post('/store', [QuizController::class, 'store'])->name('quiz.store');
        Route::get('/results/{attempt}', [QuizController::class, 'showResults'])->name('quiz.results');
    });
    // Route::get('/quiz/start', [QuizController::class, 'start'])->name('quiz.start');
    // Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
    // Route::post('/quiz/store', [QuizController::class, 'store'])->name('quiz.store');
    // Route::get('/quiz/results/{attempt}', [QuizController::class, 'showResults'])->name('quiz.results');
    // Route::get('/quiz/result', [ResultController::class, 'index'])->name('quiz.result');
    // Route::get('/quiz/result/{id}', [ResultController::class, 'show'])->name('quiz.result.show');
    Route::get('/my-attempts', [QuizController::class, 'userAttempts'])->name('quiz.attempts');
});

// // Admin routes (add admin middleware as needed)
// Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::resource('quizzes', AdminQuizController::class);
//     Route::get('/quizzes/{quiz}/questions', [AdminQuizController::class, 'questions'])->name('quizzes.questions');
//     Route::get('/quiz-results', [AdminQuizController::class, 'results'])->name('quizzes.results');
// });
// Routes accessibles aux CME
Route::middleware(['auth', 'role:cme'])->group(function () {
    // Routes spécifiques CME
});
require __DIR__.'/auth.php';