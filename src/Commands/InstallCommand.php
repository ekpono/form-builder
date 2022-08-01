<?php

namespace Shopceed\FormBuilder\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email-builder:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment('Publishing Ramaroo Assets...');
        $this->callSilent('vendor:publish', [
            '--tag' => 'ramaroo-assets',
            '--force' => true,
        ]);

        $this->comment('Publishing Ramaroo Config...');
        $this->callSilent('vendor:publish', [
            '--tag' => 'ramaroo-config',
            '--force' => true,
        ]);
    }
}
