<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Activities</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Add New Activity Form --}}
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Add New Activity</h3>
                </div>

                @if ($errors->any())
                    <div class="mb-4 text-red-600 bg-red-100 border border-red-300 rounded p-4">
                        <ul class="list-disc pl-5 space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('activities.store') }}" class="space-y-4" id="activityForm">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title</label>
                        <input name="title" type="text" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                        <textarea name="description" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="submit"
                            class="px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700 transition">
                            ➕ Add Activity
                        </button>
                    </div>
                </form>
            </div>

            {{-- All Activities List --}}
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">All Activities</h3>
                <ul class="divide-y divide-gray-200 dark:divide-gray-600">
                    @forelse ($activities as $activity)
                        <li class="py-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-lg text-gray-800 dark:text-gray-100">{{ $activity->title }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $activity->description }}</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('activities.edit', $activity->id) }}"
                                        class="px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('activities.destroy', $activity->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this activity?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="py-4 text-gray-500 dark:text-gray-400">No activities found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
