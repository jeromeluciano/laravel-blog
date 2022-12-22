@props(['active'])

<div x-data="{ show: false }" @click.away="show = false" class="relative">
    {{--  Trigger  --}}
    <div @click="show = ! show">
        {{ $trigger }}
    </div>

    {{-- Links --}}
    <div x-show="show" class="absolute mt-2 bg-gray-100 w-full rounded-xl py-2 z-50 overflow-auto max-h-52" style="display: none;">
        {{ $slot }}
    </div>
</div>
