
@extends('layouts.app')
@section('content')
<div class="row justify-content-center">

    <div class="col-md-8">
        <div class="card">
            <head>
                <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
                <link href="{{asset('css/all.css')}}" rel="stylesheet">
            </head>
            <table class="table table-striped mb-0">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Animal Name</th>
                    <th scope="col">Species</th>
                    <th scope="col">Age</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($result['upcomming'] as $data)
                    <tr>
                        <th scope="row">{{$data->reservation_id}}</th>
                        <td>{{$data->reservation_from}}</td>
                        <td>{{$data->reservation_to}}</td>
                        <td>
                            <form class="d-inline" action="/volunteer/pet-detail" method="POST">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="animal_id" value="{{$data->animal_id}}">
                                <button type="submit" class="btn btn-link p-0">{{$data->animal_name}}</button>
                            </form>
                        </td>
                        <td>{{$data->species}}</td>
                        <td>{{$data->animal_age}}</td>
                        @if($data->reservation_status == 'declined')
                            <td style="color: red">declined</td>
                        @endif
                        @if($data->reservation_status == 'requested')
                            <td style="color: lightseagreen">requested</td>
                        @endif
                        @if($data->reservation_status == 'approved')
                            <td style="color: green">approved</td>
                        @endif
                    </tr>
                @endforeach
                <tr style="background: dimgray">
                    <td style="padding: 3px;" ></td>
                    <td style="padding: 3px;"></td>
                    <td style="padding: 3px;"></td>
                    <td style="padding: 3px;"></td>
                    <td style="padding: 3px;"></td>
                    <td style="padding: 3px;"></td>
                    <td style="padding: 3px;"></td>
                </tr>
                @foreach($result['past'] as $data)
                    <tr>
                        <th scope="row">{{$data->reservation_id}}</th>
                        <td>{{$data->reservation_from}}</td>
                        <td>{{$data->reservation_to}}</td>
                        <td>
                            <form class="d-inline" action="/volunteer/pet-detail" method="POST">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="animal_id" value="{{$data->animal_id}}">
                                <button type="submit" class="btn btn-link p-0">{{$data->animal_name}}</button>
                            </form>
                        </td>
                        <td>{{$data->species}}</td>
                        <td>{{$data->animal_age}}</td>
                        @if($data->reservation_status == 'declined')
                            <td style="color: red">declined</td>
                        @endif
                        @if($data->reservation_status == 'requested')
                            <td style="color: lightseagreen">requested</td>
                        @endif
                        @if($data->reservation_status == 'approved')
                            <td style="color: green">approved</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
        </div>
@endsection
