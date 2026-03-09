@props(['user'])

<div x-data="{ 
    value: '{{ $user->email }}',
    loading: false,
    errors: {}
}">
    <form @submit.prevent="loading = true; errors = {};
            fetch('{{ route('account.update-email') }}', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: value })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    $dispatch('notify', { message: data.message, type: 'success' });
                } else if (data.errors) {
                    errors = data.errors;
                    $dispatch('notify', { message: 'Validasi gagal', type: 'error' });
                }
            })
            .catch(() => $dispatch('notify', { message: 'Terjadi kesalahan', type: 'error' }))
            .finally(() => loading = false)">
        
        @csrf
        @method('PATCH')
        
        <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-start gap-2">
            <label class="text-xs font-medium text-gray-500 dark:text-gray-400 sm:w-40 flex-shrink-0 pt-2">
                Email
            </label>
            <div class="flex-1">
                <div class="flex gap-2">
                    <input type="email" 
                           x-model="value"
                           :class="errors.email ? 'border-red-300 dark:border-red-700' : 'border-gray-200 dark:border-gray-700'"
                           class="flex-1 bg-gray-50 dark:bg-gray-800 border rounded-lg px-3 py-2 text-sm text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-bluefilterpedia/30 focus:border-bluefilterpedia transition-colors">
                    <button type="submit" 
                            class="px-4 py-2 bg-bluefilterpedia text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity whitespace-nowrap disabled:opacity-50 min-w-[80px]"
                            :disabled="loading">
                        <span x-show="!loading">Update</span>
                        <span x-show="loading" class="flex items-center justify-center gap-1">
                            <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                            </svg>
                            <span>...</span>
                        </span>
                    </button>
                </div>
                <template x-if="errors.email">
                    <p class="text-xs text-red-500 mt-1" x-text="errors.email[0]"></p>
                </template>
                <p class="text-xs text-gray-400 mt-1" x-show="!errors.email && value !== '{{ $user->email }}'">
                    ⚠️ Email baru perlu diverifikasi
                </p>
            </div>
        </div>
    </form>
</div>