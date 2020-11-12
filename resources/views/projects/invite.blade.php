<div class="cards flex flex-col mt-3">
    <h3 class="font-normal text-xl mb-4 py-4 -ml-5 border-l-4 border-blue-400 pl-4">
        Invite a user
    </h3>
    <div class="text-grey mb-4 flex-1">{{ str_limit($project->description, 50) }}</div>
    <form action="{{ $project->path(). '/invitations' }}" method="POST" class="text-right">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" class="border border-grey rounded w-full py-2 px-3" placeholder="Email address">
        </div>
        <button type="submit" class="button">Invite</button>
    </form>
    @include('projects.errors', ['bag' => 'invitations'])
</div>
