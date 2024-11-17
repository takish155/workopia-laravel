<x-layout>
  <x-slot name="title">Post Job</x-slot>
  <h1>Create new Job</h1>
  <form method="POST" action="/jobs">
    @csrf
    <div class="my-5">
      <input type="text" name="title" placeholder="Title" value="{{ old('titlae')}}">
      @error("title")
        <p class="text-sm text-red-500">{{ $message }}</p>
      @enderror
    </div>
    <div class="my-5">
        <input type="text" name="description" placeholder="Description" value="{{ old('description')}}">
      @error("description")
        <p class="text-sm text-red-500">{{ $message }}</p>
      @enderror
    </div>
    <button type="submit">Submit</button>
  </form>
</x-layout>