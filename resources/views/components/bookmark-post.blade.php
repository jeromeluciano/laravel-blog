@props(['post', 'bookmarked'])
<form method="post" action="/bookmarks/post/{{ $post->id }}">
    @csrf
    <button type="submit" class="text-sm font-light bg-gray-200 hover:bg-gray-100 py-1 px-4 rounded-2xl">
        {{ !$bookmarked ? 'Add to bookmark' : 'Remove from bookmarks' }}
    </button>
</form>
