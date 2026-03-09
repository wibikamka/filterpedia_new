@extends('layout.admin')

@section('title', 'Tambah Produk')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>

@if($errors->any())
    <div class="bg-red-200 text-red-800 p-2 mb-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="mb-4">
        <label class="block mb-1 font-semibold">SKuU</label>
        <input type="text" name="sku" value="{{ old('sku') }}" 
               class="border p-2 w-full @error('sku') border-red-500 @enderror">
        @error('sku')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Nama Produk</label>
        <input type="text" name="name" value="{{ old('name') }}" 
               class="border p-2 w-full @error('name') border-red-500 @enderror">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Kategori</label>
        <select name="category_id" class="border p-2 w-full @error('category_id') border-red-500 @enderror">
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Harga</label>
        <input type="number" name="price" value="{{ old('price') }}" min="0" step="0.01"
               class="border p-2 w-full @error('price') border-red-500 @enderror">
        @error('price')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Stok</label>
        <input type="number" name="stock" value="{{ old('stock') }}" min="0"
               class="border p-2 w-full @error('stock') border-red-500 @enderror">
        @error('stock')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Deskripsi</label>
        <textarea name="description" rows="4" 
                  class="border p-2 w-full @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
        @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
     {{-- ===== SECTION SPESIFIKASI PRODUK (ADD-ON) ===== --}}
    <div class="border-t pt-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold">Spesifikasi Produk</h2>
            <button 
                type="button" 
                id="add-specification"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center gap-2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Spesifikasi
            </button>
        </div>
        
        <p class="text-gray-600 text-sm mb-4">Tambahkan spesifikasi produk seperti: Berat, Dimensi, Warna, Bahan, dll.</p>
        
        <div id="specifications-container" class="space-y-3">
            {{-- Loop untuk spesifikasi yang sudah ada --}}
@php
    $oldSpecs = old('specifications', []);
@endphp

@foreach ($oldSpecs as $index => $spec)
    <div class="specification-item flex gap-3 items-start">
        <div class="flex-1">
            <input 
                type="text" 
                name="specifications[{{ $index }}][key]" 
                value="{{ $spec['key'] ?? '' }}"
                placeholder="Nama spesifikasi (contoh: Berat)"
                class="border p-2 w-full"
            >
        </div>
        <div class="flex-1">
            <input 
                type="text" 
                name="specifications[{{ $index }}][value]" 
                value="{{ $spec['value'] ?? '' }}"
                placeholder="Nilai spesifikasi (contoh: 1 kg)"
                class="border p-2 w-full"
            >
        </div>
                    <button 
                        type="button" 
                        class="remove-specification bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            @endforeach
        </div>
        
        {{-- Template untuk spesifikasi baru (disembunyikan) --}}
        <template id="specification-template">
            <div class="specification-item flex gap-3 items-start">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="specifications[__INDEX__][key]" 
                        placeholder="Nama spesifikasi (contoh: Berat)"
                        class="border p-2 w-full"
                    >
                </div>
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="specifications[__INDEX__][value]" 
                        placeholder="Nilai spesifikasi (contoh: 1 kg)"
                        class="border p-2 w-full"
                    >
                </div>
                <button 
                    type="button" 
                    class="remove-specification bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </template>
    </div>
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Tokopedia Link</label>
        <input type="url" name="tokopedia_link" value="{{ old('tokopedia_link') }}" 
               class="border p-2 w-full @error('tokopedia_link') border-red-500 @enderror">
        @error('tokopedia_link')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Gambar Produk</label>
        <input type="file" name="images[]" multiple accept="image/*" 
               class="border p-2 w-full @error('images.*') border-red-500 @enderror">
        <p class="text-sm text-gray-500 mt-1">Bisa pilih multiple gambar (CTRL+ klik untuk multiple)</p>
        @error('images.*')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <!-- Note: primary_image_id tidak diperlukan di create karena 
             gambar pertama akan otomatis menjadi primary -->
    </div>
    <div class="mb-4">
    <label class="block mb-1 font-semibold">Gambar Produk</label>
    <input type="file" name="images[]" multiple accept="image/*" 
           class="border p-2 w-full @error('images.*') border-red-500 @enderror"
           id="image-input">
    <p class="text-sm text-gray-500 mt-1">Bisa pilih multiple gambar (CTRL+ klik untuk multiple)</p>
    
    {{-- TAMBAHKAN PREVIEW --}}
    <div id="image-preview" class="grid grid-cols-5 gap-4 mt-3"></div>
    
    @error('images.*')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<script>
