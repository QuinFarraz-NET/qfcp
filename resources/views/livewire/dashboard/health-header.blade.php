<x-qf.card class="p-8">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-white">
                Mission Control
            </h1>

            <p class="mt-2 text-slate-400">
                Enterprise Infrastructure Control Platform
            </p>

            <div class="mt-4 text-sm text-slate-500">
                Host :
                {{ $overview['system']['hostname'] }}
            </div>

<div class="mt-3 space-y-1 text-xs text-slate-500">

    <div>
        OS :
        {{ $overview['system']['os'] }}
    </div>

    <div>
        PHP :
        {{ $overview['system']['php'] }}
    </div>

    <div>
        Laravel :
        {{ $overview['system']['laravel'] }}
    </div>

</div>


        </div>

        <div class="text-right">

            <x-qf.badge
                :variant="$overview['health']['score'] >= 85 ? 'success' : 'warning'">

                {{ $overview['health']['status'] }}

            </x-qf.badge>

            <div class="mt-4">

                <div class="text-4xl font-bold text-white">

                    {{ $overview['health']['score'] }}%

                </div>

                <div class="text-sm text-slate-400">

                    Infrastructure Health

                </div>

                <div class="mt-2 text-xs text-slate-500">

                    Last Update :
		    {{ now()->format('H:i:s') }} WIB
                </div>

            </div>

        </div>

    </div>

</x-qf.card>
