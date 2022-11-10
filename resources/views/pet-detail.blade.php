@extends('layouts.app')
@section('content')
    <head>
        <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
        <link href="{{asset('css/all.css')}}" rel="stylesheet">
    </head>
    <section class="container-fluid">
        @foreach($result as $pet)
        @include('alertbox')
        <div class="container py-2">
            <div class="row">
                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-3"><button class="btn border-0"><h4 title="back to animals" style="margin: 0"><a href="/careman/animals" style="color: black"><i class="fa-solid fa-arrow-left"></i></a></h4></button>Back To Pets List</h3>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src = "{{asset('public/uploads/animal_images/'.$pet->photo_path)}}"
                                 alt = "Pet photo" height = "250" width = "270" />
                            <h5 class="my-3">{{$pet->name}}</h5>
                            <p class="text-muted mb-1">posledné očkovanie</p>
                            <p class="text-muted mb-4">nejaký ďalší medical info alebo či je zviera free for walk</p>
                            <div class="d-flex justify-content-center mb-2">
                                @if(Auth::user()->role == "admin" || Auth::user()->role == "careman")
                                    <form action="/careman/animals/pet-edit/" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" id="animal_id" name="animal_id" value="{{$pet->animal_id}}">
                                        <button type="submit" class="btn btn-outline-primary ms-1">Edit Pet</button>
                                    </form>
                                    <form action="/careman/animals/pet-schedule/" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" id="animal_id" name="animal_id" value="{{$pet->animal_id}}">
                                        <button type="submit" class="btn btn-outline-primary ms-1">Schedule</button>
                                    </form>
                                    <form action="/careman/animals/pet-edit/delete" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" id="animal_id" name="animal_id" value="{{$pet->animal_id}}">
                                        <button type="submit" class="btn btn-outline-danger ms-1">Delete</button>
                                    </form>
                                @else
                                    <form action="/careman/animals/pet-schedule" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" id="animal_id" name="animal_id" value="{{$pet->animal_id}}">
                                        <button type="submit" class="btn btn-outline-primary ms-1">Schedule</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$pet->name}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Species</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$pet->species}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Color</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$pet->color}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Age (years)</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$pet->age}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Gender</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$pet->gender}}</p>
                                </div>
                            </div>
                            </hr>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Discovery Date</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$pet->discovery_date}}</p>
                                </div>
                            </div>
                            </hr>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Discovery Place</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$pet->discovery_place}}</p>
                                </div>
                            </div>
                            </hr>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Description</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$pet->description}}</p>
                                </div>
                            </div>
                            </hr>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
