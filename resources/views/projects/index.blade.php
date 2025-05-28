<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">My Projects</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto mt-6 space-y-4">

        <!-- Create New Project Button -->
        <div class="text-right">
            <a href="{{ route('projects.create') }}"
               class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">
                + New Project
            </a>
        </div>

        <!-- Projects List -->
        <div class="grid md:grid-cols-2 gap-4">
            @forelse ($projects as $project)
                <div class="bg-white p-4 rounded shadow hover:shadow-md transition">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $project->name }}</h3>
                    <p class="text-gray-600 text-sm">{{ Str::limit($project->description, 100) }}</p>
                    <p class="text-gray-600 text-sm">
                        {{ $project->completedTaskCount() }} / {{ $project->taskCount() }} tasks completed
                    <span class="ml-2 text-green-600 font-semibold">
                        ({{ $project->completionPercentage() }}%)
                    </span></p>

                    <div class="mt-4 flex justify-between items-center text-sm">
                        <a href="{{ route('projects.show', $project) }}" class="text-blue-500 hover:underline">
                            View
                        </a>
                        <div class="flex gap-2">
                            <a href="{{ route('projects.edit', $project) }}" class="text-yellow-600 hover:underline">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('projects.destroy', $project) }}"
                                  onsubmit="return confirm('Delete this project?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">You have no projects yet. Click "New Project" to start one!</p>
            @endforelse
        </div>

    </div>
</x-app-layout>