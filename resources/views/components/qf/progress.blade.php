@props([
    'value' => 0,
    'variant' => 'success',
])

@php
$bars = [
    'success' => 'bg-emerald-500',
    'warning' => 'bg-amber-500',
    'danger'  => 'bg-red-500',
    'info'    => 'bg-indigo-500',
    'muted'   => 'bg-slate-500',
];

$barClass = $bars[$variant] ?? $bars['muted'];

$progress = max(0, min(100, (int) $value));
@endphp

<div class="h-2 w-full overflow-hidden rounded-full bg-slate-800">

    <div
        class="h-full rounded-full transition-all duration-500 {{ $barClass }}"
        style="width: {{ $progress }}%;">
    </div>

</div>
