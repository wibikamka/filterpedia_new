@props(['user'])

<div x-data="{ 
    uploading: false,
    preview: '{{ $user->avatar ? asset('storage/' . $user->avatar) : '' }}',
    hasError: false
}">
    
    <div class="px-6 py-6 flex flex-col items-start border-b border-gray-100 dark:border-gray-800">
        <p class="text-sm font-semibold text-gray-800 dark:text-white">Foto Profil</p>
        <p class="text-xs text-gray-400 mt-0.5 mb-4">Ubah foto profil Anda</p>
        
        <div class="relative group">
            {{-- Container Avatar --}}
            <div class="w-32 h-32 sm:w-40 sm:h-40 overflow-hidden bg-gray-200 dark:bg-gray-800
                        ring-2 ring-gray-200 dark:ring-gray-700 rounded-lg
                        group-hover:ring-2 group-hover:ring-bluefilterpedia transition-all">
                
                {{-- Tampilkan preview jika ada --}}
                <template x-if="preview && !uploading">
                    <img :src="preview + (preview.includes('?') ? '&' : '?') + 't=' + Date.now()" 
                         class="w-full h-full object-cover"
                         alt="Avatar">
                </template>
                
                {{-- Tampilkan default icon jika tidak ada preview --}}
                <template x-if="(!preview || uploading) && !hasError">
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800">
                        <svg class="w-16 h-16 text-bluefilterpedia" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </template>

                {{-- Loading indicator --}}
                <template x-if="uploading">
                    <div class="w-full h-full flex items-center justify-center bg-gray-100 dark:bg-gray-800">
                        <svg class="animate-spin h-8 w-8 text-bluefilterpedia" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </template>
            </div>

            {{-- Hidden file input --}}
            <input type="file" 
                   x-ref="fileInput"
                   accept="image/jpeg,image/png,image/jpg,image/gif" 
                   class="hidden"
                   @change="uploading = true; hasError = false;
                            const file = $event.target.files[0];
                            if (!file) return;
                            
                            // Validasi file
                            if (file.size > 2 * 1024 * 1024) {
                                $dispatch('notify', { 
                                    message: 'File terlalu besar. Maksimal 2MB', 
                                    type: 'error' 
                                });
                                uploading = false;
                                $refs.fileInput.value = '';
                                return;
                            }
                            
                            if (!file.type.startsWith('image/')) {
                                $dispatch('notify', { 
                                    message: 'File harus berupa gambar', 
                                    type: 'error' 
                                });
                                uploading = false;
                                $refs.fileInput.value = '';
                                return;
                            }
                            
                            // Preview lokal dulu
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                preview = e.target.result;
                            };
                            reader.readAsDataURL(file);
                            
                            // Upload ke server
                            const formData = new FormData();
                            formData.append('avatar', file);
                            
                            fetch('{{ route('account.update-avatar') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: formData
                            })
                            .then(res => {
                                if (!res.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return res.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    // Update preview dengan URL dari server
                                    preview = data.data.avatar_url;
                                    $dispatch('notify', { 
                                        message: data.message, 
                                        type: 'success' 
                                    });
                                } else {
                                    hasError = true;
                                    $dispatch('notify', { 
                                        message: data.message || 'Gagal upload', 
                                        type: 'error' 
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                hasError = true;
                                $dispatch('notify', { 
                                    message: 'Terjadi kesalahan saat upload', 
                                    type: 'error' 
                                });
                            })
                            .finally(() => {
                                uploading = false;
                                $refs.fileInput.value = '';
                            });">

            {{-- Upload button with camera icon --}}
            <button type="button" 
                    @click="$refs.fileInput.click()"
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors rounded-lg flex items-center justify-center">
                <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </button>
        </div>
        
        {{-- Helper text --}}
        <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">
            Klik foto untuk mengubah (max 2MB)
        </p>
    </div>
</div>