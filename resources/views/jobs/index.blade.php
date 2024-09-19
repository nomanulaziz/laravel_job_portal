<x-layout>
    <x-slot:heading>
        Jobs Listing
    </x-slot:heading>

    <div class="space-y-4">
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job->id }}" class="block px-2 py-4 border border-gray-200 rounded-lg">
                <div class="font-bold text-blue-500 text-sm">{{ $job->employer->name }} </div>
                <div>
                    <strong class="text-laracasts">{{ $job->title }}:</strong> Job pays </h3> {{ $job->salary }}
                </div>
            </a>
        @endforeach
        
        <div>
            {{ $jobs->links() }}
        </div>
    </div>
</x-layout>