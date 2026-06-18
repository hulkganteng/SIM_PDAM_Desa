@props(['class' => ''])

<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden {{ $class }}">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            {{ $slot }}
        </table>
    </div>

    @if(isset($pagination) && $pagination->isNotEmpty())
        <div class="bg-gray-50 px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $pagination }}
        </div>
    @endif
</div>
