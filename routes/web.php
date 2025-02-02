<?php

use App\Http\Controllers\ImportCSVController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('csvimport')->name('importcsv.')->group(function () {
    Route::get('/form', function () {
        return view('importcsvform');
    })->name('form');
    Route::post('/save', ImportCSVController::class)->name('save');
});

require __DIR__.'/auth.php';
