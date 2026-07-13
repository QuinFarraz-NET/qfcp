<?php

namespace App\Services\Dashboard;

use App\Core\ORION\Runtime\Runtime;

class DashboardService
{
    public function __construct(
        protected Runtime $runtime,
    ) {
    }

    public function overview(): array
    {
        $snapshot = $this->runtime->snapshot();

        return [

            'system' => [

                ...$snapshot->system->toArray(),

                'cpu' => $snapshot->telemetry['cpu'] ?? [],

                'memory' => $snapshot->telemetry['memory'] ?? [],

                'disk' => $snapshot->telemetry['disk'] ?? [],

                'network' => $snapshot->telemetry['network'] ?? [],

                'uptime' => $snapshot->telemetry['uptime'] ?? [],

            ],

            'health' => $snapshot->health->toArray(),

            'services' => $snapshot->services,

            'telemetry' => $snapshot->telemetry,

            'version' => $snapshot->version,

            'status' => $snapshot->status,

            'generatedAt' => $snapshot->generatedAt->format('Y-m-d H:i:s'),

            'vpn' => [],

            'security' => [],

            'activity' => [],

        ];
    }
}
