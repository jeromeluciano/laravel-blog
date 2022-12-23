@props(['author'])
@auth
    @if (!auth()->user()->isFollowing($author))
        <form class="lg:mx-4" method="post" action="/follows/author/{{ $author->id }}">
            @csrf
            <button class="text-white text-sm font-bold py-3 rounded-xl bg-blue-500 w-full hover:bg-blue-400 tracking-wider"
                type="submit">
                Follow
            </button>
        </form>
    @else
        <form class="lg:mx-4" method="post" action="/follows/author/{{ $author->id }}">
            @csrf
            @method('DELETE')
            <button class="text-white text-sm font-bold py-3 rounded-xl bg-blue-500 w-full hover:bg-blue-400 tracking-wider"
                type="submit">
                Unfollow
            </button>
        </form>
    @endif
@endauth
