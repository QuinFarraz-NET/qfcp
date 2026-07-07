<?php

namespace App\Core\QFSense\Probes;

use App\Core\QFSense\Contracts\TelemetryProbe;

class CPUProbe implements TelemetryProbe
{
    public function collect(): array
    {
        return [
            'usage' => $this->cpuUsage(),
            'load' => $this->loadAverage(),
            'cores' => $this->cpuCores(),
        ];
    }

    protected function cpuUsage(): float
    {
        $stat1 = $this->readCpuStat();

        usleep(500000);

        $stat2 = $this->readCpuStat();

        $idle = $stat2['idle'] - $stat1['idle'];
        $total = $stat2['total'] - $stat1['total'];

        if ($total <= 0) {
            return 0;
        }

        return round((1 - ($idle / $total)) * 100, 1);
    }

    protected function loadAverage(): array
    {
        $load = sys_getloadavg();

        return [
            '1m' => round($load[0] ?? 0, 2),
            '5m' => round($load[1] ?? 0, 2),
            '15m' => round($load[2] ?? 0, 2),
        ];
    }

    protected function cpuCores(): int
    {
        $count = trim((string) shell_exec('nproc'));

        return (int) $count;
    }

    protected function readCpuStat(): array
    {
        $line = file('/proc/stat')[0];

        $parts = preg_split('/\s+/', trim($line));

        array_shift($parts);

        $values = array_map('intval', $parts);

        $idle = ($values[3] ?? 0) + ($values[4] ?? 0);

        return [
            'idle' => $idle,
            'total' => array_sum($values),
        ];
    }
}
