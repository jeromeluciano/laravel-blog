@props(['name'])
<label for="{{ $name }}" class="font-semibold text-sm text-gray-700">
    {{ ucwords($name) }}
</label>
