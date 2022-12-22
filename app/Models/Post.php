<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public const PUBLISHED = 1;
    public const DRAFT = 0;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(fn ($query) =>
                $query
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%')
            );

        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
           $query->whereHas('category', fn ($query) =>
                $query->where('slug', $category)
           );
        });

        $query->when($filters['author'] ?? false, function ($query, $email) {
            $query->whereHas('author', fn ($query) =>
                $query->where('email', $email)
            );
        });

        $query->whereNotNull('published_at');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
