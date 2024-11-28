<x-layout>
  <section class="flex flex-col md:flex-row gap-6">
    <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-1/2">
      <h3 class="text-3xl text-center font-bold mb-4">
          Profile Info
      </h3>

      @if($user->avatar)
        <div class="mt-2 flex justify-center">
          <img src="{{ asset('storage/' . $user->avatar)}}" alt="{{ $user->name }}" class="w-32 h-32 object-cover rounded-full">
        </div>
      @endif

      <form
          method="POST"
          action="{{ route('profile.update') }}"
          enctype="multipart/form-data"
      >
          @csrf
          @method("PUT")

          <x-inputs.text id="name" name="name" label="Name" value="{{ $user->name }}" />
          <x-inputs.text id="email" name="email" label="Email" value="{{ $user->email }}" type="email" />
          <x-inputs.file id="avatar" name="avatar" label="Upload Avatar" />
         
          <button
              type="submit"
              class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
          >
              Save
          </button>
      </form>
  </div>
    <div class="bg-white p-8 rounded-lg shadow-md w-full">
      <h3 class="text-3xl text-center font-bold mb-4">
        My Job Listings
      </h3>
      @forelse($jobs as $job)
      <div
      class="flex justify-between items-center border-b-2 border-gray-200 py-2"
  >
      <div>
          <h3 class="text-xl font-semibold">
              {{ $job->title}}
          </h3>
          <p class="text-gray-700">{{ $job->job_type }}</p>
      </div>
      <div class="flex gap-3">
          <a
              href="{{ route('jobs.edit', $job->id)}}"
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm"
              >Edit</a
          >
          <form method="POST" onsubmit="return confirm('Are you sure you want to delete {{ $job->title }}?')" action="{{ route('jobs.destroy', $job->id) }}?from=dashboard">
            @csrf
            @method("DELETE")
              <button
                  type="submit"
                  class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm"
              >
                  Delete
              </button>
          </form>
        </div>
      </div>
      {{-- Applications --}}
      <div class="mt-4">
        <h4 class="text-lg font-semibold mb-2">Applicants</h4>
        @forelse($job->applicants as $applicant)
          <div class="mb-4">
            <p class="text-gray-800"><strong>Name: </strong>{{ $applicant->full_name }}</p>
            <p class="text-gray-800"><strong>Phone: </strong>{{ $applicant->contact_phone }}</p>
            <p class="text-gray-800"><strong>Email: </strong>{{ $applicant->contact_email }}</p>
            <p class="text-gray-800"><strong>Message: </strong>{{ $applicant->message }}</p>
            <p class="text-gray-800 mt-4">
              <a class="text-blue-500 hover:underline" href="{{ asset('storage/' . $applicant->resume_path )}}" download><i class="fas fa-download"></i> Download Resume</a>
            </p>
            <form action="{{ route('applicant.destroy', $applicant->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this applicant?')">
              @csrf
              @method('DELETE')
              <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i> Delete Applicant</button>
            </form>
          </div>
        @empty
          <p class="text-gray-700">No applicants found.</p>
        @endforelse
      </div>

      @empty
        <p class="text-gray-700">No job listings found.</p>
      @endforelse
    </div>
  </section>
</x-layout>