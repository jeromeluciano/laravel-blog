<x-layout>
    <x-setting heading="Publish new post">
        <x-panel class="">
            <form class="space-y-4" method="post" action="/admin/posts" enctype="multipart/form-data">
                @csrf

                <x-form.input name="title"/>

                <x-form.input name="slug" />

                <x-form.input name="thumbnail" type="file"/>

                <x-form.textarea name="excerpt" />

                <x-form.textarea name="body" />

                <x-form.field>
                    <x-form.label name="category" />
                    <select class="block w-full p-2 rounded-xl" name="category_id" id="category">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ ucwords($category->name) }}
                            </option>
                        @endforeach
                    </select>
                    <x-form.error name="category" />
                </x-form.field>

                <x-form.field>
                    <x-form.label name="status"/>
                    <select class="block w-full p-2 rounded-xl" name="status" id="status">
                        <option value="{{ \App\Models\Post::DRAFT }}" {{ !isset($post->published_at) ? '' : 'selected' }}>Draft</option>
                        <option value="{{ \App\Models\Post::PUBLISHED }}" {{ isset($post->published_at) ? 'selected' : '' }}>Published</option>
                    </select>
                </x-form.field>

                <x-form.button class="flex-start">Submit</x-form.button>
            </form>
        </x-panel>
    </x-setting>
</x-layout>
