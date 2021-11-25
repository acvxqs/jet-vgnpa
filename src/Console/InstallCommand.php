<?php

namespace Acvxqs\JetVgnpa\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jet-vgnpa:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install VGNPA for Jetstream Inertia';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Publish...
        $this->callSilent('vendor:publish', ['--tag' => 'jet-vgnpa-assets', '--force' => true]);

        (new Filesystem)->ensureDirectoryExists(app_path('Actions/Jetstream'));
        (new Filesystem)->ensureDirectoryExists(app_path('Models'));

        // Actions...
        copy(__DIR__.'/../../stubs/app/Actions/Jetstream/UpdateTeamDashboard.php', app_path('Actions/Jetstream/UpdateTeamDashboard.php'));
        
        // Models...
        copy(__DIR__.'/../../stubs/app/Models/Team.php', app_path('Models/Team.php'));

        (new Process(['php', 'artisan', 'view:clear'], base_path()))
                ->setTimeout(null)
                ->run(function ($type, $output) {
                    $this->output->write($output);
                });

        $this->info('VGNPA for Jetstream Inertia installed successfully.');
        $this->comment('Please execute "npm install && npm run dev" to build your assets.');
    }
}
