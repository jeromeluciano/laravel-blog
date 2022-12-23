<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    //
    public function index()
    {

        return view('posts.index', [
            "posts" => Post::query()
                ->latest()
                ->filter(request(['search', 'category', 'author']))
                ->paginate(6)
                ->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        $user = Auth::user();

        // increment view count before loading the view
        $post->incrementViews();

        return view('posts.show', [
            'post' => $post,
            'comments' => $post->load(['comments'])->comments,
            'bookmarked' => $user->isBookmarked($post),
            'bookmarks' => $user->bookmarks
        ]);
    }
}
