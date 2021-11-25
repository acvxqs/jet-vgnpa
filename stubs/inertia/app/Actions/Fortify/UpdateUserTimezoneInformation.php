<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Contracts\UpdatesUserTimezoneInformation;

class UpdateUserTimezoneInformation implements UpdatesUserTimezoneInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'timezone' => ['required', 'string'],
        ])->validateWithBag('updateTimezoneInformation');

        $user->forceFill([
                'timezone' => $input['timezone'],
            ])->save();
    }
}
