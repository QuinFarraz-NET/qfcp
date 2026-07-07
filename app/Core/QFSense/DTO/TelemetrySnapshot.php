<?php

namespace App\Core\QFSense\DTO;

class TelemetrySnapshot
{
    public function __construct(
        public readonly array $cpu = [],
        public readonly array $memory = [],
        public readonly array $disk = [],
        public readonly array $network = [],
        public readonly array $uptime = [],
        public readonly array $services = [],
    ) {
    }
}
