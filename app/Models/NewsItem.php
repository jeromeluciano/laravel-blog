<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class NewsItem extends Post implements Feedable
{
    protected $table = 'posts';

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->excerpt)
            ->updated($this->updated_at)
            ->link($this->link())
            ->authorName($this->author->name)
            ->authorEmail($this->author->email);
    }

    public static function getFeedItems()
    {
        return NewsItem::query()
            ->latest('published_at')
            ->whereNot('published_at', '=', null)
            ->get();
    }
}
