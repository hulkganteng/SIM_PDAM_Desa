@props(['title', 'value', 'icon' => null, 'color' => 'indigo'])

@php
    $colorClasses = [
        'indigo' => 'bg-indigo-500',
        'green' => 'bg-green-500',
        'red' => 'bg-red-500',
        'yellow' => 'bg-yellow-500',
        'blue' => 'bg-blue-500',
        'purple' => 'bg-purple-500',
    ];
    $bgColor = $colorClasses[$color] ?? 'bg-indigo-500';
@endphp

<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-5">
        <div class="flex items-center">
            @if($icon)
                <div class="flex-shrink-0">
                    <div class="{{ $bgColor }} rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            {!! $icon !!}
                        </svg>
                    </div>
                </div>
            @endif
            <div class="{{ $icon ? 'ml-5' : '' }} w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">{{ $title }}</dt>
                    <dd class="text-2xl font-bold text-gray-900 mt-1">{{ $value }}</dd>
                </dl>
            </div>
        </div>
    </div>
    @if($slot->isNotEmpty())
        <div class="bg-gray-50 px-5 py-3 border-t border-gray-200">
            {{ $slot }}
        </div>
    @endif
</div>
