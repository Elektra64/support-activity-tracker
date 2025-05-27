<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Activities Assigned to Me') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if($activities->isEmpty())
                <div class="bg-gray-800 p-6 rounded-lg">
                    <p class="text-gray-400">No activities assigned to you yet.</p>
                </div>
            @else
                @foreach($activities as $activity)
                    <div class="bg-gray-800 p-6 rounded-lg shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-semibold text-white">{{ $activity->title }}</h3>
                                <p class="text-gray-300 mt-2">{{ $activity->description }}</p>
                            </div>
                            <span class="text-sm text-gray-400">
                                Created {{ $activity->created_at->diffForHumans() }}
                            </span>
                        </div>
                        
                        <div class="mt-4 flex items-center gap-2">
                            <span class="text-sm text-gray-400">Created by:</span>
                            <span class="text-gray-300">{{ $activity->author->name }}</span>
                        </div>

                        <div class="mt-4 flex gap-4">
                            <a href="{{ route('updates.create', $activity) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-md text-white hover:bg-blue-700 transition">
                                Add Update
                            </a>
                            <a href="{{ route('activities.show', $activity) }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-700 rounded-md text-white hover:bg-gray-600 transition">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>