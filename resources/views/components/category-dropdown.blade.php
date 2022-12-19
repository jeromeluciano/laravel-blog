<div>
    <x-dropdown>
        <x-slot name="trigger">
            <button
                class="bg-gray-100 inline-flex py-2 px-3 rounded-xl text-sm font-semibold text-left w-full lg:w-32">
                {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories'}}
                <x-icon name="arrow-down"/>
            </button>
        </x-slot>

        {{-- links --}}
        <x-dropdown-item :active="request()->is('/')" href="/">
            All
        </x-dropdown-item>

        @foreach($categories as $category)
            <x-dropdown-item
                href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category')) }}"
                :active="request()->is('/?category=' . $category->slug)"
            >
                {{ ucwords($category->name) }}
            </x-dropdown-item>
        @endforeach

    </x-dropdown>
</div>
