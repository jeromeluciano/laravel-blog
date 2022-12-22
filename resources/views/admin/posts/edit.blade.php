<x-layout>
    <x-setting :heading="'Edit: ' . $post->title">
        <x-panel>
            <form class="space-y-4" method="post" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
                @csrf

                @method('PATCH')

                <x-form.input name="title" value="{{ $post->title }}"/>

                <x-form.input name="slug" value="{{ $post->slug }}" />

                <div class="flex space-x-4">
                    <div class="flex-1">
                        <x-form.input name="thumbnail" type="file" class="w-full" />
                    </div>
                    <img src="{{ asset('storage/'. $post->thumbnail) }}" class="w-40 h-40 rounded-xl" />
                </div>

                <x-form.textarea name="excerpt">
                    {{ $post->excerpt }}
                </x-form.textarea>

                <x-form.textarea name="body">
                    {{ $post->body }}
                </x-form.textarea>

                <x-form.field>
                    <x-form.label name="category" />
                    <select class="block w-full p-2 rounded-xl" name="category_id" id="category">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $post->category->id ? 'selected' : ''}}>
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
