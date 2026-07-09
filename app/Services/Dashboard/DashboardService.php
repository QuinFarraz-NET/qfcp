<?php

namespace App\Services\Dashboard;

use App\Core\QFSense\TelemetryService;
use App\Services\System\SystemService;

class DashboardService
{
    public function __construct(
        protected SystemService $system,
        protected TelemetryService $telemetry,
        protected HealthScoreService $health,
    ) {
    }

    public function overview(): array
    {
        $snapshot = $this->telemetry->snapshot();

        $system = [

            'hostname' => $this->system->hostname(),

            'php' => $this->system->phpVersion(),

            'os' => $this->system->os(),

            'cpu' => $snapshot->cpu,

	    'laravel' => app()->version(),

            'memory' => $snapshot->memory,

            'disk' => $snapshot->disk,

            'network' => $snapshot->network,

            'uptime' => $snapshot->uptime,

        ];

        return [

            'system' => $system,

            'health' => $this->health->calculate(
                $system,
                $snapshot->services
            ),

            'services' => $snapshot->services,

            'vpn' => [],

            'security' => [],

            'activity' => [],

        ];
    }
}
