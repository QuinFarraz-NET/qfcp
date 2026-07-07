<?php

namespace App\Core\QFSense\Contracts;

interface TelemetryProbe
{
    /**
     * Collect telemetry data.
     */
    public function collect(): array;
}
