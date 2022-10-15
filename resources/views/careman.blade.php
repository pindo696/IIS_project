@extends('layouts.app')
@section('content')
@include('layouts.navigation.sidebar')

{{--@php--}}
{{--    $result = App\Http\Controllers\CaremanController::getVolunteers();--}}
{{--@endphp--}}

<head>
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/all.css')}}" rel="stylesheet">
</head>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">{{ __('Volunteer requests') }}</div>
                    <div class="card-body">
                        <table class="table text-center">
                            <thead class="bg-white">
                                <tr>
                                    <th>ID no.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($result as $data)
                                <tr class="alert text-center" role="alert">
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->surname}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>
                                        <i class="btn text-success fa-solid fa-check"></i>
                                        <i class="btn text-danger fa-solid fa-xmark"></i>
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
