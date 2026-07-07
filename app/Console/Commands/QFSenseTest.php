<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Core\QFSense\TelemetryService;

class QFSenseTest extends Command
{
    protected $signature = 'qfsense:test';

    protected $description = 'Test QFSense Telemetry Engine';

    public function handle(TelemetryService $telemetry): int
    {
        $start = microtime(true);

        $snapshot = $telemetry->snapshot();

        $elapsed = round(
            (microtime(true) - $start) * 1000,
            2
        );

        $this->newLine();

        $this->info('==============================');
        $this->info('      QFSense Diagnostics');
        $this->info('==============================');

        $this->newLine();

        $this->line('CPU');
        dump($snapshot->cpu);

        $this->line('Memory');
        dump($snapshot->memory);

        $this->line('Disk');
        dump($snapshot->disk);

        $this->line('Network');
        dump($snapshot->network);

        $this->line('Uptime');
        dump($snapshot->uptime);

        $this->newLine();

        $this->info("Execution : {$elapsed} ms");

        return self::SUCCESS;
    }
}
