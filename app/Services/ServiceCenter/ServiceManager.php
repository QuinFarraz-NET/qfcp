<?php

namespace App\Services\ServiceCenter;

use App\Services\ServiceCenter\Drivers\LinuxSystemdDriver;
use App\Services\ServiceCenter\DTO\ServiceInfo;

class ServiceManager
{
    public function __construct(
        protected LinuxSystemdDriver $driver,
    ) {
    }

    public function services(): array
    {
        $items = [];

        foreach ($this->driver->services() as $service) {

            $items[] = new ServiceInfo(

                name: $service['name'],

                displayName: $service['displayName'],

                running: $service['running'],

                enabled: $service['enabled'],

                pid: $service['pid'],

                description: $service['description'],

                activeState: $service['activeState'],

                subState: $service['subState'],

                startedAt: $service['startedAt'],

                memory: null,

                cpu: null,

            );

        }

        return $items;
    }

    public function healthy(): int
    {
        $total = count($this->services());

        if ($total === 0) {
            return 100;
        }

        $running = collect($this->services())
            ->where('running', true)
            ->count();

        return (int) round(($running / $total) * 100);
    }

    public function critical(): array
    {
        return collect($this->services())
            ->where('running', false)
            ->values()
            ->all();
    }
}
