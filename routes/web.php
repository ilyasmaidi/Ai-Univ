<?php

use App\Livewire\ResearchWizard;
use App\Livewire\ResearchEditor;
use App\Http\Controllers\ResearchController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', function () {
        Illuminate\Support\Facades\Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    Route::get('/research/create', ResearchWizard::class)->name('research.create');
    Route::get('/research/{slug}/edit', ResearchEditor::class)->name('research.editor');
    Route::get('/research/{slug}/export', [ResearchController::class, 'export'])->name('research.export');
});
