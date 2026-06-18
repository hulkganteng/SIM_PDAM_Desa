@props(['title', 'value', 'icon' => null, 'color' => 'blue'])

@php
    // Warna ikon kartu statistik sesuai spesifikasi tema.
    $colorClasses = [
        'blue'    => 'bg-blue-100 text-blue-600',
        'amber'   => 'bg-amber-100 text-amber-600',
        'yellow'  => 'bg-amber-100 text-amber-600',
        'emerald' => 'bg-emerald-100 text-emerald-600',
        'green'   => 'bg-emerald-100 text-emerald-600',
        'red'     => 'bg-red-100 text-red-600',
        'indigo'  => 'bg-blue-100 text-blue-600',
        'purple'  => 'bg-purple-100 text-purple-600',
    ];
    $iconClass = $colorClasses[$color] ?? 'bg-blue-100 text-blue-600';
@endphp

<div class="gov-card overflow-hidden">
    <div class="p-5">
        <div class="flex items-center gap-4">
            @if($icon)
                <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center {{ $iconClass }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        {!! $icon !!}
                    </svg>
                </div>
            @endif
            <div class="min-w-0 flex-1">
                <p class="text-sm text-gray-500 truncate">{{ $title }}</p>
                <p class="text-2xl font-semibold text-[#1A3A5C] mt-0.5">{{ $value }}</p>
            </div>
        </div>
    </div>
    @if($slot->isNotEmpty())
        <div class="bg-[#F8FAFC] px-5 py-3 border-t border-[#E2E8F0]">
            {{ $slot }}
        </div>
    @endif
</div>
