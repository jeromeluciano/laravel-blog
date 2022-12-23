<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'followerCount'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function password()
    {
        return Attribute::make(
            set: fn ($password) => Hash::make($password)
        );
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    public function getFollowerCountAttribute()
    {
        return $this->followers()->count();
    }

    public function follow(User $user)
    {
        return $this->followings()->attach($user);
    }

    public function unfollow(User $user)
    {
        return $this->followings()->detach($user);
    }

    public function isFollowing(User $user)
    {
        return $this->followings()->wherePivot('following_id', $user->id)->exists();
    }

    public function isFollowedBy(User $user)
    {
        return $this->followers()->wherePivot('follower_id', $user->id)->exists();
    }

    // bookmark relationship
    public function bookmarks()
    {
        return $this->belongsToMany(Post::class, 'bookmarks', 'user_id', 'post_id')
            ->using(Bookmark::class);
    }

    public function toggleBookmark(Post $post)
    {
        if (!$this->isBookmarked($post)) {
            $this->bookmarks()->attach($post);
        } else {
            $this->bookmarks()->detach($post);
        }
    }

    public function isBookmarked(Post $post)
    {
        return $this->bookmarks()->wherePivot('post_id', $post->id)->exists();
    }
}
