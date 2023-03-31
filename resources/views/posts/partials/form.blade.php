<div class="form-group">
    <label for="title">Post title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', optional($post ?? null)->title )}}"></div>
@error('title')
    <div class="alert alert-danger"> {{ $message }} </div>
@enderror
<div class="form-group">
    <label for="content">Post content</label>
    <textarea name="content" id="content" class="form-control" cols="30" rows="10">{{ old('content', optional($post ?? null)->content )}}</textarea></div>

@if($errors->any())
        <div class="mb-3">
            <ul class="list-group">
                @foreach ($errors->all() as $error)

                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>

                @endforeach

            </ul>
        </div>
        @endif