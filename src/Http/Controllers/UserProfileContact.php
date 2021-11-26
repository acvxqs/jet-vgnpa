<?php

namespace Acvxqs\JetVgnpa\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Acvxqs\JetVgnpa\Contracts\UpdatesUserContactInformation;

class UserProfileContact extends Controller
{
    /**
     * Update the user's profile timezone.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\UpdatesUserContactInformation  $updater
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,
                           UpdatesUserContactInformation $updater)
    {
        $updater->update($request->user(), $request->all());

        return $request->wantsJson()
                    ? new JsonResponse('', 200)
                    : back()->with('status', 'profile-timezone-updated');
    }
}
