<div class="form-group">
    <label for="title">Post title</label>
    <input type="text" name="title" id="title" class="form-control"
        value="{{ old('title', optional($post ?? null)->title) }}">
</div>
<div class="form-group">
    <label for="content">Post content</label>
    <textarea name="content" id="content" class="form-control" cols="30" rows="10">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>

<div class="form-group">
    <label >Thumbnail</label>
    <input type="file" name="thumbnail" class="form-control-file">
</div>

@errors
@enderrors