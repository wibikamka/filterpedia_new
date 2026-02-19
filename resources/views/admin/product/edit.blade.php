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
            class="border p-2 w-full"
            required
        >
    </div>

    {{-- Nama --}}
    <div>
        <label class="block font-semibold mb-1">Nama Produk</label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $product->name) }}"
            class="border p-2 w-full"
            required
        >
    </div>

    {{-- Kategori --}}
    <div>
        <label class="block font-semibold mb-1">Kategori</label>
        <select name="category_id" class="border p-2 w-full" required>
            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Harga --}}
    <div>
        <label class="block font-semibold mb-1">Harga</label>
        <input
            type="number"
            name="price"
            value="{{ old('price', $product->price) }}"
            min="0"
            class="border p-2 w-full"
            required
        >
    </div>

    {{-- Stok --}}
    <div>
        <label class="block font-semibold mb-1">Stok</label>
        <input
            type="number"
            name="stock"
            value="{{ old('stock', $product->stock) }}"
            min="0"
            class="border p-2 w-full"
            required
        >
    </div>

    {{-- Deskripsi --}}
    <div>
        <label class="block font-semibold mb-1">Deskripsi</label>
        <textarea
            name="description"
            rows="4"
            class="border p-2 w-full"
        >{{ old('description', $product->description) }}</textarea>
    </div>

    {{-- Tokopedia --}}
    <div>
        <label class="block font-semibold mb-1">Tokopedia Link</label>
        <input
            type="url"
            name="tokopedia_link"
            value="{{ old('tokopedia_link', $product->tokopedia_link) }}"
            class="border p-2 w-full"
        >
    </div>

    {{-- Status --}}
    <div>
        <label class="block font-semibold mb-1">Status Produk</label>
        <select name="is_active" class="border p-2 w-full">
            <option value="1" {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>

    {{-- Existing Images --}}
    @if ($product->images->count())
        <div>
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

                        <input
                            type="radio"
                            name="primary_image_id"
                            value="{{ $image->id }}"
                            {{ $image->is_primary ? 'checked' : '' }}
                        >

                        <img
                            src="{{ asset('storage/'.$image->path) }}"
                            class="border rounded"
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
        >
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
            class="rounded border px-6 py-2"
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
            img.className = 'border rounded'

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
})
</script>
@endsection