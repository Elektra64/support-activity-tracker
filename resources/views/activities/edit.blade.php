<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">Edit Activity</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Edit Activity</h3>
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

                <form method="POST" action="{{ route('activities.update', $activity->id) }}" class="space-y-4" id="editForm">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title</label>
                        <input name="title" value="{{ old('title', $activity->title) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                        <textarea name="description" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description', $activity->description) }}</textarea>
                    </div>

                    <div class="flex justify-end gap-4 mt-6">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Update
                        </button>

                        <a href="{{ route('activities.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
