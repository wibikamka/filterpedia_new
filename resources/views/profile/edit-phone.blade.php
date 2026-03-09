{{-- resources/views/profile/edit-phone.blade.php --}}
<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            
            <div class="mb-6 flex items-center">
                <a href="{{ route('profile.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 class="text-2xl font-semibold text-gray-900">Ubah Nomor Handphone</h1>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <form method="POST" action="{{ route('profile.update-phone') }}">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Handphone</label>
                        <input type="tel" 
                               name="phone" 
                               value="{{ old('phone', auth()->user()->phone) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Contoh: 08123456789">
                        @error('phone')
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
</x-app-layout>