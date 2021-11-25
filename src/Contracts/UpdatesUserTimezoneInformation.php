<?php

namespace Acvxqs\JetVgnpa\Contracts;

interface UpdatesUserTimezoneInformation
{
    /**
     * Validate and update the given user's timezone information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input);
}
