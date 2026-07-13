<?php

namespace App\Core\ORION\Health;

use DateTimeImmutable;

final readonly class HealthReport
{
    public function __construct(
        public int $score,
        public string $grade,
        public string $status,
        public array $reasons,
        public DateTimeImmutable $generatedAt,
    ) {
    }

    public function toArray(): array
    {
        return [
            'score' => $this->score,
            'grade' => $this->grade,
            'status' => $this->status,
            'reasons' => $this->reasons,
            'generatedAt' => $this->generatedAt->format('Y-m-d H:i:s'),
        ];
    }
}
