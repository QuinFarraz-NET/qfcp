<?php

namespace App\Core\ORION\Capability;

final class CapabilityRegistry
{
    /**
     * @return Capability[]
     */
    public function all(): array
    {
        return [

            new Capability(
                name: 'Telemetry',
                version: '1.0',
                enabled: true,
                healthy: true,
                description: 'QFSense Telemetry Engine',
            ),

            new Capability(
                name: 'Service Center',
                version: '1.0',
                enabled: true,
                healthy: true,
                description: 'Linux System Service Monitoring',
            ),

            new Capability(
                name: 'VPN',
                version: '0.1',
                enabled: false,
                healthy: false,
                description: 'WireGuard Management Module',
            ),

new Capability(
    name: 'Website',
    version: '1.0',
    enabled: true,
    healthy: true,
    description: 'Website Monitoring Module',
),


            new Capability(
                name: 'Database',
                version: '0.1',
                enabled: false,
                healthy: false,
                description: 'Database Monitoring Module',
            ),

        ];
    }

    public function toArray(): array
    {
        return array_map(
            fn (Capability $capability) => $capability->toArray(),
            $this->all()
        );
    }
}
