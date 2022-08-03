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
    protected $signature = 'form-builder:install';

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
        $this->comment('Publishing Form Builder Assets...');
        $this->callSilent('vendor:publish', [
            '--tag' => 'form-builder-assets',
            '--force' => true,
        ]);

        $this->comment('Publishing Form Builder Config...');
        $this->callSilent('vendor:publish', [
            '--tag' => 'form-builder-config',
            '--force' => true,
        ]);
    }
}
