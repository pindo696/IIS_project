@extends('layouts.app')
@section('content')
<head>
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/all.css')}}" rel="stylesheet">
</head>
    <section class="container-fluid">
        
        @include('alertbox')



        <div class="container py-2">
            <div class="row">
                <h3 class="mb-4 pb-2 pb-md-0 mb-md-3">
                    <button class="btn border-0"><h4 title="back to mp" style="margin: 0"><a
                                href="/" style="color: black"><i class="fa-solid fa-arrow-left"></i></a>
                        </h4></button>
                    Back
                </h3>
                <div style="height: 300px;" class=" img-fluid m-2 p-1 bg-light">
                
                <img style="height: 250px; max-width: 300px;"class="img-thumbnail mx-auto d-block" src={{$animal[0]->photo_path ? asset('storage/' . $animal[0]->photo_path) : asset("images/default.png")}} alt="Animal"/>
                </div>
                <div class="col-lg-7" style="margin: auto; width: 80%;">
                    <div class="card mb-4" style="text-align: center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-0">Name</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-0">{{$animal[0]->animal_name}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-0">Species</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-0">{{$animal[0]->species}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-0">Color</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-0">{{$animal[0]->color}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-0">Age (years)</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-0">{{$animal[0]->animal_age}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-0">Gender</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-0">{{$animal[0]->gender}}</p>
                                </div>
                            </div>
                            </hr>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-0">Discovery Date</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-0">{{$animal[0]->discovery_date}}</p>
                                </div>
                            </div>
                            </hr>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-0">Discovery Place</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-0">{{$animal[0]->discovery_place}}</p>
                                </div>
                            </div>
                            </hr>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-0">Description</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-0">{{$animal[0]->animal_description}}</p>
                                </div>
                            </div>
                            </hr>
                        </div>
                    </div>
                </div>
                {{--                @endforeach--}}
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