// Preview gambar
document.getElementById('image-input').addEventListener('change', function(e) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    
    Array.from(e.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'relative';
            div.innerHTML = `
                <img src="${e.target.result}" class="w-full h-24 object-cover border rounded">
                <button type="button" class="absolute top-1 right-1 bg-red-600 text-white text-xs px-1 rounded">✕</button>
            `;
            preview.appendChild(div);
        }
        reader.readAsDataURL(file);
    });
});
// Di bagian atas script
const form = document.querySelector('form');
const submitBtn = form.querySelector('button[type="submit"]');

form.addEventListener('submit', function() {
    submitBtn.disabled = true;
    submitBtn.innerHTML = 'Menyimpan... <span class="animate-spin">⏳</span>';
});
document.getElementById('image-input').addEventListener('change', function(e) {
    const maxSize = 2 * 1024 * 1024; // 2MB
    const files = Array.from(e.target.files);
    const oversized = files.filter(f => f.size > maxSize);
    
    if (oversized.length > 0) {
        alert('Beberapa file melebihi 2MB. Harap pilih file yang lebih kecil.');
        this.value = ''; // Reset input
        document.getElementById('image-preview').innerHTML = '';
    }
});
let formChanged = false;

// Deteksi perubahan form
document.querySelectorAll('input, textarea, select').forEach(field => {
    field.addEventListener('change', () => formChanged = true);
});

// Konfirmasi sebelum leave
window.addEventListener('beforeunload', function(e) {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// Reset flag setelah submit
form.addEventListener('submit', () => formChanged = false);
</script>
    
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Aktif</label>
        <select name="is_active" class="border p-2 w-full">
            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Ya</option>
            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Tidak</option>
        </select>
    </div>
    
    <div class="flex items-center">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Simpan
        </button>
        <a href="{{ route('admin.product.index') }}" class="ml-2 text-gray-700 hover:text-gray-900">
            Batal
        </a>
    </div>
</form>
<script>
    // ===== FITUR SPESIFIKASI (ADD-ON) =====
    var specContainer = document.getElementById('specifications-container')
    var addButton = document.getElementById('add-specification')
    var template = document.getElementById('specification-template')
    
    // Hitung index untuk spesifikasi baru
    function getNextIndex() {
        var items = document.querySelectorAll('.specification-item')
        return items.length
    }
    
    // Fungsi untuk menambah spesifikasi baru
    function addSpecification() {
        var index = getNextIndex()
        var clone = template.content.cloneNode(true)
        var html = clone.querySelector('.specification-item').outerHTML
        
        // Ganti placeholder __INDEX__ dengan index yang sesuai
        html = html.replace(/__INDEX__/g, index)
        
        // Buat elemen div baru
        var div = document.createElement('div')
        div.innerHTML = html
        var newItem = div.firstElementChild
        
        // Tambahkan event listener untuk tombol remove
        var removeBtn = newItem.querySelector('.remove-specification')
        removeBtn.addEventListener('click', function(e) {
            e.target.closest('.specification-item').remove()
            // Rename indices setelah penghapusan
            renameSpecificationIndices()
        })
        
        specContainer.appendChild(newItem)
    }
    
    // Fungsi untuk merename index setelah penghapusan
    function renameSpecificationIndices() {
        var items = document.querySelectorAll('.specification-item')
        items.forEach(function(item, index) {
            var keyInput = item.querySelector('input[name*="[key]"]')
            var valueInput = item.querySelector('input[name*="[value]"]')
            
            if (keyInput) {
                keyInput.name = `specifications[${index}][key]`
            }
            if (valueInput) {
                valueInput.name = `specifications[${index}][value]`
            }
        })
    }
    
    // Event listener untuk tombol tambah spesifikasi
    if (addButton) {
        addButton.addEventListener('click', addSpecification)
    }
    
    // Event listener untuk tombol remove yang sudah ada
    document.querySelectorAll('.remove-specification').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.target.closest('.specification-item').remove()
            renameSpecificationIndices()
        })
    })
    
    // Jika tidak ada spesifikasi, jangan tambahkan baris kosong
    // Biarkan user menambah sendiri dengan tombol plus
</script>
@endsection