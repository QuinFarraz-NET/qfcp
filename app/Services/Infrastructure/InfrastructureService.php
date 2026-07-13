<?php

namespace App\Services\Infrastructure;

use App\Core\QFSense\TelemetryService;
use App\Services\Infrastructure\DTO\InfrastructureSnapshot;
use App\Services\ServiceCenter\ServiceManager;
use DateTimeImmutable;

class InfrastructureService
{
    public function __construct(

        protected TelemetryService $telemetry,

        protected ServiceManager $services,

    ) {
    }

    public function snapshot(): InfrastructureSnapshot
    {
        $telemetry = $this->telemetry->snapshot();

        $services = $this->services->services();

        $health = [

            'score' => $this->services->healthy(),

            'critical' => count(
                $this->services->critical()
            ),

        ];

        return new InfrastructureSnapshot(

            telemetry: $telemetry->toArray(),

            services: array_map(
                fn ($service) => $service->toArray(),
                $services
            ),

            health: $health,

            generatedAt: new DateTimeImmutable(),

        );
    }
}

