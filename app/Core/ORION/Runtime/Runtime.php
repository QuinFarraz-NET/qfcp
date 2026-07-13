<?php

namespace App\Core\ORION\Runtime;

use App\Core\ORION\Capability\CapabilityRegistry;
use App\Core\ORION\Health\HealthEngine;
use App\Core\ORION\Health\HealthReport;
use App\Core\ORION\Snapshot\RuntimeSnapshot;
use App\Core\ORION\Snapshot\SystemInfo;
use App\Services\Infrastructure\InfrastructureService;
use DateTimeImmutable;

final class Runtime
{
    public const VERSION = '0.1.0-alpha';

    /**
     * Cached Runtime Snapshot (per request)
     */
    private ?RuntimeSnapshot $snapshot = null;

    public function __construct(
        protected InfrastructureService $infrastructure,
        protected HealthEngine $healthEngine,
        protected CapabilityRegistry $capabilities,
    ) {
    }

    public function version(): string
    {
        return self::VERSION;
    }

    public function status(): string
    {
        return 'READY';
    }

    public function snapshot(): RuntimeSnapshot
    {
        if ($this->snapshot !== null) {
            return $this->snapshot;
        }

        $infra = $this->infrastructure->snapshot();

        $health = $this->healthEngine->evaluate(
            serviceHealth: $infra->health['score'] ?? 100,
        );

        $system = new SystemInfo(
            hostname: php_uname('n'),
            os: php_uname(),
            php: PHP_VERSION,
            laravel: app()->version(),
        );

        $this->snapshot = new RuntimeSnapshot(
            telemetry: $infra->telemetry,
            services: $infra->services,
            health: $health,
            system: $system,
            version: $this->version(),
            status: $this->status(),
            generatedAt: new DateTimeImmutable(),
        );

        return $this->snapshot;
    }

    public function health(): HealthReport
    {
        return $this->snapshot()->health;
    }

    public function capabilities(): array
    {
        return $this->capabilities->all();
    }
}
