@props(['active' => false])

@php
    $classes = "block px-3 py-1 text-sm text-left leading-6 hover:bg-blue-600 hover:text-white";

    if ($active) $classes .= " bg-blue-600 text-white";
@endphp

<a {{ $attributes([ "class" => $classes ]) }}>
    {{ $slot }}
</a>
