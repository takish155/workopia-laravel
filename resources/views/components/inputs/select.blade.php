@props(["id", "name", "label" => null,  "value" => "", "options"])


<div class="mb-4">
    @if($label)
        <label class="block text-gray-700" for="{{ $id }}">{{ $label }}</label>
    @endif
    <select
        id="{{ $id }}"
        name="{{ $name }}"
        class="@error($name) border-red-500 @enderror w-full px-4 py-2 border rounded focus:outline-none"
        value="{{ old($name, $value)}}"
    >
        @foreach($options as $optionLabel => $optionValue)
        <option value="{{ $optionValue }}" {{old($name) === $optionValue ? "selected" : ""}}>
            {{ $optionLabel }}
        </option>
        @endforeach
    </select>
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>