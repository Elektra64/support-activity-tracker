<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                Dashboard
            </h2>
            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.users.tasks') }}"
                   class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Admin Console
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Message -->
            <div class="bg-gray-800 shadow-sm sm:rounded-lg p-6 text-white">
                <p class="text-lg">Welcome back, you're logged in!</p>
                <p class="text-sm text-gray-300 mt-1">Use the quick links below to manage your activities.</p>
            </div>

            <!-- Quick Links -->
            <div class="bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Quick Links</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('activities.index') }}"
                           class="block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            ➤ Manage Activities
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('updates.index') }}"
                           class="block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                            ➤ Add Activity Update
                        </a>
                    </li>
                    @if(auth()->user()->is_admin)
                        <li>
                            <a href="{{ route('reports.index') }}"
                               class="block px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                                ➤ View Reports
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('activities.assigned') }}"
                               class="block px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                                ➤ Activities Assigned to Me
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
