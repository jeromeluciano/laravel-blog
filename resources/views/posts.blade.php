<x-layout title="Blog">
    <x-slot name="content">
        <h1>Blog</h1>
        @foreach($posts as $post)
            <article>
                <h1>
                    <a href="/posts/{{ $post->slug  }}">
                        {{ $post->title }}
                    </a>
                    <p>
                        {{ $post->excerpt  }}
                    </p>
                </h1>
            </article>
        @endforeach
    </x-slot>
</x-layout>
