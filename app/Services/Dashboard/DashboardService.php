<?php

namespace App\Services\Dashboard;

use App\Services\System\SystemService;

class DashboardService
{
    public function __construct(
        protected SystemService $system
    ) {
    }

    public function overview(): array
    {
        return [
            'system' => [
                'hostname' => $this->system->hostname(),
                'php'      => $this->system->phpVersion(),
                'os'       => $this->system->os(),
                'uptime'   => $this->system->uptime(),
                'load'     => $this->system->loadAverage(),
                'memory'   => $this->system->memory(),
                'disk'     => $this->system->disk(),
            ],

            'health' => [
                'score' => 100,
                'status' => 'Healthy',
            ],

            'services' => [],

            'vpn' => [],

            'security' => [],

            'activity' => [],
        ];
    }
}
