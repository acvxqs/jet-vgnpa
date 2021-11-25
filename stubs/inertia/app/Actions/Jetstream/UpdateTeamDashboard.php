<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Acvxqs\JetVgnpa\Contracts\UpdatesTeamDashboard;

class UpdateTeamDashboard implements UpdatesTeamDashboard
{
    /**
     * Validate and update the given team's name.
     *
     * @param  mixed  $user
     * @param  mixed  $team
     * @param  array  $input
     * @return void
     */
    public function update($user, $team, array $input)
    {
        Gate::forUser($user)->authorize('update', $team);

        Validator::make($input, [
            'dashboard' => ['nullable', 'string', 'max:120000'],
        ])->validateWithBag('updateTeamDashboard');

        $team->forceFill([
            'dashboard' => $input['dashboard'],
        ])->save();
    }
}
