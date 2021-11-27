<?php

namespace Acvxqs\JetVgnpa\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Laravel\Jetstream\Jetstream;

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
    protected $description = 'Install VGNPA for Jetstream Inertia (with teams enabled!)';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (config('jetstream:stack') !== 'inertia') {
            return $this->info('Sorry, but this package can only be installed on top of jetstream inertia stack.');
        }
        if (Jetstream::hasTeamFeatures() === false) {
            return $this->info('Sorry, but this package is built for Jetstream Inertia with teams enabled.');
        }

        // Publish...
        $this->callSilent('vendor:publish', ['--tag' => 'jet-vgnpa-assets', '--force' => true]);

        (new Filesystem)->ensureDirectoryExists(app_path('Actions/Fortify'));
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/Jetstream'));
        (new Filesystem)->ensureDirectoryExists(app_path('Models'));

        // Actions...
        copy(__DIR__.'/../../stubs/inertia/app/Actions/Fortify/UpdateUserTimezoneInformation.php', app_path('Actions/Fortify/UpdateUserTimezoneInformation.php'));
        copy(__DIR__.'/../../stubs/inertia/app/Actions/Fortify/UpdateUserContactInformation.php', app_path('Actions/Fortify/UpdateUserContactInformation.php'));
        copy(__DIR__.'/../../stubs/inertia/app/Actions/Jetstream/UpdateTeamDashboard.php', app_path('Actions/Jetstream/UpdateTeamDashboard.php'));
        
        // Models...
        copy(__DIR__.'/../../stubs/inertia/app/Models/Team.php', app_path('Models/Team.php'));
        copy(__DIR__.'/../../stubs/inertia/app/Models/User.php', app_path('Models/User.php'));

        (new Process(['php', 'artisan', 'view:clear'], base_path()))
                ->setTimeout(null)
                ->run(function ($type, $output) {
                    $this->output->write($output);
                });

        $this->info('VGNPA for Jetstream Inertia installed successfully.');
        $this->comment('Please execute "npm install && npm run dev" to build your assets.');
    }
}
