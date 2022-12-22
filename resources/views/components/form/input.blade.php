@props(['name'])
<x-form.field>
    <x-form.label :name="$name"/>

    <input name="{{ $name }}"
           class="w-full border border-gray-200 py-2 px-3 rounded-xl text-sm"
           {{ $attributes }}
    />

    <x-form.error :name="$name" />
</x-form.field>
