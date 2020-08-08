<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    public function index(Project $projects)
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function store()
    {
       $attributes = request()->validate([
            'title'       => 'required',
            'description' => 'required',
        ]);

        Project::create($attributes);

        return redirect()->route('projects.index');
    }
}
