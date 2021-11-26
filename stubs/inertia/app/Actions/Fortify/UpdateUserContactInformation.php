<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Acvxqs\JetVgnpa\Contracts\UpdatesUserContactInformation;

class UpdateUserContactInformation implements UpdatesUserContactInformation
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
            'phone' => ['string', 'nullable'],
            'tg_username' => ['string', 'nullable'],
        ])->validateWithBag('updateContactInformation');

        $user->forceFill([
                'phone' => $input['phone'],
                'tg_username' => $input['tg_username'],
            ])->save();
    }
}
