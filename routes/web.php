<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\adminPropertyController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\UserController;
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
Route::get('/admin', [adminController::class, 'index'])->middleware('auth')->name('admin.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/admin', [adminController::class, 'index'])->name('admin.index');
        Route::get('/admin/properties', [adminPropertyController::class, 'index'])->name('admin.properties');
        Route::get('/admin/properties/add', [adminPropertyController::class, 'addProperty'])->name('admin.properties.add');
        Route::post('/admin/properties', [adminPropertyController::class, 'store'])->name('admin.properties.store');
        Route::get('/admin/properties/{property}/edit', [adminPropertyController::class, 'edit'])->name('admin.properties.edit');
        Route::put('/admin/properties/{property}', [adminPropertyController::class, 'update'])->name('admin.properties.update');
        Route::delete('/admin/properties/{property}', [adminPropertyController::class, 'destroy'])->name('admin.properties.destroy');
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
        Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
    });

require __DIR__.'/auth.php';
