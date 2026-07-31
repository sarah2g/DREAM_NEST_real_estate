<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sale', [PropertyController::class, 'sale'])->name('sale');
Route::get('/rent', [PropertyController::class, 'rent'])->name('rent');
Route::get('/property/{property}', [PropertyController::class, 'show'])->name('property.show');
Route::post('/property/{property}/favorite', [PropertyController::class, 'makefavorites'])->middleware('auth')->name('property.favorite');
Route::delete('/property/{property}/favorite', [PropertyController::class, 'cancelfavorites'])->middleware('auth')->name('property.cancelfavorite');
Route::get('/dashboard', function () {

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
