<?php

namespace App\Core\ORION\Health;

use DateTimeImmutable;

final class HealthEngine
{
    public function evaluate(
        int $serviceHealth,
        array $reasons = []
    ): HealthReport {

        $grade = match (true) {
            $serviceHealth >= 95 => 'A',
            $serviceHealth >= 85 => 'B',
            $serviceHealth >= 70 => 'C',
            default => 'D',
        };

        $status = match ($grade) {
            'A' => 'Excellent',
            'B' => 'Healthy',
            'C' => 'Warning',
            default => 'Critical',
        };

        if (empty($reasons)) {

            $reasons[] = match ($grade) {
                'A' => 'All monitored services are operating normally.',
                'B' => 'Infrastructure is healthy.',
                'C' => 'Infrastructure requires attention.',
                default => 'Critical issues detected.',
            };

        }

        return new HealthReport(
            score: $serviceHealth,
            grade: $grade,
            status: $status,
            reasons: $reasons,
            generatedAt: new DateTimeImmutable(),
        );
    }
}
