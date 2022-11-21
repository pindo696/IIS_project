@extends('layouts.app')
@section('content')
<head>
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/all.css')}}" rel="stylesheet">
</head>

    <section class="container-fluid">
        
        @include('alertbox')

        <div class="container py-2">
                <h3 style="position: absolute;"class="mb-4 pb-2 pb-md-0 mb-md-3">
                    <button class="btn border-0"><h4 title="back to mp" style="margin: 0"><a
                                href="/vet/" style="color: black"><i class="fa-solid fa-arrow-left"></i></a>
                        </h4></button>
                    Back
                </h3>
                <div style="height: 300px;" class=" img-fluid p-1 bg-light">
                
                <img style="height: 250px; max-width: 300px;"class="img-thumbnail mx-auto d-block" src={{$examination[0]->photo_path ? asset('storage/' . $examination[0]->photo_path) : asset("images/default.png")}} alt="Animal"/>
                </div>
               
                <h1 style="text-align:center;"class="text-muted">{{$examination[0]->animal_name}}</h1>
                               

        </div>

        <div class="container py-2 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
    
                
                            <h1 style="text-align: center;">Manage Request</h1>
                            
                                <form action="/vet/request/savechange/" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="request_id" name="request_id" value="{{$examination[0]->examination_id}}">
                                  
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="examination_t">Examination Type *</label>
                                                <input value="{{$examination[0]->examination_type}}" type="text" name="examination_t" id="examination_t" class="form-control form-control-lg" required/>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                        
                                        <div class="col-md-12 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="examination_desc">Examination Description *</label>
                                                <textarea  maxlength="255" name="examination_desc" id="examination_desc" class="form-control form-control-lg" rows="5" required>{{$examination[0]->examination_description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-6 mb-4 d-flex align-items-center">
                                            <div class="form-outline datetimepicker w-100">
                                                <label for="examination_fr" class="form-label">Examination from</label>
                                                <input value="{{$examination[0]->examination_from}}" type="datetime-local" placeholder="DD-MM-YYYY" min="01-01-1900T08:30" name="examination_fr" class="form-control form-control-lg" id="examination_fr" data-date-format='d-m-Y'/>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4 d-flex align-items-center">
                                            <div class="form-outline datepicker w-100">
                                                <label for="examination_to" class="form-label">Examination to</label>
                                                <input value="{{$examination[0]->examination_to}}" type="datetime-local" placeholder="dd-mm-yyyy" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}T[0-9]{2}:[0-9]{2}" min="01-01-1900T08:30" name="examination_to" class="form-control form-control-lg" id="examination_to" data-date-format='d-m-Y'/>
                                            </div>
                                        </div>
                                        
                                       
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12 mb-4 pt-2">
                                        <h6 class="mb-2 pb-1">Status: *</h6>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="requested"
                                                   value="requested" @if($examination[0]->examination_status == "requested") checked @endif/>
                                            <label class="form-check-label" for="requested">Requested</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="planned"
                                                   value="planned" @if($examination[0]->examination_status == "planned") checked @endif/>
                                            <label class="form-check-label" for="planned">Planned</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="done"
                                                   value="done" @if($examination[0]->examination_status == "done") checked @endif/>
                                            <label class="form-check-label" for="done">Done</label>
                                            
                                        </div>
                                        
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="mt-12 pt-2 text-center">
                                        
                                        <input class="btn btn-warning btn-lg" type="submit" value="Save"/>
                                    </div>
                                    </div>
                                    
                                            
                                    {{-- 
                                    <div class="row">
                                        <div class="col-md-9 mb-4 pt-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="color">Color *</label>
                                                <input value="{{$result[0]->color}}" type="text" name="color" id="color" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4 pt-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="age">Age</label>
                                                <input value="{{$result[0]->animal_age}}" placeholder="years" name="age" type="number" min="0" max="150" id="age" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-4 pt-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="age">Description</label>
                                                <input value="{{$result[0]->animal_description}}" type="text" name="description" id="description" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 pt-2">
                                        <h6 class="mb-2 pb-1">Gender: *</h6>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name=" status" id="femaleGender"
                                                   value="female" @if($result[0]->gender == "female") checked @endif disabled="true"/>
                                            <label class="form-check-label" for="femaleGender">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name=" status" id="maleGender"
                                                   value="male" @if($result[0]->gender == "male") checked @endif disabled="true"/>
                                            <label class="form-check-label" for="maleGender">Male</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-2">
                                        <input class="btn btn-warning btn-lg" type="submit" value="Submit changes"/>
                                    </div> --}}
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
