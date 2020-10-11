@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-grey text-sm font-normal">
                <a href="/projects" class="text-grey text-sm font-normal no-underline">My Projects</a> / {{ $project->title }}
            </p>

            <a href="/projects/create" class="button">Add Project</a>
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

                    <textarea class="cards w-full" style="min-height: 200px;">Lorem ipsum.</textarea>
                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>
@endsection
