<?php

namespace App\Livewire\Dashboard;

use App\Services\System\SystemService;
use Livewire\Component;

class SystemOverview extends Component
{
    public array $metrics = [];

    public function mount(): void
    {
        $this->refreshMetrics();
    }

    public function refreshMetrics(): void
    {
        $system = app(SystemService::class);
        $memory = $system->memory();
        $disk = $system->disk();
        $load = $system->loadAverage();

        $this->metrics = [
            'hostname' => $system->hostname(),
            'php' => $system->phpVersion(),
            'os' => $system->os(),
            'uptime' => $system->uptime(),
            'load' => $load,
            'memory' => [
                ...$memory,
                'percentage' => $memory['total'] > 0
                    ? round(($memory['used'] / $memory['total']) * 100, 1)
                    : 0,
            ],
            'disk' => [
                ...$disk,
                'percentage' => $disk['total'] > 0
                    ? round(($disk['used'] / $disk['total']) * 100, 1)
                    : 0,
            ],
        ];
    }

    public function render()
    {
        return view('livewire.dashboard.system-overview');
    }
}
