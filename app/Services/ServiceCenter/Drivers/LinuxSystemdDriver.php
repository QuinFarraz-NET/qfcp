<?php

namespace App\Services\ServiceCenter\Drivers;

class LinuxSystemdDriver
{
    protected array $services = [

        'nginx'          => 'Nginx',
        'php8.3-fpm'     => 'PHP-FPM',
        'mariadb'        => 'MariaDB',
        'wg-quick@wg0'   => 'WireGuard',

    ];

    public function services(): array
    {
        $result = [];

        foreach ($this->services as $unit => $display) {

            $info = $this->serviceProperties($unit);

            $result[] = [

                'name'         => $unit,
                'displayName'  => $display,

                'running'      => ($info['ActiveState'] ?? '') === 'active',
                'enabled'      => ($info['UnitFileState'] ?? '') === 'enabled',

                'pid'          => (int) ($info['MainPID'] ?? 0),

                'description'  => $info['Description'] ?? '',

                'activeState'  => $info['ActiveState'] ?? '',

                'subState'     => $info['SubState'] ?? '',

                'startedAt'    => $info['ExecMainStartTimestamp'] ?? '',

            ];
        }

        return $result;
    }

    /**
     * Read service information from systemd.
     */
    protected function serviceProperties(string $service): array
    {
        $properties = [];

        exec(
            "systemctl show {$service} --no-page "
            . "-p Description "
            . "-p ActiveState "
            . "-p SubState "
            . "-p UnitFileState "
            . "-p MainPID "
            . "-p ExecMainStartTimestamp "
            . "2>/dev/null",
            $output
        );

        foreach ($output as $line) {

            if (! str_contains($line, '=')) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);

            $properties[$key] = trim($value);
        }

        return $properties;
    }
}

