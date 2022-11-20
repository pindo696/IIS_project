@extends('layouts.app')
@section('content')
    <head>
        <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
        <link href="{{asset('css/all.css')}}" rel="stylesheet">
    </head>
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
            @endif
            <div class="card">
                <div class="card-header text-center">
                    <div class="col-md-12"> {{ __('Pet Schedule') }} </div>
                </div>
                <div class="card-body">
                    <div class="card-body pt-1">
                        <div class="row">
                            <div class="col-sm-4 text-center mt-0" style="font-weight: bold">
                                From
                            </div>
                            <div class="col-sm-4 text-center mt-0" style="font-weight: bold">
                                To
                            </div>
                            <div class="col-sm-4 text-center mt-0" style="font-weight: bold">
                               Reserved by volunteer
                            </div>
                        </div>
                        <hr>
                        @foreach($result['upcomming'] as $key=>$data)
                            <div class="row">
                                <div class="col-sm-4 text-center mt-2">
                                    {{$data->reservation_from}}
                                </div>
                                <div class="col-sm-4 text-center mt-2">
                                    {{$data->reservation_to}}
                                </div>
                                <div class="col-sm-4 text-center mt-2">
                                    {{$data->name." ".$data->surname}}
                                </div>
                            </div>
                        @endforeach
                        <hr>
                        @foreach($result['past'] as $data)
                            <div class="row">
                                <div class="col-sm-4 text-center mt-2">
                                    {{$data->reservation_from}}
                                </div>
                                <div class="col-sm-4 text-center mt-2">
                                    {{$data->reservation_to}}
                                </div>
                                <div class="col-sm-4 text-center mt-2">
                                    {{$data->name." ".$data->surname}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
