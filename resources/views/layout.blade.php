<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite("resources/css/app.css")
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>{{ $title ?? "Workopia | Find and list jobs" }}</title>
  <link rel="stylesheet" href="{{ asset('css/style.css')}}" />
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100">
  <x-header />
  @if(request()->is("/"))
    <x-hero />
  @endif
  <x-top-banner />

  <main class="container min-h-screen mx-auto p-4 mt-4" x-data="{ count: 0 }">
    {{-- <p>Count: <span x-text="count"></span></p>
    <button @click="count++">Increment</button> --}}

    {{-- Display alert message --}}
    @if(session()->has("success"))
      <x-alert type="success" message="{{ session('success') }}" />
    @else 
      <x-alert type="error" message="{{ session('error') }}" />
    @endif

   {{ $slot }}
  </main>

  <x-bottom-banner />
  <script src="{{asset('js/script.js')}}"></script>
</body>
</html>