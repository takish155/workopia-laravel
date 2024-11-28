@props(["type", "message", "timeout" => 5000])

@if(session()->has($type))
<div x-cloak x-data="{ show: true }" x-init="setTimeout(() => show = false, {{ $timeout }})" x-show="show" class="p-4 mb-4 text-sm text-white rounded {{$type === 'success' ? 'bg-green-500' : 'bg-red-500'}}">
    {{$message}}</div>
@endif

{{-- <div>
    <!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
</div> --}}