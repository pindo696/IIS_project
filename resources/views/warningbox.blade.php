@if(Session::has('warning'))
    <div class="alert alert-warning">
        <strong>Success!</strong> {{ Session::get('message', '') }}
    </div>
@endif
