<x-layout>
  <h2 class="text-xl font-semibold mb-4 text-center">Welcome to Workopia!</h2>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
    @forelse($jobs as $job)
      <x-job-card :job="$job" />
    @empty
      <p>No jobs found</p>
    @endforelse
  </div>
  <a class="text-xl font-bold text-center flex gap-2 items-center" href="{{ route('jobs.index')}}"><i class="fa fa-arrow-alt-circle-right"></i>View all jobs</a>
</x-layout>