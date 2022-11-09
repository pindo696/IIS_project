@extends('layouts.app')
@section('content')
    @include('caremanheader')
    <head>
        <script>
        </script>
        <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
        <link href="{{asset('css/all.css')}}" rel="stylesheet">
    </head>
    @include('successbox')
    <div class="row justify-content-center">
        <a class="btn w-25 mb-3 border-warning justify-content-center d-flex text-center" href="/careman/animals/addpet" style="background-color: #ffffba">Add pet</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header text-center">{{ __('Pets List') }}</div>
                <div class="card-body">
                    <table class="table text-center">
                        <thead class="bg-white">
                        <tr>
                            <th>Name</th>
                            <th>Species</th>
                            <th>Discovery date</th>
                            <th>Discovery place</th>
                            <th>Age<small class="text-muted"> (years)</small></th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($result as $pet)
                         <tr class="alert text-center clickable" role="alert"><tr>
                                <td>{{$pet->name}}</a></td>
                                <td>{{$pet->species}}</td>
                                <td>{{$pet->discovery_date}}</td>
                                <td>{{$pet->discovery_place}}</td>
                                <td>{{$pet->age}}</td>
                                <td>
                                    <form action="/careman/animals/pet-detail" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" id="animal_id" name="animal_id" value="{{$pet->animal_id}}">
                                        <button title="show" class="btn text-primary fa-solid fa-eye"></button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
@endsection
