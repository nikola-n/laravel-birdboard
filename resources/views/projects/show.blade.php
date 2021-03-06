@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-6 pb-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-muted font-light">
                <a href="/projects" class="text-muted no-underline hover:underline">My Projects</a> / {{ $project->title }}
            </p>

            <div class="flex items-center">
                @foreach($project->members as $member)
                    <img src="{{ gravatar_url($member->email) }}" class="rounded-full w-8 mr-2" alt="{{ $member->name }}'s avatar">
                @endforeach
                <img src="{{ gravatar_url($project->owner->email) }}" class="rounded-full w-8 mr-2" alt="{{ $project->owner->name }}'s avatar">

                <a href="{{ $project->path() . '/edit' }}" class="button ml-4">Edit Project</a>
            </div>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-muted font-light mb-3">Tasks</h2> @foreach($project->tasks as $task)
                        <div class="cards mb-3">
                            <form method="POST" action="{{ $project->path() . '/tasks/' . $task->id }}">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                    <input name="body" value="{{ $task->body }}" class="text-default bg-cards w-full {{ $task->completed ? 'line-through text-muted' : '' }}">
                                    <input name="completed" type="checkbox" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}/>
                                </div>
                            </form>

                        </div>
                    @endforeach
                    <div class="cards mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input placeholder="Add a new task..." class="text-default bg-cards w-full" name="body">
                        </form>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg text-muted font-light mb-3">General Notes</h2>
                    <form method="POST" action="{{ $project->path() }}">
                        @method('PATCH')
                        @csrf
                        <textarea
                            class="cards text-default w-full mb-4"
                            style="min-height: 200px;"
                            name="notes"
                            placeholder="Anything special that you want to share?"
                        >{{ $project->notes }}
                        </textarea>

                        <button type="submit" class="button">Submit</button>
                    </form>
                    @include('projects.errors')

                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
                @include('projects.activity.card')
                @can('manage', $project)
                    @include('projects.invite')
                @endcan

            </div>

        </div>
    </main>
@endsection
