<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController\PostController;
use App\Http\Controllers\ClientController\HomeController;
use App\Http\Controllers\AdminController\CategoryController;
use App\Http\Controllers\ClientController\PostViewController;
use App\Http\Controllers\ClientController\PostCategoryController;

// Route::get('/', function () {
//     return Inertia::render('Welcome');
// })->name('home');
// Client Route
Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/post/view/{id}', [PostViewController::class, 'view']);
Route::get('/category/{slug}', [PostCategoryController::class, 'show'])->name('category.show');

// Route::get('/about',[AboutController::class,'index']);

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Route
Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
