<?php

namespace App\Core\QFSense\Probes;

use App\Core\QFSense\Contracts\TelemetryProbe;

class DiskProbe implements TelemetryProbe
{
    public function collect(): array
    {
        $path = '/';

        $total = disk_total_space($path);

        $free = disk_free_space($path);

        $used = $total - $free;

        return [

            'path' => $path,

            'total_gb' => round($total / 1024 / 1024 / 1024, 2),

            'used_gb' => round($used / 1024 / 1024 / 1024, 2),

            'free_gb' => round($free / 1024 / 1024 / 1024, 2),

            'usage' => $total > 0
                ? round(($used / $total) * 100, 1)
                : 0,

        ];
    }
}
