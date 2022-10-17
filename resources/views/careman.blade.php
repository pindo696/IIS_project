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
                            @foreach($result as $data)
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
                                            <form action="/careman/banVolunteer/" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" id="data_id" name="data_id" value="{{$data->id}}">
                                                <button title="Ban volunteer" class="btn text-danger fa-solid fa-ban"></button>
                                            </form>
                                        @elseif($data->confirmation == 'declined')
                                            <form action="/careman/acceptVolunteer/" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" id="data_id" name="data_id" value="{{$data->id}}">
                                                <button title="Accept volunteer" type="submit" class="btn text-success fa-solid fa-check"></button>
                                            </form>
                                        @elseif($data->confirmation == 'banned')
                                            <form action="/careman/deleteVolunteer/" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" id="data_id" name="data_id" value="{{$data->id}}">
                                                <button title="Delete user" type="submit" class="btn text-danger fa-solid fa-trash-can"></button>
                                            </form>
                                        @else
                                            <div class="d-inline-block">
                                            <form class="d-inline" action="/careman/acceptVolunteer/" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" id="data_id" name="data_id" value="{{$data->id}}">
                                                <button title="Accept volunteer" type="submit" class="btn text-success fa-solid fa-check"></button>
                                            </form>
                                            <form class="d-inline" action="/careman/declineVolunteer/" method="POST">
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

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
