<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('home');

Route::get('/register', [\App\Http\Controllers\AuthController::class, 'create'])->middleware('guest');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'store'])->middleware('guest');

Route::get('/login', [\App\Http\Controllers\SessionController::class, 'create'])->middleware('guest');
Route::post('/sessions', [\App\Http\Controllers\SessionController::class, 'store'])->middleware('guest');
Route::post('/logout', [\App\Http\Controllers\SessionController::class, 'destroy'])->middleware('auth');


Route::get('posts/{post:slug}', [\App\Http\Controllers\PostController::class, 'show']);

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts->load(['author', 'category']),
        "currentCategory" => $category,
        "categories" => Category::all()
    ]);
});

Route::get('authors/{author}', function (User $author) {
    return view('posts', [
        'posts' => $author->posts->load(['author', 'category']),
        "categories" => Category::all()
    ]);
});
