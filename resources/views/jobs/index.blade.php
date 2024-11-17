<x-layout>
  <x-slot name="title">Job Listing</x-slot>
  <h2>{{ $title }}</h2>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    @forelse($jobs as $job)
      <x-job-card :job="$job" />
    @empty
      <p>No jobs found</p>
    @endforelse
  </div>
</x-layout>