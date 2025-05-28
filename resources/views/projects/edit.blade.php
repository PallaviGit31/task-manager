<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Edit Project</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-6 bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('projects.update', $project) }}">
            @csrf
            @method('PUT')

            <!-- Project Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Project Name</label>
                <input type="text" name="name" id="name" required
                       class="mt-1 block w-full border border-gray-300 rounded p-2"
                       value="{{ old('name', $project->name) }}">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Project Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="mt-1 block w-full border border-gray-300 rounded p-2">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-between">
                <a href="{{ route('projects') }}"
                   class="text-gray-600 hover:text-gray-900 underline">← Cancel</a>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Update Project
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
