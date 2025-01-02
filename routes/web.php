<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EvaluationEleveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Gate;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])
         ->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'index'])
         ->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])
         ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
         ->name('profile.destroy');

    // Modules Routes
    Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');
    Route::get('/modules/{module}', [ModuleController::class, 'show'])->name('modules.show');
    Route::middleware('can:gerer-modules')->group(function () {
        Route::get('/modules/create', [ModuleController::class, 'create'])->name('modules.create');
        Route::post('/modules', [ModuleController::class, 'store'])->name('modules.store');
        Route::get('/modules/{module}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
        Route::put('/modules/{module}', [ModuleController::class, 'update'])->name('modules.update');
        Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy');
    });

    // Evaluations Routes
    Route::get('/evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');
    Route::get('/evaluations/{evaluation}', [EvaluationController::class, 'show'])->name('evaluations.show');
    Route::middleware('can:gerer-evaluations')->group(function () {
        Route::get('/evaluations/create', [EvaluationController::class, 'create'])->name('evaluations.create');
        Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');
        Route::get('/evaluations/{evaluation}/edit', [EvaluationController::class, 'edit'])->name('evaluations.edit');
        Route::put('/evaluations/{evaluation}', [EvaluationController::class, 'update'])->name('evaluations.update');
        Route::delete('/evaluations/{evaluation}', [EvaluationController::class, 'destroy'])->name('evaluations.destroy');
    });

    // Evaluation Notes Routes
    Route::middleware('can:voir-notes-eleve')->group(function () {
        Route::get('/evaluations/{id}/below-average', [EvaluationController::class, 'belowAverage'])->name('evaluations.belowAverage');
        Route::get('/evaluations/{id}/notes', [EvaluationController::class, 'notes'])->name('evaluations.notes');
    });

    // Eleves Routes
    Route::get('/eleves', [EleveController::class, 'index'])->name('eleves.index');
    Route::get('/eleves/{eleve}', [EleveController::class, 'show'])->name('eleves.show');
    Route::get('/eleves/{id}/notes', [EleveController::class, 'notes'])->name('eleves.notes');
    Route::middleware('can:gerer-etudiants')->group(function () {
        Route::get('/eleves/create', [EleveController::class, 'create'])->name('eleves.create');
        Route::post('/eleves', [EleveController::class, 'store'])->name('eleves.store');
        Route::get('/eleves/{eleve}/edit', [EleveController::class, 'edit'])->name('eleves.edit');
        Route::put('/eleves/{eleve}', [EleveController::class, 'update'])->name('eleves.update');
        Route::delete('/eleves/{eleve}', [EleveController::class, 'destroy'])->name('eleves.destroy');
    });

    // EvaluationEleve Routes
    Route::get('/evaluations/{evaluation}/evaluationEleves', [EvaluationEleveController::class, 'index'])
        ->name('evaluations.evaluationEleves');
    Route::middleware('can:gerer-notes')->group(function () {
        Route::get('/evaluationEleves/{evaluationEleve}/edit', [EvaluationEleveController::class, 'edit'])
            ->name('evaluationEleves.edit');
        Route::get('/evaluations/{evaluation}/evaluationEleves/create', [EvaluationEleveController::class, 'create'])
            ->name('evaluationEleves.create');
        Route::post('/evaluations/{evaluation}/evaluationEleves', [EvaluationEleveController::class, 'store'])
            ->name('evaluationEleves.store');
        Route::put('/evaluationEleves/{evaluationEleve}', [EvaluationEleveController::class, 'update'])
            ->name('evaluationEleves.update');
        Route::delete('/evaluationEleves/{evaluationEleve}', [EvaluationEleveController::class, 'destroy'])
            ->name('evaluationEleves.destroy');
    });

    // API Routes
    Route::get('/api/eleves', [EleveController::class, 'api'])->name('api.eleves');
    Route::get('/api/eleves/{id}/notes', [EleveController::class, 'exportNotes'])->name('api.eleves.notes');
});

// Authentication Routes
require __DIR__.'/auth.php';
