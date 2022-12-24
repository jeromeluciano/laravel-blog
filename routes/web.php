<?php

use App\Http\Controllers\ {
    AdminCategoryController,
    AdminPostController,
    AuthController,
    BookmarkController,
    FollowController,
    NewsletterController,
    PostCommentsController,
    PostController,
    SessionController,
};

use Illuminate\Support\Facades\ {
    Route,
};

Route::feeds();

Route::controller(PostController::class)->group(function() {
Route::get('/', 'index')->name('home');
Route::get('posts/{post:slug}', 'show')->name('posts.show');
});

Route::post('/newsletter', NewsletterController::class);

Route::get('/register', [AuthController::class, 'create'])->middleware('guest');
Route::post('/register', [AuthController::class, 'store'])->middleware('guest');

Route::controller(SessionController::class)->group(function() {
Route::get('/login', 'create')->middleware('guest');
Route::post('/logout', 'destroy')->middleware('auth');
Route::post('/sessions', 'store')->middleware('guest');
});

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::middleware('can:admin')->group(function () {
    Route::resource('admin/posts', AdminPostController::class)->except('show');
    Route::resource('admin/categories', AdminCategoryController::class);
});

Route::middleware('auth')->group(function () {
    Route::post('/follows/author/{user}', [FollowController::class, 'store']);
    Route::delete('/follows/author/{user}', [FollowController::class, 'destroy']);

    Route::post('/bookmarks/post/{post}', [BookmarkController::class, 'store']);
});
