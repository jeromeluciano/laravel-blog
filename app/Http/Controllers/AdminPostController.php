<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::query()->latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.posts.create', [
            'categories' => Category::all()
        ]);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    public function store()
    {
        $attributes = array_merge($this->validatePost(), [
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]);

        $post = Post::query()
            ->create($attributes);

        return redirect("/posts/{$post->slug}")
            ->withInput()
            ->with('success', 'Your blog has been posted.');
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Post deleted!');
    }

    protected function validatePost(Post $post = null)
    {
        $post ??= new Post();

        $attributes = request()->validate([
            'title' => ['required'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'thumbnail' => $post->exists ? ['image'] : ['image', 'required'],
            'excerpt' => ['required'],
            'body' => ['required'],
            'status' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        if ($attributes['status'] ?? false) {
            if ($attributes['status'] == Post::PUBLISHED) {
                $attributes['published_at'] = now();
            }
        } else {
            $attributes['published_at'] = null;
        }

        // remove status attribute in the request data
        return array_filter($attributes, function ($key) {
            return $key !== "status";
        }, ARRAY_FILTER_USE_KEY);
    }
}
