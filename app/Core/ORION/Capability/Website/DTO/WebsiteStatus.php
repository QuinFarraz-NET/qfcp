<?php

namespace App\Core\ORION\Capability\Website\DTO;

final readonly class WebsiteStatus
{
    public function __construct(
        public string $url,
        public bool $online,
        public int $statusCode,
        public float $latency,
        public string $checkedAt,
    ) {
    }

    public function toArray(): array
    {
        return [
            'url' => $this->url,
            'online' => $this->online,
            'statusCode' => $this->statusCode,
            'latency' => $this->latency,
            'checkedAt' => $this->checkedAt,
        ];
    }
}
