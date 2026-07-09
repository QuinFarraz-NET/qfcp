<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Services\Dashboard\DashboardService;

class HealthHeader extends Component
{
    public array $overview = [];

    public function mount(DashboardService $dashboard): void
    {
        $this->overview = $dashboard->overview();
    }

    public function render()
    {
        return view('livewire.dashboard.health-header', [
            'overview' => $this->overview,
        ]);
    }
}
