<head>
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/all.css')}}" rel="stylesheet">

</head>
@extends('layouts.app')
@section('content')
    <section class="container-fluid">
        @include('alertbox')
        <div class="container py-2">
            <div class="row">
                <form action="/careman/animals/pet-detail" method="POST">
                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-3">
                        <button type="submit" class="btn border-0"><h4 title="back to animals" style="margin: 0">
                                @csrf
                                @method('POST')
                                <input type="hidden" id="animal_id" name="animal_id" value="{{$result[0]->animal_id}}">
                                <a style="color: black"><i class="fa-solid fa-arrow-left"></i></a>
                            </h4></button>
                        Back To Edit Pet
                    </h3>
                </form>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            @if($result[0]->photo_path)
                                <img height="250" width="270" class="img-thumbnail border-0 shadow-none" src={{asset('storage/' . $result[0]->photo_path)}} alt="PetPicture"/>
                            @endif
                            <h5 class="my-3">{{$result[0]->animal_name}}</h5>

                            <p class="text-muted mb-1">posledné očkovanie</p>
                            <p class="text-muted mb-4">nejaký ďalší medical info alebo či je zviera free for
                                walk</p>
                            <div class="d-flex justify-content-center mb-2">
                                @if(Auth::user()->role == "admin" || Auth::user()->role == "careman")
                                    <form action="/careman/animals/request-examination/" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" id="animal_id" name="animal_id"
                                               value="{{$result[0]->animal_id}}">
                                        <input type="hidden" id="animal_name" name="animal_name"
                                               value="{{$result[0]->animal_name}}">
                                        <button type="submit" class="btn btn-outline-success ms-1">Request
                                            Examination
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$result[0]->animal_name}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Species</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$result[0]->species}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Color</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$result[0]->color}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Age (years)</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$result[0]->animal_age}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Gender</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$result[0]->gender}}</p>
                                </div>
                            </div>
                            </hr>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Discovery Date</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$result[0]->discovery_date}}</p>
                                </div>
                            </div>
                            </hr>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Discovery Place</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$result[0]->discovery_place}}</p>
                                </div>
                            </div>
                            </hr>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Description</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$result[0]->animal_description}}</p>
                                </div>
                            </div>
                            </hr>
                        </div>
                    </div>

                </div>
                {{-----------------------------------------  EXAMINATION PART -----------------------------------------------------}}
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-3">
                                    <b>Date</b>
                                </div>
                                <div class="col-sm-3">
                                    <b>Examination Type</b>
                                </div>
                                <div class="col-sm-3">
                                    <b>Vet</b>
                                </div>
                                <div class="col-sm-2">
                                    <b>Status</b>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0px">
                            <div class="accordion accordion-flush" id="accordionFlushExample">

                                @php ($style = '')
                                @foreach($result as $data)
                                    @if($data->examination_id)
                                        @if($data->examination_status == "requested")
                                            @php ($style = 'text-orange')
                                        @endif
                                        @if($data->examination_status == "done")
                                            @php ($style = 'text-success')
                                        @endif
                                        @if($data->examination_status == "planned")
                                            @php ($style = 'text-primary')
                                        @endif

                                        <div class="accordion-item">
                                            <h2 class="accordion-header"  id="flush-{{$data->examination_id}}">
                                                <button style="background-color: white" class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapse{{$data->examination_id}}"
                                                        aria-controls="flush-collapse{{$data->examination_id}}">
                                                    <div class="col-sm-3">
                                                        {{$data->examination_from}}
                                                    </div>
                                                    <div class="col-sm-3">
                                                        {{$data->examination_type}}
                                                    </div>
                                                    <div class="col-sm-3">
                                                        {{$data->name}}
                                                    </div>
                                                    <div class="col-sm-2 {{$style}}">
                                                        {{$data->examination_status}}
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="flush-collapse{{$data->examination_id}}"
                                                 class="ccordion-collapse collapse"
                                                 aria-labelledby="flush-{{$data->examination_id}}"
                                                 data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @if($data->examination_status == "requested")
                                                        <div class="row align-middle">
                                                            <div class="col-sm-11">
                                                                {{$data->examination_description}}
                                                            </div>
                                                            <div class="col-sm-1 d-flex justify-content-end">
                                                                <form action="/careman/examination/examination-request/delete" method="POST">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <input type="hidden" id="animal_id" name="animal_id"
                                                                           value="{{$result[0]->animal_id}}">
                                                                    <input type="hidden" name="examination_id" value="{{$data->examination_id}}">
                                                                    <button title="Delete examination" type="submit" class="btn text-danger fa-solid fa-trash-can"></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        @else
                                                            {{$data->examination_description}}
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <b class="text-danger text-center">No records yet!</b>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

