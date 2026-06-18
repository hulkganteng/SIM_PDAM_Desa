@props(['id', 'title' => 'Konfirmasi', 'message' => 'Apakah Anda yakin ingin melanjutkan?'])

<div x-data="{ open: false }"
     x-on:open-modal-{{ $id }}.window="open = true"
     x-on:keydown.escape.window="open = false"
     x-show="open"
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto"
     aria-labelledby="modal-title-{{ $id }}"
     role="dialog"
     aria-modal="true">

    {{-- Backdrop --}}
    <div x-show="open"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"
         class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity">
    </div>

    {{-- Modal Panel --}}
    <div class="flex min-h-full items-center justify-center p-4">
        <div x-show="open"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">

            <div class="p-6">
                {{-- Icon --}}
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-red-100">
                    <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>

                {{-- Title --}}
                <h3 id="modal-title-{{ $id }}" class="text-lg font-semibold text-gray-900 text-center">{{ $title }}</h3>

                {{-- Message --}}
                <p class="mt-2 text-sm text-gray-500 text-center">{{ $message }}</p>
            </div>

            {{-- Actions --}}
            <div class="bg-gray-50 px-6 py-4 rounded-b-lg flex justify-end space-x-3">
                <button @click="open = false" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Batal
                </button>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
