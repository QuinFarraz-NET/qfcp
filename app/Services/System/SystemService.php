<?php

namespace App\Services\System;

class SystemService
{
    public function hostname(): string
    {
        return gethostname();
    }

    public function phpVersion(): string
    {
        return PHP_VERSION;
    }

    public function os(): string
    {
        return php_uname();
    }

    public function uptime(): string
    {
        return trim(shell_exec("uptime -p"));
    }

    public function loadAverage(): array
    {
        return sys_getloadavg();
    }

    public function memory(): array
    {
        $data = file('/proc/meminfo');

        $mem = [];

        foreach ($data as $line) {

            [$key, $value] = explode(':', $line);

            $mem[$key] = (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);

        }

        $total = round($mem['MemTotal']/1024/1024,2);

        $available = round($mem['MemAvailable']/1024/1024,2);

        $used = round($total-$available,2);

        return [

            'total'=>$total,

            'used'=>$used,

            'available'=>$available

        ];
    }

    public function disk(): array
    {
        $total = disk_total_space('/');

        $free = disk_free_space('/');

        return [

            'total'=>round($total/1024/1024/1024,2),

            'used'=>round(($total-$free)/1024/1024/1024,2),

            'free'=>round($free/1024/1024/1024,2)

        ];
    }
}


