<div class="form-group">
    <label for="title">{{ __('Title') }}</label>
    <input type="text" name="title" id="title" class="form-control"
        value="{{ old('title', optional($post ?? null)->title) }}">
</div>
<div class="form-group">
    <label for="content">{{ __('Content') }}</label>
    <textarea name="content" id="content" class="form-control" cols="30" rows="10">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>

<div class="form-group">
    <label>{{ __('Thumbnail') }}</label>
    <input type="file" name="thumbnail" class="form-control-file">
</div>

@errors
@enderrors
