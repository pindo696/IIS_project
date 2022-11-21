@extends('layouts.app')
@section('content')
    <head>
        <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
        <link href="{{asset('css/all.css')}}" rel="stylesheet">
    </head>
    <section class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Auth::user()->role == "admin" || Auth::user()->role == "careman")
                    <form action="/careman/animals/pet-detail" method="POST">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-3">
                            <button type="submit" class="btn border-0"><h4 title="back to animals" style="margin: 0">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" id="animal_id" name="animal_id" value="{{$result['animal']}}">
                                    <a style="color: black"><i class="fa-solid fa-arrow-left"></i></a>
                                </h4></button>
                            Back To Pet
                        </h3>
                    </form>
                    @include('successbox')
                    @include('errorbox')
                    <div class="row">
                        <div class="col-lg-12 text-center mb-3">
                            <form action="/careman/animals/createScheduleItem" method="POST">
                                @csrf
                                @method('POST')
                                <button class="btn btn-info" type="submit">
                                    Create schedule item
                                </button>
                                <input type="hidden" name="animal_id" value="{{$result['animal']}}">
                            </form>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header text-center">
                        <div class="col-md-12"> {{ __('Pet Schedule') }} </div>
                    </div>
                    <div class="card-body">
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-sm-2 text-center mt-0" style="font-weight: bold">
                                    From
                                </div>
                                <div class="col-sm-2 text-center mt-0" style="font-weight: bold">
                                    To
                                </div>
                                <div class="col-sm-3 text-center mt-0" style="font-weight: bold">
                                    Status
                                </div>
                                <div class="col-sm-3 text-center mt-0" style="font-weight: bold">
                                    Reserved/Requested by
                                </div>
                                <div class="col-sm-2 text-center mt-0" style="font-weight: bold">
                                    Action
                                </div>
                            </div>
                            <hr>
                            @foreach($result['upcomming'] as $key=>$data)
                                @php ($style = '#FFFFFF')
                                @if($data->reservation_status == 'listed')
                                    @php ($style = 'text-primary')
                                @endif
                                @if($data->reservation_status == 'requested')
                                    @php ($style = 'text-orange')
                                @endif
                                @if($data->reservation_status == 'declined')
                                    @php ($style = 'text-danger fw-bold')
                                @endif
                                @if($data->reservation_status == 'approved')
                                    @php ($style = 'text-success fw-bold')
                                @endif
                                <div class="row justify-content-center">
                                    <div class="col-sm-2 text-center mt-2">
                                        {{$data->reservation_from}}
                                    </div>
                                    <div class="col-sm-2 text-center mt-2">
                                        {{$data->reservation_to}}
                                    </div>
                                    <div class="col-sm-3 text-center mt-2 {{$style}}">
                                        {{$data->reservation_status}}
                                    </div>
                                    <div class="col-sm-3 text-center mt-2">
                                        {{$data->name." ".$data->surname}}
                                    </div>
                                    <div class="col-sm-2 text-center mt-2">
                                        <div class="d-inline-block">
                                            @if($data->reservation_status == 'requested')
                                                <form class="d-inline" action="/careman/acceptWalk/" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" id="request_id" name="request_id"
                                                           value="{{$data->reservation_id}}">
                                                    <button title="Accept walk" type="submit"
                                                            class="btn text-success fa-solid fa-check"></button>
                                                </form>
                                                <form class="d-inline" action="/careman/declineWalk/" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" id="request_id" name="request_id"
                                                           value="{{$data->reservation_id}}">
                                                    <button title="Decline walk" type="submit"
                                                            class="btn text-danger fa-solid fa-xmark"></button>
                                                </form>
                                        @elseif($data->reservation_status == 'listed')
                                            <form class="d-inline" action="/careman/deleteWalk/" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" id="reservation_id" name="reservation_id"
                                                       value="{{$data->reservation_id}}">
                                                <button title="Delete walk" type="submit"
                                                        class="btn text-danger fa-solid fa-trash-can"></button>
                                            </form>
                                        @elseif($data->reservation_status == 'approved')
                                            <form class="d-inline" action="/careman/declineWalk/" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" id="request_id" name="request_id"
                                                       value="{{$data->reservation_id}}">
                                                <button title="Decline walk" type="submit"
                                                        class="btn text-danger fa-solid fa-xmark"></button>
                                            </form>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <hr>
                            @foreach($result['past'] as $data)
                                @php ($style = '#FFFFFF')
                                @if($data->reservation_status == 'listed')
                                    @php ($style = 'text-primary')
                                @endif
                                @if($data->reservation_status == 'requested')
                                    @php ($style = 'text-orange')
                                @endif
                                @if($data->reservation_status == 'declined')
                                    @php ($style = 'text-danger')
                                @endif
                                @if($data->reservation_status == 'approved')
                                    @php ($style = 'text-success')
                                @endif
                                <div class="row">
                                    <div class="col-sm-2 text-center mt-2">
                                        {{$data->reservation_from}}
                                    </div>
                                    <div class="col-sm-2 text-center mt-2">
                                        {{$data->reservation_to}}
                                    </div>
                                    <div style="{{$style}}" class="col-sm-3 text-center mt-2 text-muted">
                                        {{$data->reservation_status}}
                                    </div>
                                    <div class="col-sm-3 text-center mt-2">
                                        {{$data->name." ".$data->surname}}
                                    </div>
                                    <div class="col-sm-2 text-center mt-2">
                                        <p class="text-muted"> in past </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
