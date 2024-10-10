<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;

Route::get('/', [PagesController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/blog', [PostsController::class, 'index'])->name('blog.index'); // List all posts
Route::get('/blog/create', [PostsController::class, 'create'])->name('blog.create'); // Show create post form
Route::post('/blog', [PostsController::class, 'store'])->name('blog.store'); // Store new post
Route::get('/blog/{slug}', [PostsController::class, 'show'])->name('blog.show'); // Show single post (this was missing)
Route::get('/blog/{slug}/edit', [PostsController::class, 'edit'])->name('blog.edit'); // Show edit form
Route::put('/blog/{slug}', [PostsController::class, 'update'])->name('blog.update'); // Update the post
Route::delete('/blog/{slug}', [PostsController::class, 'destroy'])->name('blog.destroy'); // Delete the post


Route::post('/blog/{slug}/comments/create', [CommentsController::class, 'store']); // Store new comment
