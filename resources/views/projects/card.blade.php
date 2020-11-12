<div class="cards flex flex-col" style="height: 200px;">
    <h3 class="font-normal text-xl mb-4 py-4 -ml-5 border-l-4 border-blue-400 pl-4">
        <a href="{{ $project->path() }}" class="text-black no-underline">{{ $project->title }}</a>
    </h3>
    <div class="text-grey mb-4 flex-1">{{ str_limit($project->description, 50) }}</div>
    <footer>
        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="text-right">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-xs">Delete</button>
        </form>
    </footer>
</div>
