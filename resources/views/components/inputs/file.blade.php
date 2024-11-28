@props(["id", "name", "label" => null,   "value" => "", "placeholder" => "", "required" => false])




<div class="mb-4">
    @if($label)
        <label class="block text-gray-700" for="{{ $id }}">{{ $label }}</label>
    @endif
    <input
        type="file"
        id="{{ $id }}"
        name="{{ $name }}"
        class="@error($name) border-red-500 @enderror w-full px-4 py-2 border rounded focus:outline-none"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value)}}"
        {{ $required ? 'required' : '' }}
    />
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>