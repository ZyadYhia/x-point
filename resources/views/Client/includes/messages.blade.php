@if (session('msg'))
    <input type="hidden" id="session_msg" value="{{ session('msg') }}">
@endif
@if (session('error'))
    <input type="hidden" id="session_error" value="{{ session('error') }}">
@endif
