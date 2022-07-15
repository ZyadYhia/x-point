{{-- @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif --}}
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <input type="hidden" name="errors[]" value="{{ $error }}">
    @endforeach

@endif
