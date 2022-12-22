@props(['heading'])
<section class="max-w-7xl mx-auto p-8 rounded-xl my-8">
    <h1 class="text-left font-bold text-gray-700 pb-3 mb-5 border-b text-2xl">
        {{ $heading }}
    </h1>
    <div class="flex">
        <aside class="w-48">
            <h4 class="font-semibold mb-4">Links</h4>

            <ul class="space-y-2">
                <li>
                    <a href="/admin/posts" class="{{ request()->is('admin/posts') ? 'text-blue-500' : '' }}">All Posts</a>
                </li>

                <li>
                    <a href="/admin/posts/create"
                        class="{{ request()->is('admin/posts/create') ? 'text-blue-500' : '' }}">New Post</a>
                </li>

                <li>
                    <a href="/admin/categories" class="{{ request()->is('admin/category') ? 'text-blue-500' : '' }}">All
                        Categories</a>
                </li>

                <li>
                    <a href="/admin/categories/create"
                        class="{{ request()->is('admin/category/create') ? 'text-blue-500' : '' }}">New Category</a>
                </li>
            </ul>
        </aside>

        <main class="flex-1">
            {{ $slot }}
        </main>
    </div>
</section>
