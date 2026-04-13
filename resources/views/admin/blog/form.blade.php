<div>

<label>Title</label>

<input type="text" name="title"
value="{{ old('title', $blog->title ?? '') }}">

</div>


<div>

<label>Excerpt</label>

<textarea name="excerpt">
{{ old('excerpt', $blog->excerpt ?? '') }}
</textarea>

</div>


<div>

<label>Thumbnail</label>

<input type="file" name="thumbnail">

@if(isset($blog) && $blog->thumbnail)
    <br>
    <img src="{{ asset('storage/'.$blog->thumbnail) }}" width="120">
@endif

</div>


<div>

<label>Content</label>

<textarea name="content" id="editor">
{{ old('content', $blog->content ?? '') }}
</textarea>

</div>


<div>

<label>
<input type="checkbox" name="is_published"
{{ old('is_published', $blog->is_published ?? false) ? 'checked' : '' }}>

Publish
</label>

</div>


<button type="submit">
Save Article
</button>

<textarea name="content" id="editor"></textarea>

