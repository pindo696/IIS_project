@extends('layouts.app')
@section('content')
@include('caremanheader')

<head>
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/all.css')}}" rel="stylesheet">
</head>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">{{ __('Volunteer requests') }}</div>
                    <div class="card-body">
                        <table class="table text-center">
                            <thead class="bg-white">
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($result['volunteers'] as $data)
                                @php ($style = '#FFFFFF')
                            @if($data->confirmation == 'waiting')
                                @php ($style = 'text-orange')
                            @endif
                            @if($data->confirmation == 'accepted')
                                @php ($style = 'text-success')
                            @endif
                            @if($data->confirmation == 'declined')
                                @php ($style = 'text-danger')
                            @endif
                                <tr class="alert text-center" role="alert">
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->surname}}</td>
                                    <td>{{$data->email}}</td>
                                    @if($data->confirmation == 'banned')
                                        <td class="{{$style}}"><b>{{$data->confirmation}}</b></td>
                                    @else
                                        <td class="{{$style}}">{{$data->confirmation}}</td>
                                        @endif
                                    <td style="text-align: left;">
                                        @if($data->confirmation == 'accepted')
                                            <form action="/careman/banVolunteer" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" id="data_id" name="data_id" value="{{$data->id}}">
                                                <button title="Ban volunteer" class="btn text-danger fa-solid fa-ban"></button>
                                            </form>
                                        @elseif($data->confirmation == 'declined')
                                            <form action="/careman/acceptVolunteer" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" id="data_id" name="data_id" value="{{$data->id}}">
                                                <button title="Accept volunteer" type="submit" class="btn text-success fa-solid fa-check"></button>
                                            </form>
                                        @elseif($data->confirmation == 'banned')
                                            <form action="/careman/deleteVolunteer" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" id="data_id" name="data_id" value="{{$data->id}}">
                                                <button title="Delete user" type="submit" class="btn text-danger fa-solid fa-trash-can"></button>
                                            </form>
                                        @else
                                            <div class="d-inline-block">
                                                <form class="d-inline" action="/careman/acceptVolunteer" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" id="data_id" name="data_id" value="{{$data->id}}">
                                                    <button title="Accept volunteer" type="submit" class="btn text-success fa-solid fa-check"></button>
                                                </form>
                                                <form class="d-inline" action="/careman/declineVolunteer" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" id="data_id" name="data_id" value="{{$data->id}}">
                                                    <button title="Decline volunteer" type="submit" class="btn text-danger fa-solid fa-xmark"></button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">{{ __('Requests for walk') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2 text-center mt-2" style="font-weight: bold">
                                From
                            </div>
                            <div class="col-sm-2 text-center mt-2" style="font-weight: bold">
                                To
                            </div>
                            <div class="col-sm-3 text-center mt-2" style="font-weight: bold">
                                Animal
                            </div>
                            <div class="col-sm-3 text-center mt-2" style="font-weight: bold">
                                Requested by
                            </div>
                            <div class="col-sm-2 text-center mt-2" style="font-weight: bold">
                                Action
                            </div>
                        </div>
                        <hr class="mt-2">
                        @foreach($result['reservations']['upcomming'] as $data)
                            <div class="row mt-2 text-center">
                                <div class="col-sm-2 p-2">
                                    {{$data->reservation_from}}
                                </div>
                                <div class="col-sm-2 p-2">
                                    {{$data->reservation_to}}
                                </div>
                                <div class="col-sm-3 p-2">
                                    <form class="d-inline" action="/careman/animals/pet-detail" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="animal_id" value="{{$data->animal_id}}">
                                        <button type="submit" class="btn btn-link p-0">{{$data->animal_name}}</button>
                                    </form>
                                </div>
                                <div class="col-sm-3 p-2">
                                    {{$data->name." ".$data->surname}}
                                </div>
                                <div class="col-sm-2 p-2">
                                    <div class="d-inline-block">
                                        <form class="d-inline" action="/careman/acceptWalk/fromMain" method="POST">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="reservation_id" value="{{$data->reservation_id}}">
                                            <button title="Accept walk" type="submit" class="btn text-success fa-solid fa-check"></button>
                                        </form>
                                        <form class="d-inline" action="/careman/declineWalk/fromMain" method="POST">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="reservation_id" value="{{$data->reservation_id}}">
                                            <button title="Decline walk" type="submit" class="btn text-danger fa-solid fa-xmark"></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <hr>
                        @foreach($result['reservations']['past'] as $data)
                            <div class="row mt-2 text-center">
                                <div class="col-sm-2 p-2">
                                    {{$data->reservation_from}}
                                </div>
                                <div class="col-sm-2 p-2">
                                    {{$data->reservation_to}}
                                </div>
                                <div class="col-sm-3 p-2">
                                    <form class="d-inline" action="/careman/animals/pet-detail" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="animal_id" value="{{$data->animal_id}}">
                                        <button type="submit" class="btn btn-link p-0">{{$data->animal_name}}</button>
                                    </form>
                                </div>
                                <div class="col-sm-3 p-2">
                                    {{$data->name." ".$data->surname}}
                                </div>
                                <div class="col-sm-2 p-2">
                                    <div class="d-inline-block">
                                        <p class="text-muted">in past</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
