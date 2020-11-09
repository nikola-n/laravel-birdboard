<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'owner_id')
            //->orderByDesc('updated_at');
            //    ->oldest('updated_at'); //asc
            ->latest('updated_at'); //desc
    }

    public function accessibleProjects()
    {
        //2.way
        return Project::where('owner_id', $this->id)
            ->orWhereHas('members', function ($query) {
                $query->where('user_id', $this->id);
            })
            ->get();

        //1. way
        //$projectsCreated = $this->projects;
        //
        //$ids = DB::table('project_members')->where('user_id', $this->id)
        //    ->pluck('project_id');
        //
        //$projectsSharedWith = Project::find($ids);
        //
        //return $projectsCreated->merge($projectsSharedWith);
    }

}
