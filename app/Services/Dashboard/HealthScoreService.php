<?php

namespace App\Services\Dashboard;

class HealthScoreService
{
    public function calculate(array $system, array $services = []): array
    {
        $score = 100;

        /*
        |--------------------------------------------------------------------------
        | CPU
        |--------------------------------------------------------------------------
        */

        if (($system['cpu']['usage'] ?? 0) > 90) {
            $score -= 25;
        } elseif (($system['cpu']['usage'] ?? 0) > 75) {
            $score -= 10;
        }

        /*
        |--------------------------------------------------------------------------
        | Memory
        |--------------------------------------------------------------------------
        */

        if (($system['memory']['usage'] ?? 0) > 90) {
            $score -= 25;
        } elseif (($system['memory']['usage'] ?? 0) > 75) {
            $score -= 10;
        }

        /*
        |--------------------------------------------------------------------------
        | Disk
        |--------------------------------------------------------------------------
        */

        if (($system['disk']['usage'] ?? 0) > 90) {
            $score -= 25;
        } elseif (($system['disk']['usage'] ?? 0) > 80) {
            $score -= 10;
        }

        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */

        if (!empty($services)) {

            foreach ($services as $service) {

                if (($service['running'] ?? false) === false) {

                    $score -= 10;

                }

            }

        }

        $score = max(0, min(100, $score));

        return [
            'score' => $score,
            'status' => $this->status($score),
        ];
    }

    protected function status(int $score): string
    {
        return match (true) {

            $score >= 90 => 'Healthy',

            $score >= 75 => 'Warning',

            default => 'Critical',

        };
    }
}
