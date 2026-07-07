<?php

namespace App\Core\QFSense\Probes;

use App\Core\QFSense\Contracts\TelemetryProbe;

class UptimeProbe implements TelemetryProbe
{
    public function collect(): array
    {
        $contents = trim(file_get_contents('/proc/uptime'));

        [$seconds] = explode(' ', $contents);

        $seconds = (int) $seconds;

        return [

            'seconds' => $seconds,

            'minutes' => floor($seconds / 60),

            'hours' => floor($seconds / 3600),

            'days' => floor($seconds / 86400),

            'human' => $this->humanReadable($seconds),

        ];
    }

    protected function humanReadable(int $seconds): string
    {
        $days = floor($seconds / 86400);

        $hours = floor(($seconds % 86400) / 3600);

        $minutes = floor(($seconds % 3600) / 60);

        return sprintf(
            '%d day%s %d hour%s %d minute%s',
            $days,
            $days === 1 ? '' : 's',
            $hours,
            $hours === 1 ? '' : 's',
            $minutes,
            $minutes === 1 ? '' : 's'
        );
    }
}
