<?php

namespace App\Core\ORION\Capability;

final readonly class Capability
{
    public function __construct(
        public string $name,
        public string $version,
        public bool $enabled,
        public bool $healthy,
        public string $description,
    ) {
    }

    public function toArray(): array
    {
        return [

            'name' => $this->name,

            'version' => $this->version,

            'enabled' => $this->enabled,

            'healthy' => $this->healthy,

            'description' => $this->description,

        ];
    }
}
