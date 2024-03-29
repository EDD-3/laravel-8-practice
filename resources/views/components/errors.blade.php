{{-- Component for displaying form errors --}}
@if ($errors->any())
    <div class="mt-2 mb-2">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach

        </ul>
    </div>
@endif