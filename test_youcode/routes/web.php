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
    // Route du dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    
    // Routes pour les quiz
    Route::prefix('dashboard')->group(function () {
        Route::post('/', [DashboardController::class, 'store'])->name('quizzes.store'); // Créer un nouveau quiz
        Route::get('/', [DashboardController::class, 'index'])->name('quizzes.index'); // Liste des quiz
        Route::get('/create', [DashboardController::class, 'create'])->name('quizzes.create'); // Formulaire de création
        Route::get('/{quiz}', [DashboardController::class, 'show'])->name('quizzes.show'); // Afficher un quiz
        Route::put('/{quiz}', [DashboardController::class, 'update'])->name('quizzes.update'); // Mettre à jour un quiz
        Route::delete('/{quiz}', [DashboardController::class, 'destroy'])->name('quizzes.destroy'); // Supprimer un quiz
        Route::get('/{quiz}/edit', [DashboardController::class, 'edit'])->name('quizzes.edit'); // Formulaire d'édition
    });
});

// User quiz routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('/quiz/start/{id?}', [QuizController::class, 'start'])->name('quiz.start');
    Route::post('/quiz/submit', [QuizController::class, 'store'])->name('quiz.store');
    Route::get('/quiz/result', [ResultController::class, 'index'])->name('quiz.result');
    Route::get('/quiz/result/{id}', [ResultController::class, 'show'])->name('quiz.result.show');
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