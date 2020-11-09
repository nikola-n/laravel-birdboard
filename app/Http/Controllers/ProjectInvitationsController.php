<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectInvitationRequest;
use App\User;
use App\Project;

class ProjectInvitationsController extends Controller
{

    /**
     * @param \App\Project                                $project
     * @param \App\Http\Requests\ProjectInvitationRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Project $project, ProjectInvitationRequest $request)
    {

        //$this->authorize('update', $project);
        //request()->validate([
        //    'email' => 'exists:users,email',
        //],
        //    [
        //        'email.exists' => 'The user you are inviting must have a birdboard account.',
        //    ]);

        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);

        return redirect($project->path());
    }
}
