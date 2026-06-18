@props(['class' => ''])

<div class="gov-card overflow-hidden {{ $class }}">
    <div class="overflow-x-auto">
        <table class="gov-table min-w-full">
            {{ $slot }}
        </table>
    </div>

    @if(isset($pagination) && $pagination->isNotEmpty())
        <div class="bg-[#F8FAFC] px-5 py-3 border-t border-[#E2E8F0]">
            {{ $pagination }}
        </div>
    @endif
</div>
