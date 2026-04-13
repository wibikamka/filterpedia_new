@props([
    'name' => 'content',
    'value' => '',
    'height' => 500,
    'required' => false
])

@php
    $id = 'editor-' . Str::random(8);
@endphp

<textarea
    id="{{ $id }}"
    name="{{ $name }}"
    class="w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
    style="height: {{ $height }}px;"
    {{ $required ? 'required' : '' }}
>{{ old($name, $value) }}</textarea>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof tinymce !== 'undefined') {
        // Hancurkan editor yang sudah ada untuk ID ini
        if (tinymce.get('{{ $id }}')) {
            tinymce.get('{{ $id }}').remove();
        }
        
        // Inisialisasi editor baru
 tinymce.init({
    selector: '#{{ $id }}',
    height: {{ $height }},

    plugins: 'lists link image table code fullscreen preview',
    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code preview',

    menubar: true,
    branding: false,

    // 🔥 WAJIB: aktifkan upload
    automatic_uploads: true,
images_upload_url: '{{ route('admin.blog.upload-image') }}',

images_upload_handler: function (blobInfo, progress) {
    return new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route('admin.blog.upload-image') }}');

        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        xhr.setRequestHeader('Accept', 'application/json');

        xhr.upload.onprogress = function (e) {
            progress(e.loaded / e.total * 100);
        };

        xhr.onload = function () {
            if (xhr.status !== 200) {
                reject('HTTP Error: ' + xhr.responseText);
                return;
            }

            let json;
            try {
                json = JSON.parse(xhr.responseText);
            } catch (e) {
                console.error(xhr.responseText);
                reject('Invalid JSON response');
                return;
            }

            resolve(json.location);
        };

        xhr.onerror = function () {
            reject('Upload error');
        };

        let formData = new FormData();
        formData.append('image', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    });
},

    setup: function(editor) {
        editor.on('init', function() {
            console.log('TinyMCE initialized for: {{ $id }}');
        });

        editor.on('change', function() {
            editor.save();
        });
    }
});
    } else {
        console.error('TinyMCE not loaded');
    }
});

// **FIX VALIDATION**: Handle form submission untuk memastikan textarea terisi
document.addEventListener('submit', function(e) {
    const form = e.target;
    const editor = tinymce.get('{{ $id }}');
    
    if (editor && form.contains(document.getElementById('{{ $id }}'))) {
        // Paksa update textarea dengan content editor
        editor.save();
        
        // Jika required dan kosong, cegah submit
        @if($required)
            const content = editor.getContent().trim();
            if (!content || content === '<p></p>' || content === '<p><br data-mce-bogus="1"></p>') {
                e.preventDefault();
                alert('Content field is required.');
                editor.focus();
                return false;
            }
        @endif
    }
});
</script>
@endpush