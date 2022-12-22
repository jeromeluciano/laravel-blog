<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminCategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    public function store()
    {
        $attributes = $this->validateCategory();

        Category::query()
            ->create($attributes);

        return redirect('/admin/categories');
    }

    public function update(Category $category)
    {
        $attributes = $this->validateCategory($category);

        $category->update($attributes);

        return redirect('admin/categories')->with('success', 'Category updated!');
    }

    public function validateCategory(Category $category = null)
    {
        $category ??= new Category();

        $attributes = request()->validate([
            'name' => $category->exists ? ['required', Rule::unique('categories', 'name')->ignore($category)] : ['required', Rule::unique('categories', 'name')],
        ]);

        $attributes['slug'] = Category::makeSlugFromTitle($attributes['name']);

        return $attributes;
    }
}
