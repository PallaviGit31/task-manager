<x-app-layout>
    <x-slot name="header">
        <h2>{{ $project->name }}</h2>
    </x-slot>

    <p>{{ $project->description }}</p>

    <form method="POST" action="{{ route('projects.tasks.store', $project) }}" class="mt-4">
        @csrf
        <input name="title" placeholder="Task title" class="border p-2" required>
        <textarea name="description" id="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded p-2">{{ old('description') }}</textarea>
        @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <button class="bg-blue-500 text-white px-4 py-2">Add Task</button>
    </form>

    <ul class="mt-4">
        @foreach ($project->tasks as $task)
            <li class="flex justify-between items-center mt-2">
                <form method="POST" action="{{ route('projects.tasks.update', [$project, $task]) }}" style="position: absolute;width: 50%;">
                    @csrf @method('PUT')
                    <button class="{{ $task->status ? 'line-through' : '' }}">{{ $task->title }} ....  {{ $task->description }}</button>
                </form>
                <form method="POST" action="{{ route('projects.tasks.destroy', [$project, $task]) }}" style="right: 2%;position: absolute;">
                    @csrf @method('DELETE')
                    <button class="text-red-500">Delete</button>
                </form>
            </li>
            <br>
        @endforeach
    </ul>
</x-app-layout>
