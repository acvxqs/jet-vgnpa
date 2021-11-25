<?php

namespace Acvxqs\JetVgnpa\Contracts;

interface UpdatesTeamDashboard
{
    /**
     * Validate and update the given team's dashboard.
     *
     * @param  mixed  $user
     * @param  mixed  $team
     * @param  array  $input
     * @return void
     */
    public function update($user, $team, array $input);
}
