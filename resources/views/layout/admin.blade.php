<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title','Dashboard')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
    
    <!-- TinyMCE Script -->
    <script src="https://cdn.tiny.cloud/1/40vy440sebz0w8witji31v8o8ml22lcky6sppgb6y3qx1t89/tinymce/6/tinymce.min.js"></script>
</head>
<body class="bg-gray-100 font-sans">

<header class="bg-white shadow p-4">
    <h1 class="text-xl font-bold">Admin Panel</h1>
</header>

<div class="flex">
    <aside class="w-64 bg-gray-200 min-h-screen p-4">
        <nav>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('admin.product.index') }}" class="text-gray-700 hover:text-blue-500">
                        Produk
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.blog.index') }}" class="text-gray-700 hover:text-blue-500">
                        Blog
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <main class="flex-1 p-6">
        @yield('content')
    </main>
</div>

@stack('scripts')

</body>
</html>