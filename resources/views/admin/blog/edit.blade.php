@extends('layout.admin')

@section('title', 'Edit Blog Post')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Edit Blog Post</h1>
            <a href="{{ route('admin.blog.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Back to List
            </a>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <form method="POST" action="{{ route('admin.blog.update', $blog) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title', $blog->title) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                            Slug (optional - auto-generated if empty)
                        </label>
                        <input type="text" 
                               name="slug" 
                               id="slug" 
                               value="{{ old('slug', $blog->slug) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Category Dropdown -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select name="category" 
                                id="category" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                required>
                            <option value="">Select Category</option>
                            @foreach($categories as $value => $label)
                                <option value="{{ $value }}" {{ old('category', $blog->category) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Tags Input -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">
                            Tags
                        </label>
                        <input type="text" 
                               name="tags" 
                               id="tags" 
                               value="{{ old('tags', $tagsString) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                               placeholder="filter-air, promo, tips, review">
                        <p class="text-sm text-gray-500 mt-1">Pisahkan dengan koma (contoh: filter-air, promo, tips)</p>
                        @error('tags')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Content - TinyMCE -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            Content <span class="text-red-500">*</span>
                        </label>
                        <x-tiny-editor 
                            name="content"
                            :value="old('content', $blog->content)"
                            height="500"
                            required
                        />
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Excerpt -->
                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                            Excerpt (optional)
                        </label>
                        <textarea name="excerpt" 
                                  id="excerpt" 
                                  rows="3"
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                  placeholder="Brief summary of the post">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Thumbnail -->
                    <div>
                        <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">
                            Thumbnail Image
                        </label>
                        
                        @if($blog->thumbnail)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $blog->thumbnail) }}" 
                                     alt="{{ $blog->title }}" 
                                     class="w-32 h-32 object-cover rounded border">
                            </div>
                        @endif
                        
                        <input type="file" 
                               name="thumbnail" 
                               id="thumbnail"
                               accept="image/*"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image. Recommended size: 1200x630px</p>
                        @error('thumbnail')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Published Status -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Is Published Checkbox -->
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   name="is_published" 
                                   id="is_published" 
                                   value="1"
                                   {{ old('is_published', $blog->is_published) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <label for="is_published" class="ml-2 block text-sm text-gray-700">
                                Published
                            </label>
                        </div>
                        
                        <!-- Published At -->
                        <div>
                            <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                                Publish Date
                            </label>
                            <input type="datetime-local" 
                                   name="published_at" 
                                   id="published_at" 
                                   value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>
                    </div>
                    
                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <a href="{{ route('admin.blog.index') }}" 
                           class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Update Post
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection