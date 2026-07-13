<?php

namespace App\Services\ServiceCenter\DTO;

class ServiceInfo
{
    public function __construct(

        public readonly string $name,

        public readonly string $displayName,

        public readonly bool $running,

        public readonly bool $enabled,

        public readonly int $pid = 0,

        public readonly string $description = '',

        public readonly string $activeState = '',

        public readonly string $subState = '',

        public readonly string $startedAt = '',

        public readonly ?float $memory = null,

        public readonly ?float $cpu = null,

    ) {
    }

    public function toArray(): array
    {
        return [

            'name' => $this->name,

            'displayName' => $this->displayName,

            'running' => $this->running,

            'enabled' => $this->enabled,

            'pid' => $this->pid,

            'description' => $this->description,

            'activeState' => $this->activeState,

            'subState' => $this->subState,

            'startedAt' => $this->startedAt,

            'memory' => $this->memory,

            'cpu' => $this->cpu,

        ];
    }
}
