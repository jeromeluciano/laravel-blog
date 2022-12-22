@props(['name'])
<x-form.field>
    <x-form.label :name="$name"/>

    <textarea name="{{ $name }}" id="{{ $name }}"
              class="w-full border border-gray-200 py-2 px-3 rounded-xl text-sm">{{ $slot ?? trim(old($name)) }}</textarea>

    <x-form.error :name="$name" />
</x-form.field>
