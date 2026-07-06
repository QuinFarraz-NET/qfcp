<?php

namespace App\Services\Dashboard;

class HealthScoreService
{
    public function calculate(array $system): array
    {
        $score = 100;

        if (
            isset($system['memory']['used'], $system['memory']['total']) &&
            $system['memory']['total'] > 0 &&
            ($system['memory']['used'] / $system['memory']['total']) > 0.80
        ) {
            $score -= 15;
        }

        if (
            isset($system['disk']['used'], $system['disk']['total']) &&
            $system['disk']['total'] > 0 &&
            ($system['disk']['used'] / $system['disk']['total']) > 0.85
        ) {
            $score -= 20;
        }

        return [
            'score' => max(0, $score),
            'status' => match (true) {
                $score >= 90 => 'Healthy',
                $score >= 70 => 'Warning',
                default => 'Critical',
            },
        ];
    }
}
