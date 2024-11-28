
<header class="bg-blue-900 text-white p-4" x-data="{ open: false }">
  <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-3xl font-semibold">
          <a href={{ url("/") }}>Workopia</a>
      </h1>
      <nav class="hidden md:flex items-center space-x-4">
          <x-nav-link url="{{ url('/') }}" :active="request()->is('/')">Home</x-nav-link>
          <x-nav-link url="{{ url('/jobs') }}" :active="request()->is('jobs')">All Jobs</x-nav-link>
          @auth
            <x-nav-link url="{{ url('/bookmarks') }}" :active="request()->is('jobs/saved')">Saved Jobs</x-nav-link>
            <x-nav-link url="{{ url('/dashboard') }}" :active="request()->is('dashboard')" icon="gauge">Dashboard</x-nav-link>
            <x-logout-button />
            <x-button-link hoverClass="text-red-500" url="{{ url('/jobs/create') }}" :active="request()->is('jobs/create')" icon="edit">Create Job</x-button-link>
            <div class="flex items-center space-x-3">
              <a href="{{ route('dashboard.index') }}">
                @if(Auth::user()->avatar)
                  <img class="w-10 h-10 rounded-full" src="{{ asset('storage/' . Auth::user()->avatar ) }}" alt="{{ Auth::user()->name }}">
                @else
                  <img class="w-10 h-10 rounded-full" src="{{ asset('avatars/default-avatar.png') }}" alt="{{ Auth::user()->name }}">
                @endif
              </a>
            </div>
          @else
            <x-nav-link url="{{ url('/login') }}" :active="request()->is('login')">Login</x-nav-link>
            <x-nav-link url="{{ url('/register') }}" :active="request()->is('register')">Register</x-nav-link>
          @endauth
       </nav>
      <button
          id="hamburger"
          @click="open = !open"
          @click.away = "open = false"
          class="text-white md:hidden flex items-center"
      >
          <i class="fa fa-bars text-2xl"></i>
      </button>
  </div>
  <!-- Mobile Menu -->
  <nav
      x-cloak
      x-show="open"
      id="mobile-menu"
      class=" bg-blue-900 text-white mt-5 pb-4 space-y-2"
  >
    <x-nav-link url="{{ url('/') }}" :active="request()->is('/')" :mobile="true">Home</x-nav-link>
    <x-nav-link url="{{ url('/jobs') }}" :active="request()->is('jobs')" :mobile="true">All Jobs</x-nav-link>
    @auth
        <x-nav-link url="{{ url('/bookmarks') }}" :active="request()->is('jobs/saved')" :mobile="true">Saved Jobs</x-nav-link>
        <x-nav-link url="{{ url('/dashboard') }}" :active="request()->is('dashboard')" icon="gauge" :mobile="true">Dashboard</x-nav-link>
        <x-logout-button :mobile="true" />
    @else
        <x-nav-link url="{{ url('/login') }}" :active="request()->is('login')" :mobile="true">Login</x-nav-link>
        <x-nav-link url="{{ url('/register') }}" :active="request()->is('register')" :mobile="true">Register</x-nav-link>
    @endauth
    <x-button-link :block="true" hoverClass="text-red-500" url="{{ url('/jobs/create') }}" :active="request()->is('jobs/create')" icon="edit">Create Job</x-button-link>
  </nav>
</header>
