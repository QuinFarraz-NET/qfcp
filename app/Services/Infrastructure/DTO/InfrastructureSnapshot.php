<?php

namespace App\Services\Infrastructure\DTO;

class InfrastructureSnapshot
{
    public function __construct(

        public readonly array $telemetry,

        public readonly array $services,

        public readonly array $health,

        public readonly \DateTimeImmutable $generatedAt,

    ) {
    }

    public function toArray(): array
    {
        return [

            'telemetry' => $this->telemetry,

            'services' => $this->services,

            'health' => $this->health,

            'generatedAt' => $this->generatedAt
                ->format('Y-m-d H:i:s'),

        ];
    }
}
