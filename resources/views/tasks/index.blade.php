<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Your Tasks</h2>
    </x-slot>

    <div class="mt-4">
        <form method="POST" action="{{ route('tasks.store') }}" class="flex gap-2">
            @csrf
            <input type="text" name="title" placeholder="New Task" class="border p-2 w-full" required>
            <button class="bg-blue-600 text-white px-4 py-2">Add</button>
        </form>
    </div>

    <ul class="mt-6 space-y-2">
        @foreach($tasks as $task)
            <li class="bg-white p-4 rounded shadow flex justify-between items-center">
                <div>
                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                        @csrf @method('PUT')
                        <button class="text-left {{ $task->completed ? 'line-through text-gray-500' : '' }}">
                            {{ $task->title }}
                        </button>
                    </form>
                </div>
                <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                    @csrf @method('DELETE')
                    <button class="text-red-600 hover:underline">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-app-layout>