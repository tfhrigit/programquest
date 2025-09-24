<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\VoteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route utama ProgramQuest
|
*/

// Halaman utama → daftar pertanyaan
Route::get('/dashboard', function () {
    return redirect()->route('questions.index');
})->middleware(['auth'])->name('dashboard');

Route::get('/', [QuestionController::class, 'index'])->name('questions.index');

// Resource untuk pertanyaan (index, create, store, show)
Route::resource('questions', QuestionController::class)->only([
    'index', 'create', 'store', 'show'
]);

// Jawaban
Route::post('/questions/{id}/answers', [AnswerController::class, 'store'])->name('answers.store');
Route::post('/answers/{id}/best', [AnswerController::class, 'best'])->name('answers.best');

// Komentar
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

// Voting AJAX
Route::post('/vote', [VoteController::class, 'vote'])->name('vote');

// Auth (Breeze sudah daftarin route otomatis)
// Login, Register, Logout ada di vendor Breeze
require __DIR__.'/auth.php';
