<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function store(Post $post)
    {
        $user = Auth::user();

        $user->toggleBookmark($post);

        return back();
    }
}
