{{-- resources/views/profile/edit-avatar.blade.php --}}
<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            
            <div class="mb-6 flex items-center">
                <a href="{{ route('profile.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 class="text-2xl font-semibold text-gray-900">Ubah Foto Profil</h1>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <form method="POST" action="{{ route('profile.update-avatar') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    
                    <!-- Preview Avatar -->
                    <div class="flex flex-col items-center mb-6">
                        <div class="w-32 h-32 rounded-full bg-gray-200 overflow-hidden mb-4">
                            <img src="{{ auth()->user()->avatar ?? asset('images/avatar-default.png') }}" 
                                 id="preview-avatar"
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <div class="relative">
                            <input type="file" 
                                   name="avatar" 
                                   id="avatar-input"
                                   accept="image/*"
                                   class="absolute inset-0 opacity-0 w-full h-full cursor-pointer"
                                   onchange="previewImage(this)">
                            <button type="button" 
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">
                                Pilih Foto
                            </button>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Maksimal 2MB, format: JPG, PNG, GIF</p>
                        @error('avatar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" 
                                class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold">
                            Simpan
                        </button>
                        <a href="{{ route('profile.index') }}" 
                           class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-avatar').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>