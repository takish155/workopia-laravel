@props(["active" => false, "url" => "/", "icon" => null, "mobile" => null])

@if($mobile)
    <a href={{ $url }} class="block px-4 py-2 hover:bg-blue-700 {{ $active ? "font-bold text-yellow-500" : "" }}">
        @if($icon)
        <i class="fa fa-{{ $icon }} mr-1"></i>
        @endif
        {{ $slot }}
    </a>
@else
<a href="{{ $url }}" {{ $attributes }} class="text-white hover:underline py-2 {{ $active ? "font-bold text-yellow-500" : "" }}">
    @if($icon)
        <i class="fa fa-{{ $icon }} mr-1"></i>
    @endif
    {{ $slot }}
</a>
@endif