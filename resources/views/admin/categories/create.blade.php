<x-layout>
    <x-setting heading="Create new category">
        <x-panel class="">
            <form class="space-y-4" method="post" action="/admin/categories">
                @csrf

                <x-form.input name="name" />

                <x-form.button class="flex-start">Submit</x-form.button>
            </form>
        </x-panel>
    </x-setting>
</x-layout>
