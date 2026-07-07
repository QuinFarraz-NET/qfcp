@props([
'title',
'subtitle'=>null
])

<div>

<h2 class="text-lg font-semibold text-slate-100">

{{ $title }}

</h2>

@if($subtitle)

<p class="text-sm text-slate-400">

{{ $subtitle }}

</p>

@endif

</div>
