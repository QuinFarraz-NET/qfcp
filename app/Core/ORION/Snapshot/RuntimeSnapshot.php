<?php

namespace App\Core\ORION\Snapshot;

use App\Core\ORION\Health\HealthReport;
use DateTimeImmutable;

final readonly class RuntimeSnapshot
{
    public function __construct(
        public array $telemetry,
        public array $services,
	public array $website,
        public HealthReport $health,
        public SystemInfo $system,
        public string $version,
        public string $status,
        public DateTimeImmutable $generatedAt,
    ) {
    }

    public function toArray(): array
    {
        return [

            'telemetry' => $this->telemetry,

            'services' => $this->services,

            'health' => $this->health->toArray(),

            'system' => $this->system->toArray(),

	    'website' => $this->website,

            'version' => $this->version,

            'status' => $this->status,

            'generatedAt' => $this->generatedAt
                ->format('Y-m-d H:i:s'),

        ];
    }
}
