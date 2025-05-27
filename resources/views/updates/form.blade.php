<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Update Activity</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Add Update</h3>
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

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('updates.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Select Activity</label>
                        <select name="activity_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach ($activities as $activity)
                                <option value="{{ $activity->id }}">{{ $activity->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                        <select name="status" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="pending">Pending</option>
                            <option value="done">Done</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Remark</label>
                        <textarea name="remark" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="submit" 
                            class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            Submit Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
