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
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-3"><button class="btn border-0"><h4 title="back to animals" style="margin: 0"><a href="/careman/animals" style="color: black"><i class="fa-solid fa-arrow-left"></i></a></h4></button>Add Pet</h3>
                                <form action="/careman/animals/addpet/add" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <label class="form-label" for="name">Name *</label>
                                                <input value="{{ Session::get('name', '') }}" type="text" name="name" id="name" class="form-control form-control-lg" required/>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <label class="form-label" for="species">Species *</label>
                                                <input value="{{ Session::get('species', '') }}" type="text" name="species" id="species" class="form-control form-control-lg" required/>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        @if(Session::has('dateError'))
                                        <div class="col-md-6 mb-4 d-flex align-items-center">

                                            <div class="form-outline datepicker w-100">
                                                <label for="discoveryDate" class="form-label">Discovery Date</label>
                                                <input type="date" placeholder="dd-mm-yyyy" min="01.01.1900" name="discoveryDate" class="form-control form-control-lg is-invalid" id="discoveryDate" data-date-format='d-m-Y'/>
                                            </div>

                                        </div>
                                        @else
                                            <div class="col-md-6 mb-4 d-flex align-items-center">

                                                <div class="form-outline datepicker w-100">
                                                    <label for="discoveryDate" class="form-label">Discovery Date</label>
                                                    <input type="date" placeholder="dd-mm-yyyy" min="01.01.1900" name="discoveryDate" class="form-control form-control-lg" id="discoveryDate" data-date-format='d-m-Y'/>
                                                </div>

                                            </div>
                                        @endif
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <label class="form-label" for="discoveryPlace">Discovery place</label>
                                                <input value="{{ Session::get('discoveryPlace', '') }}" type="text" name="discoveryPlace" id="discoveryPlace" class="form-control form-control-lg" />
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-9 mb-4 pt-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="color">Color *</label>
                                                <input value="{{ Session::get('color', '') }}" type="text" name="color" id="color" class="form-control form-control-lg" />
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-4 pt-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="age">Age</label>
                                                <input value="{{ Session::get('age', '') }}" placeholder="years" name="age" type="number" min="0" max="150" id="age" class="form-control form-control-lg" />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-4 pt-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="age">Description</label>
                                                <input value="{{ Session::get('description', '') }}" type="text" name="description" id="description" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4 pt-2">

                                        <h6 class="mb-2 pb-1">Gender: *</h6>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender"
                                                   value="female" checked />
                                            <label class="form-check-label" for="femaleGender">Female</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender"
                                                   value="male" />
                                            <label class="form-check-label" for="maleGender">Male</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-2">
                                        <input class="btn btn-warning btn-lg" type="submit" value="Add pet"/>
                                    </div>

                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
