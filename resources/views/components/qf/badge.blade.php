@props([
    'variant' => 'success',
])

@php
$variants = [
    'success' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
    'warning' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
    'danger'  => 'bg-red-500/10 text-red-400 border-red-500/20',
    'info'    => 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20',
    'muted'   => 'bg-slate-800 text-slate-300 border-slate-700',
];

$classes = $variants[$variant] ?? $variants['muted'];
@endphp

<span {{ $attributes->merge([
    'class' => "inline-flex items-center rounded-full border px-2.5 py-1 text-xs font-medium {$classes}"
]) }}>
    {{ $slot }}
</span>
