<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store(User $user)
    {
        $authenticatedUser = Auth::user();

        if (!$authenticatedUser->isFollowing($user)) {
            $authenticatedUser->follow($user);
        }

        return back();
    }

    public function destroy(User $user)
    {
        $authenticatedUser = Auth::user();

        if ($authenticatedUser->isFollowing($user)) {
            $authenticatedUser->unfollow($user);
        }

        return back();
    }
}
