<?php

namespace Shopceed\FormBuilder\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

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

        $this->comment('Database migration...');
        $this->callSilent('migrate');

        $this->comment('Seeding default data...');
        $this->callSilent('db:seed', ['--class' => 'Shopceed\\FormBuilder\\Seeds\\DefaultDatabaseSeeder']);

        $this->comment('Everything went according to plan...👍🏻');

        $this->comment('You can now visit /'.config('form-builder.path'));

        return true;
    }
}
