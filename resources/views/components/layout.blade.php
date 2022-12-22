<!doctype html>

<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">

<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="//unpkg.com/alpinejs" defer></script>

<body style="font-family: Open Sans, sans-serif">
<section class="px-6 py-8">
    <nav class="md:flex md:justify-between md:items-center">
        <div>
            <a href="/">
                <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
            </a>
        </div>

        <div class="mt-8 md:mt-0 flex items-center">
            @auth
                <x-dropdown>
                    <x-slot:trigger>
                        <p class="cursor-pointer">Welcome, {{ auth()->user()->name }}</p>
                    </x-slot:trigger>

                    @admin
                        <x-dropdown-item class="cursor-pointer " href="/admin/posts" :active="request()->is('admin/posts')">
                            All Post
                        </x-dropdown-item>
                        <x-dropdown-item class="cursor-pointer " href="/admin/posts/create" :active="request()->is('admin/posts/create')">
                            New Post
                        </x-dropdown-item>
                    @endadmin

                    <x-dropdown-item x-data="{}" @click.prevent="$refs.logoutForm.submit()" class="cursor-pointer ">
                        Log out
                    </x-dropdown-item>

                    <form x-ref="logoutForm" method="post" action="/logout" class="ml-6 hidden" >
                        @csrf
                        <button class="text-red-600 text-sm font-semibold" type="submit">Logout</button>
                    </form>
                </x-dropdown>

            @else
                <div class="space-x-2">
                    <a href="/register" class="text-sm font-semibold uppercase">Register</a>
                    <a href="/login" class="text-sm font-semibold uppercase">Login</a>
                </div>

            @endauth


            <a href="#" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                Subscribe for Updates
            </a>
        </div>
    </nav>

    {{ $slot }}

    <footer class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
        <img src="./images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
        <h5 class="text-3xl">Stay in touch with the latest posts</h5>
        <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

        <div class="mt-10">
            <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                <form method="POST" action="/newsletter" class="lg:flex text-sm">
                    @csrf
                    <div class="lg:py-3 lg:px-5 flex items-center">
                        <label for="email" class="hidden lg:inline-block">
                            <img src="./images/mailbox-icon.svg" alt="mailbox letter">
                        </label>

                        <input id="email" name="email" type="text" placeholder="Your email address"
                               class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">

                        @error('email')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                    >
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </footer>
</section>

@if(session()->has('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        class="fixed bottom-3 right-3 bg-blue-600 text-white p-3 rounded-xl text-sm">
        <p>{{ session('success') }}</p>
    </div>
@endif

</body>
