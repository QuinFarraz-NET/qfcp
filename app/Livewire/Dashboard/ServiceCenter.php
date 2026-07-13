<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Services\ServiceCenter\ServiceManager;

class ServiceCenter extends Component
{
    public function render(ServiceManager $manager)
    {
        return view('livewire.dashboard.service-center', [
            'services' => $manager->services(),
        ]);
    }
}

