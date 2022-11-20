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
                                href="/vet/" style="color: black"><i class="fa-solid fa-arrow-left"></i></a>
                        </h4></button>
                    Back
                </h3>
                <div style="height: 300px;" class=" img-fluid m-2 p-1 bg-light">
                
                <img style="height: 250px; max-width: 300px;"class="img-thumbnail mx-auto d-block" src={{$examination[0]->photo_path ? asset('storage/' . $examination[0]->photo_path) : asset("images/default.png")}} alt="Animal"/>
                </div>
                <div class="col-lg-7" style="margin: auto; width: 80%;">
                    <div class="card mb-4" style="text-align: center">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-4">Animal name</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-4">{{$examination[0]->animal_name}}</p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-4">Examination type</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-4">{{$examination[0]->examination_type}}</p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-4">Description</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-4">{{$examination[0]->examination_description}}</p>
                                </div>
                            </div>
                            




                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
