<?php

namespace Acvxqs\JetVgnpa;

use Illuminate\Support\ServiceProvider;
use Acvxqs\JetVgnpa\Console\InstallCommand;
use Acvxqs\JetVgnpa\Contracts\UpdatesTeamDashboard;
use App\Actions\Jetstream\UpdateTeamDashboard;

class JetVgnpaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureCommands();
        $this->configurePublishing();

        $this->app->singleton(UpdatesTeamDashboard::class, UpdateTeamDashboard::class);
    }

    protected function configurePublishing()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            
            // Dashboard
            __DIR__.'/../stubs/inertia/resources/js/Jetstream/Textarea.vue' => resource_path('js/Jetstream/Textarea.vue'),

            __DIR__.'/../stubs/inertia/resources/js/Pages/Dashboard.vue' => resource_path('js/Pages/Dashboard.vue'),

            // Dashboard - migrations
            __DIR__.'/../database/migrations/2021_11_25_170417_add_dashboard_to_teams.php' => database_path('migrations/2021_11_25_170417_add_dashboard_to_teams.php'),

            __DIR__.'/../stubs/inertia/resources/js/Pages/Teams/Show.vue' => resource_path('js/Pages/Teams/Show.vue'),
            __DIR__.'/../stubs/inertia/resources/js/Pages/Teams/Partials/UpdateTeamDashboardForm.vue' => resource_path('js/Pages/Teams/Partials/UpdateTeamDashboardForm.vue'),

            // Logo
            __DIR__.'/../stubs/inertia/resources/js/Jetstream/ApplicationLogo.vue' => resource_path('js/Jetstream/ApplicationLogo.vue'),
            __DIR__.'/../stubs/inertia//resources/js/Jetstream/ApplicationMark.vue' => resource_path('js/Jetstream/ApplicationMark.vue'),
            __DIR__.'/../stubs/inertia/resources/js/Jetstream/AuthenticationCardLogo.vue' => resource_path('js/Jetstream/AuthenticationCardLogo.vue'),

            // Routes
            __DIR__.'/../stubs/inertia/routes/web.php' => base_path('routes/web.php'),

        ], 'jet-vgnpa-assets');
    }

    /**
     * Configure the commands offered by the application.
     *
     * @return void
     */
    protected function configureCommands()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            InstallCommand::class,
        ]);
    }
}
