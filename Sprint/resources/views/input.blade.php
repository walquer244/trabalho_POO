@props(['label', 'name', 'type' => 'text', 'value' => '', 'placeholder' => '', 'required' => false, 'step' => null, 'min' => null, 'max' => null])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1.5">
        {{ $label }}@if($required)<span class="text-red-500 ml-0.5">*</span>@endif
    </label>
    <input
        id="{{ $name }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
        @if($step) step="{{ $step }}" @endif
        @if($min !== null) min="{{ $min }}" @endif
        @if($max !== null) max="{{ $max }}" @endif
        class="w-full border rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
               @error($name) border-red-400 bg-red-50 @else border-gray-300 bg-white @enderror"
    >
    @error($name)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>