<?php

namespace App\Core\QFSense;

use App\Core\QFSense\DTO\TelemetrySnapshot;
use App\Core\QFSense\Probes\CPUProbe;
use App\Core\QFSense\Probes\DiskProbe;
use App\Core\QFSense\Probes\MemoryProbe;
use App\Core\QFSense\Probes\NetworkProbe;
use App\Core\QFSense\Probes\ServiceProbe;
use App\Core\QFSense\Probes\UptimeProbe;

class TelemetryService
{
    public function __construct(
        protected CPUProbe $cpu,
        protected MemoryProbe $memory,
        protected DiskProbe $disk,
        protected NetworkProbe $network,
        protected UptimeProbe $uptime,
        protected ServiceProbe $services,
    ) {
    }

    public function snapshot(): TelemetrySnapshot
    {
        return new TelemetrySnapshot(
            cpu: $this->cpu->collect(),
            memory: $this->memory->collect(),
            disk: $this->disk->collect(),
            network: $this->network->collect(),
            uptime: $this->uptime->collect(),
            services: $this->services->collect(),
        );
    }
}
