<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Admin Console') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('admin.users') }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Manage Users
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Search and Filter Section -->
            <div class="bg-gray-800 shadow sm:rounded-lg p-6">
                <form action="{{ route('admin.users.tasks') }}" method="GET" class="flex flex-wrap gap-4">
                    <!-- Search Input -->
                    <div class="flex-1">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Search activities, users..."
                               class="w-full rounded-md bg-gray-800 border-gray-600 
                                      text-white placeholder-gray-400 
                                      focus:border-blue-500 focus:ring-blue-500
                                      focus:ring-opacity-50 focus:ring-2">
                    </div>

                    <!-- Department Dropdown -->
                    <div>
                        <select name="department" 
                                class="rounded-md bg-gray-800 border-gray-600 
                                       text-white focus:border-blue-500 
                                       focus:ring-blue-500 focus:ring-opacity-50 focus:ring-2">
                            <option value="" class="bg-gray-800 text-white">All Departments</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept }}" 
                                        {{ request('department') == $dept ? 'selected' : '' }}
                                        class="bg-gray-800 text-white">
                                    {{ $dept }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Button -->
                    <button type="submit" 
                            class="px-4 py-2 bg-gray-700 text-white rounded 
                                   hover:bg-gray-600 border border-gray-600 
                                   transition duration-150 ease-in-out
                                   focus:ring-2 focus:ring-blue-500 
                                   focus:ring-opacity-50">
                        Filter
                    </button>
                </form>
            </div>

            <!-- Activities Table -->
            <div class="bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-700 text-white uppercase">
                            <tr>
                                <th class="px-6 py-3 cursor-pointer hover:bg-gray-600">
                                    <div class="flex items-center space-x-1">
                                        <span>Activity Title</span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </div>
                                </th>
                                <th class="px-6 py-3">Created By</th>
                                <th class="px-6 py-3">Description</th>
                                <th class="px-6 py-3">Assigned Users</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-600">
                            @forelse($activities as $activity)
                                <tr class="bg-gray-800 hover:bg-gray-700 transition">
                                    <td class="px-6 py-4 text-white font-medium">{{ $activity->title }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-white">{{ $activity->author->name }}</span>
                                            <span class="text-gray-400 text-xs">{{ $activity->author->department }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-white">
                                        {{ Str::limit($activity->description, 100) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col space-y-1">
                                            @forelse($activity->assignedUsers as $user)
                                                <div class="flex items-center space-x-2">
                                                    <span class="w-2 h-2 rounded-full {{ $user->department === 'Technical Support' ? 'bg-blue-400' : 'bg-green-400' }}"></span>
                                                    <span class="text-white">{{ $user->name }}</span>
                                                    <span class="text-gray-400 text-xs">({{ $user->department }})</span>
                                                </div>
                                            @empty
                                                <span class="text-gray-400">No users assigned</span>
                                            @endforelse
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-400">
                                        No activities found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $activities->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
