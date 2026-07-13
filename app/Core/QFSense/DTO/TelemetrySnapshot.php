<?php

namespace App\Core\QFSense\DTO;

final readonly class TelemetrySnapshot
{
    public function __construct(
        public array $cpu = [],
        public array $memory = [],
        public array $disk = [],
        public array $network = [],
        public array $uptime = [],
        public array $services = [],
    ) {
    }

    public function toArray(): array
    {
        return [

            'cpu' => $this->cpu,

            'memory' => $this->memory,

            'disk' => $this->disk,

            'network' => $this->network,

            'uptime' => $this->uptime,

            'services' => $this->services,

        ];
    }
}
