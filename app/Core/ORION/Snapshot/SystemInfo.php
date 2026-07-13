<?php

namespace App\Core\ORION\Snapshot;

final readonly class SystemInfo
{
    public function __construct(
        public string $hostname,
        public string $os,
        public string $php,
        public string $laravel,
    ) {
    }

    public function toArray(): array
    {
        return [
            'hostname' => $this->hostname,
            'os' => $this->os,
            'php' => $this->php,
            'laravel' => $this->laravel,
        ];
    }
}
