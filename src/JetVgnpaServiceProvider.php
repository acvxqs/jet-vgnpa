<?php

namespace Acvxqs\JetVgnpa;

use Acvxqs\JetVgnpa\Console\InstallCommand;
use Acvxqs\JetVgnpa\Contracts\UpdatesTeamDashboard;
use Acvxqs\JetVgnpa\Contracts\UpdatesUserContactInformation;
use Acvxqs\JetVgnpa\Contracts\UpdatesUserTimezoneInformation;
use App\Actions\Fortify\UpdateUserContactInformation;
use App\Actions\Fortify\UpdateUserTimezoneInformation;
use App\Actions\Jetstream\UpdateTeamDashboard;
use Illuminate\Support\ServiceProvider;

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
        $this->app->singleton(UpdatesUserTimezoneInformation::class, UpdateUserTimezoneInformation::class);
        $this->app->singleton(UpdatesUserContactInformation::class, UpdateUserContactInformation::class);

    }

    protected function configurePublishing()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            
            // Jetstream components
            __DIR__.'/../stubs/inertia/resources/js/Jetstream/Textarea.vue' => resource_path('js/Jetstream/Textarea.vue'),
            __DIR__.'/../stubs/inertia/resources/js/Jetstream/Timezone.vue' => resource_path('js/Jetstream/Timezone.vue'),

            // Jetstream components - logo
            __DIR__.'/../stubs/inertia/resources/js/Jetstream/ApplicationLogo.vue' => resource_path('js/Jetstream/ApplicationLogo.vue'),
            __DIR__.'/../stubs/inertia//resources/js/Jetstream/ApplicationMark.vue' => resource_path('js/Jetstream/ApplicationMark.vue'),
            __DIR__.'/../stubs/inertia/resources/js/Jetstream/AuthenticationCardLogo.vue' => resource_path('js/Jetstream/AuthenticationCardLogo.vue'),

            // Pages
            __DIR__.'/../stubs/inertia/resources/js/Pages/Dashboard.vue' => resource_path('js/Pages/Dashboard.vue'),

            // Pages - Profile
            __DIR__.'/../stubs/inertia/resources/js/Pages/Profile/Show.vue' => resource_path('js/Pages/Profile/Show.vue'),

            // Pages - Profile Partials
            __DIR__.'/../stubs/inertia/resources/js/Pages/Profile/Partials/UpdateProfileTimezoneForm.vue' => resource_path('js/Pages/Profile/Partials/UpdateProfileTimezoneForm.vue'),
            __DIR__.'/../stubs/inertia/resources/js/Pages/Profile/Partials/UpdateProfileContactForm.vue' => resource_path('js/Pages/Profile/Partials/UpdateProfileContactForm.vue'),

            // Pages - Teams
            __DIR__.'/../stubs/inertia/resources/js/Pages/Teams/Show.vue' => resource_path('js/Pages/Teams/Show.vue'),

            // Pages - Teams Partials
            __DIR__.'/../stubs/inertia/resources/js/Pages/Teams/Partials/UpdateTeamDashboardForm.vue' => resource_path('js/Pages/Teams/Partials/UpdateTeamDashboardForm.vue'),

            //  Migrations
            __DIR__.'/../database/migrations/2021_11_25_170417_add_dashboard_to_teams.php' => database_path('migrations/2021_11_25_170417_add_dashboard_to_teams.php'),
            __DIR__.'/../database/migrations/2021_11_25_182418_add_timezone_to_users.php' => database_path('migrations/2021_11_25_182418_add_timezone_to_users.php'),            
            __DIR__.'/../database/migrations/2021_11_26_133506_add_phone_and_tg_username_to_users.php' => database_path('migrations/2021_11_26_133506_add_phone_and_tg_username_to_users.php'),  

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
