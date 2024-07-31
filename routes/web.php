<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DraftController;

Route::get('/', function () {
    return redirect()->route('mail.dashboard');
});

// Auth routes
Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
Route::get('/register', [AuthController::class, 'create'])->name('auth.register');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Mail routes
Route::get('/dashboard', [MailController::class, 'index'])->name('mail.dashboard');

Route::post('/dashboard', [MailController::class, 'store'])->name('mail.store');
Route::post('/dashboard/{mail}/reply', [MailController::class, 'reply'])->name('mail.reply');
Route::post('/dashboard/{mail}/forward', [MailController::class, 'forward'])->name('mail.forward');

// Trash Actions
Route::put('/dashboard/{mail}/trash', [MailController::class, 'update'])->name('mail.update');
Route::put('/dashboard/{trash}/restore', [MailController::class, 'restore'])->name('mail.restore');

// Draft actions
Route::put('/dashboard/{draft}/undraft', [MailController::class, 'undraft'])->name('mail.undraft');
/*Route::post('/dashboard/{draft}/draft', [DraftController::class, 'store'])->name('mail.draft');
Route::delete('/dashboard/{draft}/undraft', [DraftController::class, 'destroy'])->name('mail.undraft');*/