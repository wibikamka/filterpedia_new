@props(['address'])

<div x-data="{ 
    editMode: false,
    loading: false,
    errors: {},
    form: {
        label: '{{ $address->label }}',
        recipient_name: '{{ addslashes($address->recipient_name) }}',
        phone: '{{ $address->phone }}',
        full_address: `{{ addslashes($address->full_address) }}`,
        city: '{{ $address->city }}',
        province: '{{ $address->province }}',
        postal_code: '{{ $address->postal_code }}',
        is_default: {{ $address->is_default ? 'true' : 'false' }}
    }
}">
    
    {{-- View Mode --}}
    <div x-show="!editMode" class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg {{ $address->is_default ? 'bg-blue-50 dark:bg-blue-900/20 border-blue-300' : '' }}">
        <div class="flex justify-between items-start">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-2">
                    @if($address->label)
                        <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-800 text-xs font-medium rounded">
                            {{ $address->label }}
                        </span>
                    @endif
                    @if($address->is_default)
                        <span class="px-2 py-0.5 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-medium rounded">
                            Utama
                        </span>
                    @endif
                </div>
                <p class="font-medium text-gray-800 dark:text-white">{{ $address->recipient_name }}</p>
                <p class="text-sm text-gray-500">{{ $address->phone }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ $address->full_address }}</p>
                <p class="text-sm text-gray-500">{{ $address->city }}, {{ $address->province }} - {{ $address->postal_code }}</p>
            </div>
            
            <div class="flex gap-2">
                <button @click="editMode = true" 
                        class="text-xs text-gray-500 hover:text-gray-700">
                    Edit
                </button>
                
                <form action="{{ route('addresses.destroy', $address) }}" 
                      method="POST" 
                      onsubmit="return confirm('Hapus alamat ini?')"
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-xs text-red-500 hover:text-red-600">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    {{-- Edit Mode (AJAX) --}}
    <div x-show="editMode" class="p-4 border border-blue-300 dark:border-blue-700 rounded-lg bg-blue-50 dark:bg-blue-900/10">
        <form @submit.prevent="
            loading = true;
            errors = {};
            fetch('{{ route('addresses.update', $address) }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(form)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Dispatch notifikasi sukses
                    window.dispatchEvent(new CustomEvent('notification', {
                        detail: { message: data.message, type: 'success' }
                    }));
                    // Reload page untuk refresh data
                    setTimeout(() => location.reload(), 500);
                } else if (data.errors) {
                    errors = data.errors;
                    window.dispatchEvent(new CustomEvent('notification', {
                        detail: { message: 'Validasi gagal', type: 'error' }
                    }));
                }
            })
            .catch(() => {
                window.dispatchEvent(new CustomEvent('notification', {
                    detail: { message: 'Terjadi kesalahan', type: 'error' }
                }));
            })
            .finally(() => loading = false)
        ">
            @csrf
            @method('PUT')
            
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Label</label>
                    <input type="text" x-model="form.label" 
                           class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm">
                </div>
                
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Penerima *</label>
                        <input type="text" x-model="form.recipient_name" required
                               class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Telepon *</label>
                        <input type="text" x-model="form.phone" required
                               class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm">
                    </div>
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat Lengkap *</label>
                    <textarea x-model="form.full_address" rows="2" required
                              class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm"></textarea>
                </div>
                
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Kota *</label>
                        <input type="text" x-model="form.city" required
                               class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Provinsi *</label>
                        <input type="text" x-model="form.province" required
                               class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm">
                    </div>
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Kode Pos *</label>
                    <input type="text" x-model="form.postal_code" required
                           class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm">
                </div>
                
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" x-model="form.is_default" class="rounded">
                    <span class="text-sm text-gray-700 dark:text-gray-300">Jadikan alamat utama</span>
                </label>
            </div>
            
            <div class="flex justify-end gap-2 mt-4 pt-3 border-t border-gray-200 dark:border-gray-700">
                <button type="button" @click="editMode = false" 
                        class="px-3 py-1.5 text-xs text-gray-600 hover:text-gray-800">
                    Batal
                </button>
                <button type="submit" 
                        class="px-3 py-1.5 bg-bluefilterpedia text-white text-xs font-medium rounded-lg hover:opacity-90 disabled:opacity-50"
                        :disabled="loading">
                    <span x-show="!loading">Simpan</span>
                    <span x-show="loading">Menyimpan...</span>
                </button>
            </div>
        </form>
    </div>
</div>