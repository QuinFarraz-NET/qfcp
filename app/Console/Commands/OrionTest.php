<?php

namespace App\Console\Commands;

use App\Core\ORION\Runtime\Runtime;
use Illuminate\Console\Command;

class OrionTest extends Command
{
    protected $signature = 'orion:test';

    protected $description = 'Run ORION Runtime diagnostics';

    public function handle(Runtime $runtime): int
    {
        $health = $runtime->health();

        $this->line('');
        $this->info('==============================');
        $this->info('      ORION Runtime');
        $this->info('==============================');
        $this->line('');

        $this->table(
            ['Property', 'Value'],
            [
                ['Version', $runtime->version()],
                ['Status', $runtime->status()],
                ['Health Score', $health->score],
                ['Grade', $health->grade],
                ['Health Status', $health->status],
            ]
        );

        $this->line('');
        $this->info('Reasons');

        foreach ($health->reasons as $reason) {
            $this->line("✓ {$reason}");
        }

        $this->line('');
        $this->info('Capabilities');
        $this->line('');

        $this->table(
            ['Module', 'Version', 'Enabled', 'Healthy'],
            array_map(
                fn ($capability) => [
                    $capability->name,
                    $capability->version,
                    $capability->enabled ? 'YES' : 'NO',
                    $capability->healthy ? 'YES' : 'NO',
                ],
                $runtime->capabilities()
            )
        );

        return self::SUCCESS;
    }
}
