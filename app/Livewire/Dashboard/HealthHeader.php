<?php

namespace App\Livewire\Dashboard;

use App\Core\ORION\Runtime\Runtime;
use Livewire\Component;

class HealthHeader extends Component
{
    public array $overview = [];

    public function mount(Runtime $runtime): void
    {
        $snapshot = $runtime->snapshot();

        $health = $runtime->health();

        $this->overview = [

            'health' => [

                'score' => $health->score,

                'status' => $health->status,

                'grade' => $health->grade,

            ],

            /*
             |--------------------------------------------------------
             | Temporary Adapter
             |
             | Sampai M1 selesai kita masih mengambil data system
             | dari InfrastructureSnapshot.
             |
             */

            'system' => $snapshot->telemetry['system'] ?? [

                'hostname' => php_uname('n'),

                'os' => php_uname(),

                'php' => PHP_VERSION,

                'laravel' => app()->version(),

            ],

        ];
    }

    public function render()
    {
        return view('livewire.dashboard.health-header', [

            'overview' => $this->overview,

        ]);
    }
}
