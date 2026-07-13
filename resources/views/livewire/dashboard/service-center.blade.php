<x-qf.card class="p-6">

    <h2 class="text-xl font-bold text-white mb-6">
        Services
    </h2>

    <div class="space-y-4">

        @foreach($services as $service)

            <div class="flex items-center justify-between">

                <div>

                    <div class="font-semibold text-white">

                        {{ $service->displayName }}

                    </div>

                    <div class="text-xs text-slate-400">

                        {{ $service->name }}

                    </div>

                </div>

                <div>

                    @if($service->running)

                        <x-qf.badge variant="success">

                            Running

                        </x-qf.badge>

                    @else

                        <x-qf.badge variant="danger">

                            Stopped

                        </x-qf.badge>

                    @endif

                </div>

            </div>

        @endforeach

    </div>

</x-qf.card>
