@props(['label', 'name', 'type' => 'text', 'value' => null, 'placeholder' => '', 'required' => false, 'disabled' => false])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    @if($type === 'textarea')
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            rows="3"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error($name) border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror {{ $disabled ? 'bg-gray-100' : '' }}"
            {{ $attributes }}
        >{{ old($name, $value) }}</textarea>
    @elseif($type === 'select')
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error($name) border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror {{ $disabled ? 'bg-gray-100' : '' }}"
            {{ $attributes }}
        >
            {{ $slot }}
        </select>
    @else
        <input
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error($name) border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror {{ $disabled ? 'bg-gray-100' : '' }}"
            {{ $attributes }}
        />
    @endif

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
