<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Manage Users') }}
            </h2>
            <a href="{{ route('admin.users.tasks') }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Back to Admin Console
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-900 text-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Users Table -->
            <div class="bg-gray-800 rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-6 border-b border-gray-600 pb-2">
                    User List
                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700 uppercase text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-base font-bold">Name</th>
                                <th class="px-6 py-3 text-left text-base font-bold">Email</th>
                                <th class="px-6 py-3 text-left text-base font-bold">Role</th>
                                <th class="px-6 py-3 text-left text-base font-bold">Actions</th>
                                <th class="px-6 py-3 text-left text-base font-bold">Assign Activity</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-600">
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 text-base font-semibold">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-base font-semibold">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $user->is_admin ? 'bg-blue-600' : 'bg-gray-500' }}">
                                            {{ $user->is_admin ? 'Admin' : 'User' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            @if(!$user->is_admin)
                                                <form action="{{ route('admin.users.promote', $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm font-semibold transition">
                                                        Promote
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.users.demote', $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded text-sm font-semibold transition">
                                                        Demote
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm font-semibold transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4"> 
                                        <form action="{{ route('admin.users.assignActivity', $user->id) }}" method="POST" class="flex items-center">
                                            @csrf
                                            <select name="activity_id" class="bg-gray-800 text-white rounded px-2 py-1 text-sm font-semibold border border-gray-700">
                                                @foreach($activities as $activity)
                                                    <option value="{{ $activity->id }}" class="font-semibold bg-gray-800 text-white">{{ $activity->title }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded text-sm font-semibold transition ml-2">
                                                Assign
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
