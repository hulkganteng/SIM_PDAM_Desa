@props(['label', 'name', 'type' => 'text', 'value' => null, 'placeholder' => '', 'required' => false, 'disabled' => false])

<div class="mb-4">
    <label for="{{ $name }}" class="gov-label">
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
            class="gov-input @error($name) gov-input-error @enderror {{ $disabled ? 'bg-gray-100 cursor-not-allowed' : '' }}"
            {{ $attributes }}
        >{{ old($name, $value) }}</textarea>
    @elseif($type === 'select')
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            class="gov-input @error($name) gov-input-error @enderror {{ $disabled ? 'bg-gray-100 cursor-not-allowed' : '' }}"
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
            class="gov-input @error($name) gov-input-error @enderror {{ $disabled ? 'bg-gray-100 cursor-not-allowed' : '' }}"
            {{ $attributes }}
        />
    @endif

    @error($name)
        <p class="gov-error-text">{{ $message }}</p>
    @enderror
</div>
