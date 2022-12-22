@auth
    <x-panel>
        <form action="/posts/{{ $post->slug }}/comments" method="post" class="space-y-4">
            @csrf
            <header class="flex items-center space-x-4">
                <img src="https://i.pravatar.cc/60?id={{ auth()->id() }}" width="50" height="50" class="rounded-xl"/>
                <p class="text-sm ">Want to participate?</p>
            </header>

            <div class="border-b pb-4">
                <textarea class="w-full h-32 text-sm focus:ring-2" name="body" placeholder="Say something"></textarea>
            </div>
            <div class="flex justify-end">
                <x-form.button>Submit</x-form.button>
            </div>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/register" class="hover:underline">Register</a> or <a href="/login" class="hover:underline">Login</a> to leave a comment.
    </p>
@endauth
