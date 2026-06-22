@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-blue-500 text-start text-base font-medium text-white bg-blue-600/10 focus:outline-none focus:text-white focus:border-blue-500 transition duration-150 ease-in-out shadow-[inset_-1px_0_10px_rgba(37,99,235,0.2)]'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white/40 hover:text-white hover:bg-white/5 hover:border-blue-500/50 focus:outline-none focus:text-white focus:bg-white/5 focus:border-blue-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
