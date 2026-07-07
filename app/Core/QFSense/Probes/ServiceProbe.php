<?php

namespace App\Core\QFSense\Probes;

use App\Core\QFSense\Contracts\TelemetryProbe;

class ServiceProbe implements TelemetryProbe
{
    /**
     * Daftar service yang ingin dipantau.
     */
    protected array $services = [
        'nginx'      => 'nginx',
        'php'        => 'php8.3-fpm',
        'mariadb'    => 'mariadb',
        'redis'      => 'redis-server',
    ];

    public function collect(): array
    {
        $result = [];

        foreach ($this->services as $name => $service) {

            $status = trim((string) shell_exec(
                "systemctl is-active {$service} 2>/dev/null"
            ));

            $enabled = trim((string) shell_exec(
                "systemctl is-enabled {$service} 2>/dev/null"
            ));

            $result[$name] = [

                'service' => $service,

                'running' => $status === 'active',

                'enabled' => $enabled === 'enabled',

                'status' => $status ?: 'not-found',

            ];
        }

        return $result;
    }
}
