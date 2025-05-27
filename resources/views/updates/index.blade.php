<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Activity Updates</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            {{-- Add Update Section --}}
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Activity Updates</h3>
                    <a href="{{ route('updates.create') }}" 
                       class="px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700 transition">
                        ➕ Add Update
                    </a>
                </div>

               

                @if ($updates->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase">
                                <tr>
                                    <th class="px-6 py-3 text-gray-700 dark:text-gray-200">Activity</th>
                                    <th class="px-6 py-3 text-gray-700 dark:text-gray-200">Status</th>
                                    <th class="px-6 py-3 text-gray-700 dark:text-gray-200">Remark</th>
                                    <th class="px-6 py-3 text-gray-700 dark:text-gray-200">By</th>
                                    <th class="px-6 py-3 text-gray-700 dark:text-gray-200">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                @foreach ($updates as $update)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                        <td class="px-6 py-4 font-medium text-gray-800 dark:text-gray-200">
                                            {{ $update->activity->title }}
                                        </td>
                                        <td class="px-6 py-4 capitalize font-semibold {{ $update->status === 'done' ? 'text-blue-700' : 'text-yellow-600' }}">
                                            {{ $update->status }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $update->remark }}</td>
                                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $update->bio_snapshot ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $update->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="py-4 text-gray-500 dark:text-gray-400">No updates found.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
