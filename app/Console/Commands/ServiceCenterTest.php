<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:service-center-test')]
#[Description('Command description')]
class ServiceCenterTest extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
