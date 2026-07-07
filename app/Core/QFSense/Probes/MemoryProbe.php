<?php

namespace App\Core\QFSense\Probes;

use App\Core\QFSense\Contracts\TelemetryProbe;

class MemoryProbe implements TelemetryProbe
{
    public function collect(): array
    {
        $meminfo = file('/proc/meminfo');

        $data = [];

        foreach ($meminfo as $line) {

            [$key, $value] = explode(':', $line);

            $data[$key] = (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);

        }

        $total = $data['MemTotal'] ?? 0;

        $available = $data['MemAvailable'] ?? 0;

        $used = $total - $available;

        return [

            'total_mb' => round($total / 1024, 1),

            'used_mb' => round($used / 1024, 1),

            'available_mb' => round($available / 1024, 1),

            'usage' => $total > 0
                ? round(($used / $total) * 100, 1)
                : 0,

            'swap_total_mb' => round(($data['SwapTotal'] ?? 0) / 1024, 1),

            'swap_free_mb' => round(($data['SwapFree'] ?? 0) / 1024, 1),

        ];
    }
}
