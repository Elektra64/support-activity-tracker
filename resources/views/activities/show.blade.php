<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ $activity->title }}
            </h2>
            <a href="{{ url()->previous() }}" 
               class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Activity Details -->
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-gray-200 space-y-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-300">Description</h3>
                            <p class="mt-1">{{ $activity->description }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-medium text-gray-300">Created By</h3>
                            <p class="mt-1">{{ $activity->author->name }}</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-300">Assigned Users</h3>
                            <ul class="mt-1 list-disc list-inside">
                                @foreach($activity->assignedUsers as $user)
                                    <li>{{ $user->name }} ({{ $user->department }})</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('updates.create', $activity) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-md text-white hover:bg-blue-700 transition">
                            Add Update
                        </a>
                    </div>
                </div>
            </div>

            <!-- Updates -->
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-300 mb-4">Activity Updates</h3>
                    
                    @if($updates->isEmpty())
                        <p class="text-gray-400">No updates yet.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($updates as $update)
                                <div class="bg-gray-700 p-4 rounded-lg">
                                    <div class="flex justify-between">
                                        <span class="text-gray-300">{{ $update->user->name }}</span>
                                        <span class="text-gray-400">{{ $update->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="mt-2">
                                        <p class="text-gray-200">{{ $update->remarks }}</p>
                                    </div>
                                    <div class="mt-2">
                                        <span class="px-2 py-1 text-sm rounded {{ $update->status === 'Pending' ? 'bg-yellow-600' : 'bg-green-600' }}">
                                            {{ $update->status }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>