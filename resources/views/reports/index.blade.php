<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Reports</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-gray-800 p-6 shadow sm:rounded-lg">
                @if ($errors->any())
                    <div class="mb-4 text-red-400">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="GET" action="{{ route('reports.index') }}" class="flex flex-wrap gap-4 items-end">
                    <div>
                        <label class="block text-base font-medium text-gray-300">From</label>
                        <input type="date" 
                               name="from" 
                               value="{{ request('from') }}" 
                               class="mt-1 block w-full rounded-md border-gray-600 bg-gray-900 
                                      text-black text-base focus:border-blue-500 
                                      focus:ring-blue-500 focus:ring-opacity-50 focus:ring-2
                                      [color-scheme:dark]" 
                               max="{{ date('Y-m-d') }}" 
                               required>
                    </div>
                    <div>
                        <label class="block text-base font-medium text-gray-300">To</label>
                        <input type="date" 
                               name="to" 
                               value="{{ request('to') }}" 
                               class="mt-1 block w-full rounded-md border-gray-600 bg-gray-900 
                                      text-black text-base focus:border-blue-500 
                                      focus:ring-blue-500 focus:ring-opacity-50 focus:ring-2
                                      [color-scheme:dark]" 
                               max="{{ date('Y-m-d') }}" 
                               required>
                    </div>
                    <button type="submit" 
                            name="filter" 
                            value="1" 
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 
                                   text-base transition duration-150 ease-in-out">
                        Filter
                    </button>
                </form>

                @if(request('from') && request('to'))
                    @if(request('from') > request('to'))
                        <div class="mt-4 text-red-400">
                            Start date cannot be later than end date.
                        </div>
                    @endif
                @endif

                <!-- Export Buttons -->
                <div class="mt-6 flex gap-4">
                    <a href="{{ route('reports.export.pdf', ['from' => request('from'), 'to' => request('to')]) }}"
                       class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                        Export to PDF
                    </a>
                </div>
            </div>

            @if(isset($updates))
                <div class="bg-gray-800 p-6 shadow-lg sm:rounded-lg space-y-6">
                    <h3 class="text-xl font-bold mb-6 text-white">Filtered Results</h3>

                    @forelse ($updates as $update)
                        <div class="bg-gray-700 border-l-4 border-blue-500 text-gray-200 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <p class="mb-2"><strong class="text-gray-300">Activity:</strong> {{ $update->activity->title }}</p>
                            <p class="mb-2"><strong class="text-gray-300">Status:</strong> 
                                <span class="{{ $update->status === 'pending' ? 'text-yellow-400' : 'text-green-400' }}">
                                    {{ ucfirst($update->status) }}
                                </span>
                            </p>
                            <p class="mb-2"><strong class="text-gray-300">Remark:</strong> {{ $update->remark }}</p>
                            <p class="mb-2"><strong class="text-gray-300">By:</strong> {{ $update->bio_snapshot }}</p>
                            <p><strong class="text-gray-300">Date:</strong> {{ $update->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    @empty
                        <p class="text-gray-400">No records found for this range.</p>
                    @endforelse
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
