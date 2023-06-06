@extends('layouts.app')

@section('content')
<form action="{{ route ('users.update', ['user' => $user->id])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="row">
    <div class="col-4">

        <img src="{{ $user->image ? $user->image->url() : '' }}" alt="" srcset="" class="img-thumbnail avatar">

        <div class="card mt-4">
            <div class="card-body">
                <h6>Upload a different photo</h6>
                <input type="file" name="avatar" class="form-control-file">
            </div>
        </div>
    </div>
    <div class="col-8">

        <div class="form-group">
            <label for="">Name:</label>
            <input class="form-control" name="name" type="text">
        </div>

        @errors @enderrors

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Save Changes">
        </div>
    </div>
</div>
</form>
@endsection