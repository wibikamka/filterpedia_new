{{-- resources/views/admin/product/edit.blade.php --}}
@extends('layout.admin')

@section('title', 'Edit Produk')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Produk</h1>

@if ($errors->any())
    <div class="mb-4 rounded bg-red-100 p-4 text-red-700">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form
    action="{{ route('admin.product.update', $product->id) }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-6"
>
    @csrf
    @method('PUT')

    {{-- SKU --}}
    <div>
        <label class="block font-semibold mb-1">SKU</label>
        <input
            type="text"
            name="sku"
            value="{{ old('sku', $product->sku) }}"
            class="border p-2 w-full @error('sku') border-red-500 @enderror"
            required
        >
        @error('sku')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Nama --}}
    <div>
        <label class="block font-semibold mb-1">Nama Produk</label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $product->name) }}"
            class="border p-2 w-full @error('name') border-red-500 @enderror"
            required
        >
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Kategori --}}
    <div>
        <label class="block font-semibold mb-1">Kategori</label>
        <select name="category_id" class="border p-2 w-full @error('category_id') border-red-500 @enderror" required>
            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Harga --}}
    <div>
        <label class="block font-semibold mb-1">Harga</label>
        <input
            type="number"
            name="price"
            value="{{ old('price', $product->price) }}"
            min="0"
            step="0.01"
            class="border p-2 w-full @error('price') border-red-500 @enderror"
            required
        >
        @error('price')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Stok --}}
    <div>
        <label class="block font-semibold mb-1">Stok</label>
        <input
            type="number"
            name="stock"
            value="{{ old('stock', $product->stock) }}"
            min="0"
            class="border p-2 w-full @error('stock') border-red-500 @enderror"
            required
        >
        @error('stock')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Deskripsi --}}
    <div>
        <label class="block font-semibold mb-1">Deskripsi</label>
        <textarea
            name="description"
            rows="4"
            class="border p-2 w-full @error('description') border-red-500 @enderror"
        >{{ old('description', $product->description) }}</textarea>
        @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tokopedia --}}
    <div>
        <label class="block font-semibold mb-1">Tokopedia Link</label>
        <input
            type="url"
            name="tokopedia_link"
            value="{{ old('tokopedia_link', $product->tokopedia_link) }}"
            class="border p-2 w-full @error('tokopedia_link') border-red-500 @enderror"
        >
        @error('tokopedia_link')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Status --}}
    <div>
        <label class="block font-semibold mb-1">Status Produk</label>
        <select name="is_active" class="border p-2 w-full">
            <option value="1" {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
        </select>
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
                $existingSpecs = old('specifications', $product->specifications->toArray());
            @endphp
            
            @foreach ($existingSpecs as $index => $spec)
                <div class="specification-item flex gap-3 items-start">
                    <div class="flex-1">
                        <input 
                            type="text" 
                            name="specifications[{{ $index }}][key]" 
                            value="{{ is_array($spec) ? $spec['spec_key'] ?? $spec['key'] ?? '' : $spec->spec_key ?? '' }}"
                            placeholder="Nama spesifikasi (contoh: Berat)"
                            class="border p-2 w-full"
                            required
                        >
                    </div>
                    <div class="flex-1">
                        <input 
                            type="text" 
                            name="specifications[{{ $index }}][value]" 
                            value="{{ is_array($spec) ? $spec['spec_value'] ?? $spec['value'] ?? '' : $spec->spec_value ?? '' }}"
                            placeholder="Nilai spesifikasi (contoh: 1 kg)"
                            class="border p-2 w-full"
                            required
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
                        required
                    >
                </div>
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="specifications[__INDEX__][value]" 
                        placeholder="Nilai spesifikasi (contoh: 1 kg)"
                        class="border p-2 w-full"
                        required
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

    {{-- Existing Images --}}
    @if ($product->images->count())
        <div class="border-t pt-6">
            <label class="block font-semibold mb-2">Pilih Gambar Utama</label>

            <div id="existing-images" class="grid grid-cols-5 gap-4">
                @foreach ($product->images as $image)
                    <div
                        class="relative image-item"
                        data-id="{{ $image->id }}"
                    >
                        <button
                            type="button"
                            class="absolute top-1 right-1 bg-red-600 text-white text-xs px-1 rounded remove-existing"
                        >✕</button>

                        <div class="text-center">
                            <input
                                type="radio"
                                name="primary_image_id"
                                value="{{ $image->id }}"
                                {{ $image->is_primary ? 'checked' : '' }}
                                class="mb-1"
                            >
                        </div>

                        <img
                            src="{{ asset('storage/'.$image->path) }}"
                            class="border rounded w-full h-32 object-cover"
                        >
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div id="deleted-images"></div>

    {{-- Upload Images --}}
    <div>
        <label class="block font-semibold mb-1">Tambah Gambar Baru</label>
        <input
            type="file"
            id="image-input"
            name="images[]"
            multiple
            accept="image/*"
            class="border p-2 w-full"
        >
        <p class="text-gray-500 text-sm mt-1">Format: JPG, PNG, GIF. Maks: 2MB per file</p>
    </div>

    <div id="new-images-preview" class="grid grid-cols-5 gap-4 mt-3"></div>

    {{-- Actions --}}
    <div class="flex gap-3 pt-4">
        <button
            type="submit"
            class="rounded bg-green-600 px-6 py-2 text-white hover:bg-green-700"
        >
            Update Produk
        </button>

        <a href="{{ route('admin.product.index') }}"
            class="rounded border px-6 py-2 hover:bg-gray-100"
        >
            Batal
        </a>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Edit Product JS LOADED')

    // ===== EXISTING IMAGES =====
    var removeButtons = document.querySelectorAll('.remove-existing');
    removeButtons.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            console.log('🗑️ Remove existing image clicked')

            var wrapper = e.target.closest('.image-item')
            var id = wrapper.dataset.id

            console.log('📦 Image ID to delete:', id)

            var input = document.createElement('input')
            input.type = 'hidden'
            input.name = 'deleted_images[]'
            input.value = id

            document.getElementById('deleted-images').appendChild(input)

            var radio = wrapper.querySelector('input[type=radio]')
            if (radio && radio.checked) {
                radio.checked = false
                console.log('⚠️ Primary image was removed')
            }

            wrapper.remove()
        })
    })

    // ===== NEW IMAGES =====
    var input = document.getElementById('image-input')
    var preview = document.getElementById('new-images-preview')
    var files = []

    if (!input) {
        console.error('❌ image-input NOT FOUND')
        return
    }

    input.addEventListener('change', function(e) {
        console.log('📂 New images selected:', e.target.files.length)

        // Ganti spread operator dengan Array.from() atau loop biasa
        var selectedFiles = Array.from(e.target.files)
        
        selectedFiles.forEach(function(file) {
            files.push(file)

            var div = document.createElement('div')
            div.className = 'relative'

            var img = document.createElement('img')
            img.src = URL.createObjectURL(file)
            img.className = 'border rounded w-full h-32 object-cover'

            var btn = document.createElement('button')
            btn.type = 'button'
            btn.textContent = '✕'
            btn.className = 'absolute top-1 right-1 bg-red-600 text-white text-xs px-1 rounded'

            btn.onclick = function() {
                var index = files.indexOf(file)
                files.splice(index, 1)
                div.remove()
                console.log('➖ Removed new image')
                
                // Update input.files
                updateInputFiles()
            }

            div.appendChild(img)
            div.appendChild(btn)
            preview.appendChild(div)
        })

        updateInputFiles()
    })

    function updateInputFiles() {
        var dt = new DataTransfer()
        files.forEach(function(f) {
            dt.items.add(f)
        })
        input.files = dt.files
    }
    
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
    
    // Jika tidak ada spesifikasi, tambahkan satu baris kosong sebagai contoh
    if (specContainer.children.length === 0) {
        addSpecification()
    }
})
</script>

<style>
.specification-item {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.image-item {
    transition: transform 0.2s;
}

.image-item:hover {
    transform: scale(1.05);
}
</style>
@endsection