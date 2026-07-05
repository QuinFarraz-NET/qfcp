<div wire:poll.15s.visible="refreshMetrics" class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
<h1 class="text-3xl font-bold text-white">Dashboard</h1>

	<p class="mt-1 text-sm text-slate-400">
	    {{ $metrics['hostname'] ?? 'Server' }}
	</p>
        </div>

        <div class="flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-sm text-emerald-700">
            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
            Online
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">System load</p>
            <p class="mt-3 text-3xl font-semibold text-slate-900">
                {{ number_format($metrics['load'][0] ?? 0, 2) }}
            </p>
            <p class="mt-2 text-xs text-slate-400">1 minute average</p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Memory</p>
            <p class="mt-3 text-3xl font-semibold text-slate-900">
                {{ $metrics['memory']['percentage'] ?? 0 }}%
            </p>
            <div class="mt-3 h-2 overflow-hidden rounded-full bg-slate-100">
                <div class="h-full rounded-full bg-blue-600"
                     style="width: {{ $metrics['memory']['percentage'] ?? 0 }}%"></div>
            </div>
            <p class="mt-2 text-xs text-slate-400">
                {{ $metrics['memory']['used'] ?? 0 }} / {{ $metrics['memory']['total'] ?? 0 }} GB
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Storage</p>
            <p class="mt-3 text-3xl font-semibold text-slate-900">
                {{ $metrics['disk']['percentage'] ?? 0 }}%
            </p>
            <div class="mt-3 h-2 overflow-hidden rounded-full bg-slate-100">
                <div class="h-full rounded-full bg-emerald-500"
                     style="width: {{ $metrics['disk']['percentage'] ?? 0 }}%"></div>
            </div>
            <p class="mt-2 text-xs text-slate-400">
                {{ $metrics['disk']['used'] ?? 0 }} / {{ $metrics['disk']['total'] ?? 0 }} GB
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Uptime</p>
            <p class="mt-3 text-lg font-semibold text-slate-900">
                {{ $metrics['uptime'] ?? 'Unavailable' }}
            </p>
            <p class="mt-2 text-xs text-slate-400">PHP {{ $metrics['php'] ?? '-' }}</p>
        </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-sm font-medium text-slate-500">Operating system</p>
        <p class="mt-2 break-words text-sm text-slate-700">
            {{ $metrics['os'] ?? 'Unavailable' }}
        </p>
    </div>
</div>

