@props(['comment'])

<article class="flex bg-gray-100 border border-gray-200 p-4 rounded-xl space-x-4">
    <div class="flex-shrink-0">
        <img src="https://i.pravatar.cc/60?id={{ $comment->user_id }}" width="60" height="60" class="rounded-xl"/>
    </div>

    <div class="space-y-3">
        <header>
            <h3 class="font-bold">{{ $comment->author->name }}</h3>
            <p class="text-xs">
                Posted <time>
                    {{ $comment->created_at->diffForHumans() }}
                </time>
            </p>
        </header>

        <p class="text-sm">
            {{ $comment->body }}
        </p>
    </div>
</article>
