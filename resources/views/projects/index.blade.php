@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        {{--        if it didnt push it the width should be full area--}}
        <div class="flex justify-between items-end w-full">
            <h3 class="text-grey text-sm font-normal">My Projects</h3>
            <a href="/projects/create" class="button">Add Project</a>
        </div>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
            <div>No projects yet.</div>
        @endforelse
    </main>

@endsection
