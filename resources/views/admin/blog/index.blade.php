@extends('layout.admin')

@section('title', 'Blog Posts')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Blog Posts</h1>
            <a href="{{ route('admin.blog.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                + Create New Post
            </a>
        </div>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published At</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($posts as $post)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $post->title }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($post->excerpt, 50) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ ucfirst($post->category) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($post->is_published)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Published
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $post->published_at ? $post->published_at->format('d M Y H:i') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <a href="{{ route('admin.blog.edit', $post) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                <form action="{{ route('admin.blog.destroy', $post) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No posts found. <a href="{{ route('admin.blog.create') }}" class="text-blue-600">Create your first post</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection