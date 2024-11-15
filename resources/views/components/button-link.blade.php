@props(["url" => "/", "icon" => null, "bgClass" => "bg-yellow-500", "hoverClass" => "bg-yellow-600", "block" => null ])

<a href="{{ $url }}" {{ $attributes}} class="{{$bgClass}} hover:{{ $hoverClass }} text-black px-4 py-2 rounded hover:shadow-md transition duration-300 {{ $block ? "block" : "" }}">
    @if($icon)
        <i class="fa fa-{{ $icon }} mr-1"></i>
    @endif
    {{ $slot }}
</a>