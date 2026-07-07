@props([
    'title',
    'value',
    'subtitle' => '',
    'status' => 'Healthy',
    'variant' => 'success',
    'progress' => 0,
    'icon' => '🖥️',
])

<x-qf.card class="p-6">

    <div class="flex items-center justify-between">

        <div class="flex items-center gap-3">

            <div class="text-3xl">
                {{ $icon }}
            </div>

            <div>

                <h3 class="text-sm font-medium text-slate-400">
                    {{ $title }}
                </h3>

            </div>

        </div>

        <x-qf.badge :variant="$variant">
            {{ $status }}
        </x-qf.badge>

    </div>

    <div class="mt-6">

        <div class="text-4xl font-bold tracking-tight text-white">

            {{ $value }}

        </div>

    </div>

    <div class="mt-2 text-sm text-slate-400">

        {{ $subtitle }}

    </div>

    <div class="mt-5">

        <x-qf.progress
            :value="$progress"
            :variant="$variant"/>

    </div>

</x-qf.card>
