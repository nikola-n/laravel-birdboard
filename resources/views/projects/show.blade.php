@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-grey text-sm font-normal">
                <a href="/projects" class="text-grey text-sm font-normal no-underline">My Projects</a> / {{ $project->title }}
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
                    <h2 class="text-gray-400 text-lg font-normal mb-3">Tasks</h2>
                    @foreach($project->tasks as $task)
                        <div class="cards mb-3">
                            <form method="POST" action="{{ $project->path() . '/tasks/' . $task->id }}">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                    <input name="body" class="w-full {{ $task->completed ? 'text-grey' : '' }}" value="{{ $task->body }}" />
                                    <input name="completed" type="checkbox" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}/>
                                </div>
                            </form>

                        </div>
                    @endforeach
                    <div class="cards mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input class="w-full" placeholder="Add a new task..." name="body" />
                        </form>
                    </div>
                </div>
                <div>
                    <h2 class="text-gray-400 text-lg font-normal mb-3">General Notes</h2>
                    <form method="POST" action="{{ $project->path() }}">
                        @method('PATCH')
                        @csrf
                        <textarea
                            class="cards w-full mb-4"
                            style="min-height: 200px;"
                            name="notes"
                            placeholder="Anything special that you want to share?"
                        >{{ $project->notes }}
                        </textarea>

                        <button type="submit" class="button">Submit</button>
                    </form>
                    @if ($errors->any())
                        <div class="field mt-6">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm text-red">{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
                @include('projects.activity.card')
            </div>

        </div>
    </main>
@endsection
