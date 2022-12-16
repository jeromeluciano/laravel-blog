<x-layout title="{{ $post->title }}">
    <x-slot name="content">
        {!! $post->body !!}

        <a href="/">Go back</a>
    </x-slot>
</x-layout>
