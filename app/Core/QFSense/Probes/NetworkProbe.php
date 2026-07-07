<?php

namespace App\Core\QFSense\Probes;

use App\Core\QFSense\Contracts\TelemetryProbe;

class NetworkProbe implements TelemetryProbe
{
    public function collect(): array
    {
        $interfaces = [];

        $lines = file('/proc/net/dev');

        foreach (array_slice($lines, 2) as $line) {

            $line = trim($line);

            if ($line === '') {
                continue;
            }

            [$iface, $stats] = explode(':', $line);

            $iface = trim($iface);

            $values = preg_split('/\s+/', trim($stats));

            $interfaces[$iface] = [

                'rx_bytes' => (int) ($values[0] ?? 0),

                'tx_bytes' => (int) ($values[8] ?? 0),

                'rx_mb' => round(($values[0] ?? 0) / 1024 / 1024, 2),

                'tx_mb' => round(($values[8] ?? 0) / 1024 / 1024, 2),

            ];
        }

        return [
            'interfaces' => $interfaces,
        ];
    }
}
