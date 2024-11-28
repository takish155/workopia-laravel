<x-layout>
  <x-slot name="title">Post Job</x-slot>
  <div
    class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-3xl"
  >
    <h2 class="text-4xl text-center font-bold mb-4">
        Edit Job Listing
    </h2>
    <form
        method="POST"
        action="{{ route('jobs.update', $job->id) }}"
        enctype="multipart/form-data"
    >
      @csrf
      @method("PUT")

      <h2
          class="text-2xl font-bold mb-6 text-center text-gray-500"
      >
          Job Info
      </h2>
      <x-inputs.text :value="old('title', $job->title)" id="title" name="title" label="Job Title" placeholder="Software Engineer" />
      
      <x-inputs.text-area :value="old('description', $job->description)" id="description" name="description" label="Job Description" placeholder="We are seeking a skilled and motivated Software Developer to join our growing development team..." />

      <x-inputs.text :value="old('salary', $job->salary)" id="salary" name="salary" label="Annual Salary" placeholder="90000" />

      <x-inputs.text-area :value="old('requirements', $job->requirements)" id="requirements" name="requirements" label="Requirements" placeholder="Bachelor's degree in Computer Science" />

      <x-inputs.text :value="old('benefits', $job->benefits)" id="benefits" name="benefits" label="Benefits" placeholder="Health insurance, 401k, paid time off" />

      <x-inputs.text :value="old('tags', $job->tags)" id="tags" name="tags" label="Tags (comma-separated)" placeholder="development,coding,java,python" />
     
      <x-inputs.select :value="old('job_type', $job->job_type)" id="job_type" name="job_type" label="Job Type" :options="['Full-Time' => 'Full-Time', 'Part-Time' => 'Part-Time', 'Contract' => 'Contract', 'Temporary' => 'Temporary', 'Internship' => 'Internship', 'Volunteer' => 'Volunteer', 'On-Call' => 'On-Call']" />

      <x-inputs.select :value="old('remote', $job->remote)" id="remote" name="remote" label="Remote" :options="['No' => 'false', 'Yes' => 'true']" />

      <x-inputs.text :value="old('address', $job->address)" id="address" name="address" label="Address" placeholder="123 Main St" />

      <x-inputs.text :value="old('city', $job->city)" id="city" name="city" label="City" placeholder="Albany" />

      <x-inputs.text :value="old('state', $job->state)" id="state" name="state" label="State" placeholder="NY" />
     
      <x-inputs.text :value="old('zipcode', $job->zipcode)" id="zipcode" name="zipcode" label="ZIP Code" placeholder="12201" />
      
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Company Info
      </h2>
      <x-inputs.text :value="old('company_name', $job->company_name)" id="company_name" name="company_name" label="Company Name" placeholder="Acme Corp" />

      <x-inputs.text-area :value="old('company_description', $job->company_description)" id="company_description" name="company_description" label="Company Description" placeholder="We are a software development company that specializes in building web applications..." />

      <x-inputs.text :value="old('company_website', $job->company_website)" id="company_website" name="company_website" label="Company Website" placeholder="Enter website" />

      <x-inputs.text :value="old('contact_phone', $job->contact_phone)" id="contact_phone" name="contact_phone" label="Contact Phone" placeholder="Enter phone" />

      <x-inputs.text :value="old('contact_email', $job->contact_email)" id="contact_email" type="email" name="contact_email" label="Contact Email" placeholder="Email where you want to receive applications" />

      <x-inputs.file :value="$job->company_logo" id="company_logo" name="company_logo" label="Company Logo" />

      <button
          type="submit"
          class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
      >
          Save
      </button>
    </form>
  </div>
</x-layout>
