@if(Session::has('dateError'))
    <div class="alert alert-danger">
        <strong>Invalid date!</strong> {{ Session::get('message', '') }}
    </div>
@endif
