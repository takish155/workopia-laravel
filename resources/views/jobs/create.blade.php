<x-layout>
  <x-slot name="title">Post Job</x-slot>
  <h1>Create new Job</h1>
  <form method="POST" action="/jobs">
    @csrf
    <input type="text" name="title" placeholder="Title">
    <input type="text" name="description" placeholder="Description">
    <button type="submit">Submit</button>
  </form>
</x-layout>