@extends('layouts.app')
@section('content')
    <head>
        <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
        <link href="{{asset('css/all.css')}}" rel="stylesheet">
    </head>
    <section class="container-fluid">
        @include('alertbox')
        <div class="container py-2 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            @foreach($result as $pet)
                                <form action="/careman/animals/pet-detail" method="POST">
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-3">
                                            <button type="submit" class="btn border-0"><h4 title="back to animals" style="margin: 0">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" id="animal_id" name="animal_id" value="{{$pet->animal_id}}">
                                            <a style="color: black"><i class="fa-solid fa-arrow-left"></i></a>
                                            </h4></button>Edit Pet</h3>
                                        </form>
                                <form action="/careman/animals/pet-edit/edit" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" id="animal_id" name="animal_id" value="{{$pet->animal_id}}">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="name">Name *</label>
                                                <input value="{{$pet->name}}" type="text" name="name" id="name" class="form-control form-control-lg" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="species">Species *</label>
                                                <input value="{{$pet->species}}" type="text" name="species" id="species" class="form-control form-control-lg" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if(Session::has('dateError'))
                                            <div class="col-md-6 mb-4 d-flex align-items-center">
                                                <div class="form-outline datepicker w-100">
                                                    <label for="discoveryDate" class="form-label">Discovery Date</label>
                                                    <input value="{{$pet->discovery_date}}" type="date" placeholder="dd-mm-yyyy" min="01.01.1900" name="discoveryDate" class="form-control form-control-lg is-invalid" id="discoveryDate" data-date-format='d-m-Y'/>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-6 mb-4 d-flex align-items-center">
                                                <div class="form-outline datepicker w-100">
                                                    <label for="discoveryDate" class="form-label">Discovery Date</label>
                                                    <input value="{{$pet->discovery_date}}" type="date" placeholder="dd-mm-yyyy" min="01.01.1900" name="discoveryDate" class="form-control form-control-lg" id="discoveryDate" data-date-format='d-m-Y'/>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="discoveryPlace">Discovery place</label>
                                                <input value="{{$pet->discovery_place}}" type="text" name="discoveryPlace" id="discoveryPlace" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 mb-4 pt-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="color">Color *</label>
                                                <input value="{{$pet->color}}" type="text" name="color" id="color" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4 pt-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="age">Age</label>
                                                <input value="{{$pet->age}}" placeholder="years" name="age" type="number" min="0" max="150" id="age" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-4 pt-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="age">Description</label>
                                                <input value="{{$pet->description}}" type="text" name="description" id="description" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 pt-2">
                                        <h6 class="mb-2 pb-1">Gender: *</h6>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender"
                                                   value="female" @if($pet->gender == "female") checked @endif disabled="true"/>
                                            <label class="form-check-label" for="femaleGender">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender"
                                                   value="male" @if($pet->gender == "male") checked @endif disabled="true"/>
                                            <label class="form-check-label" for="maleGender">Male</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-2">
                                        <input class="btn btn-warning btn-lg" type="submit" value="Submit changes"/>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
