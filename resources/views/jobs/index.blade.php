<x-layout>
  <x-slot name="title">Job Listing</x-slot>
  <h2>{{ $title }}</h2>
  <ul>
    @forelse($jobs as $job)
      <li>{{ $job }}</li>
    @empty
      <p>No jobs found</p>
    @endforelse
  </ul>
</x-layout>