<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public function __construct(public $title, public $slug, public $excerpt, public $body, public $date)
    {
    }

    public static function all()
    {
        return collect(File::files(resource_path("posts")))
            ->map(fn($file) => YamlFrontMatter::parseFile($file))
            ->map(fn($document) => new Post(
                $document->title,
                $document->slug,
                $document->excerpt,
                $document->body(),
                $document->date
            ));
    }

    public static function find(string $slug)
    {
       return static::all()->firstWhere('slug', $slug);
    }

    public static function findOrFail(string $slug)
    {
        $post = static::find($slug);

        if (! $post) {
            throw new ModelNotFoundException();
        }

        return $post;
    }
}
