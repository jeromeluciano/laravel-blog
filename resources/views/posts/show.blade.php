<x-layout title="{{ $post->title }}">
    <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
        <div class="space-y-4 col-span-4 lg:text-center lg:pt-14 mb-10">
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl">

            <p class="mt-4 block text-gray-400 text-xs">
                Published <time> {{ $post->created_at->diffForHumans() }} </time>
            </p>

            <div class="mt-4 text-gray-400 text-xs flex items-center justify-center space-x-2">
                <x-icon name="eye" />
                <p class="text-gray-500 font-semibold">{{ $post->views }}</p>
            </div>

            <div class="flex items-center lg:justify-center text-sm mt-4">
                <img class="rounded-xl" src="https://i.pravatar.cc/60?id={{ $post->user_id }}" alt="Lary avatar">
                <div class="ml-3 text-center space-y-2">
                    <h5 class="font-bold">{{ $post->author->name }}</h5>
                    <h6 class="text-center text-gray-700">{{ $post->author->followerCount }} Followers</h6>
                </div>
            </div>

            <x-follow-author :author="$post->author" />

            <div class="space-y-4 mt-8">
                <h4 class="font-bold text-sm">
                    Bookmarks
                </h4>
                @if ($bookmarks->count())
                    <div class="space-y-2">
                        @foreach ($bookmarks as $bookmark)
                            <a class="text-sm block hover:text-blue-500 {{ $post->slug == $bookmark->slug ? 'text-blue-500' : '' }}"
                                href="/posts/{{ $bookmark->slug }}">
                                {{ $bookmark->title }}
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-xs">Nothing bookmarked yet.</p>
                @endif
            </div>
        </div>

        <div class="col-span-8">
            <div class="hidden lg:flex justify-between mb-6">
                <a href="/"
                    class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                    <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                            </path>
                            <path class="fill-current"
                                d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                            </path>
                        </g>
                    </svg>
                    Back to Posts
                </a>

                <div class="space-x-4 flex items-center">
                    <x-category-button :category="$post->category" />
                    <x-bookmark-post :post="$post" :bookmarked="$bookmarked" />
                </div>
            </div>

            <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                {{ $post->title }}
            </h1>

            <div class="space-y-4 lg:text-lg leading-loose">
                {!! $post->body !!}
            </div>

            <section class="mt-6 space-y-8">
                @include('posts._add-comment-form')

                @foreach ($comments as $comment)
                    <x-post-comment :comment="$comment" />
                @endforeach
            </section>
        </div>
    </article>
</x-layout>
