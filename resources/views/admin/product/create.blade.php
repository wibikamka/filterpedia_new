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
@endsection