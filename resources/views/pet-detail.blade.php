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
                @if(Auth::user()->role != 'volunteer')
                <h3 class="mb-4 pb-2 pb-md-0 mb-md-3">
                    <button class="btn border-0"><h4 title="back to animals" style="margin: 0"><a
                                href="/careman/animals" style="color: black"><i class="fa-solid fa-arrow-left"></i></a>
                        </h4></button>
                    Back To Pets List
                </h3>
                @elseif(Auth::user()->role == 'volunteer')
                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-3">
                        <button class="btn border-0"><h4 title="back to animals" style="margin: 0"><a
                                    href="/volunteer" style="color: black"><i class="fa-solid fa-arrow-left"></i></a>
                            </h4></button>
                        Back To History
                    </h3>
                @endif
                <div class="col-lg-5">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            @if($result[0]->photo_path)
                                <img height="250" width="270" class="img-thumbnail border-0 shadow-none" src={{asset('storage/' . $result[0]->photo_path)}} alt="PetPicture"/>
                            @endif
                            <h5 class="my-3">{{$result[0]->animal_name}}</h5>
                            <?php
                                $last = $result[0];
                                foreach($result as $data) {
                                    if ($data->examination_type == 'Očkovanie' && $data->examination_status == 'done') {
                                        $dateTimestamp1 = strtotime($data->examination_from);
                                        $dateTimestamp2 = strtotime($last->examination_from);
                                        if ($dateTimestamp1 >= $dateTimestamp2){
                                            $last = $data;
                                        }
                                    }
                                }
                                if($last->examination_type != 'Očkovanie'){
                                   echo '<p class="text-muted mb-2">Bez očkovania</p>';
                                }else{
                                    echo '<p class="text-muted mb-2">'.'Posledné očkovanie: '.substr($last->examination_from, 0 , 10).'</p>';
                                }
                            ?>
                            <div class="d-flex justify-content-center mb-2">
                                @if(Auth::user()->role == "admin" || Auth::user()->role == "careman")
                                    <form action="/careman/animals/pet-edit/" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" id="animal_id" name="animal_id"
                                               value="{{$result[0]->animal_id}}">
                                        <button type="submit" class="btn btn-outline-primary ms-1">Edit Pet</button>
                                    </form>
                                    <form action="/careman/animals/pet-schedule/" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" id="animal_id" name="animal_id"
                                               value="{{$result[0]->animal_id}}">
                                        <button type="submit" class="btn btn-outline-info ms-1">Schedule</button>
                                    </form>
                                    <form action="/careman/animals/pet-detail/examinations" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" id="animal_id" name="animal_id"
                                               value="{{$result[0]->animal_id}}">
                                        <button type="submit" class="btn btn-outline-success ms-1">Examinations</button>
                                    </form>
                                    <form action="/careman/animals/pet-edit/delete" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" id="animal_id" name="animal_id"
                                               value="{{$result[0]->animal_id}}">
                                        <button type="submit" class="btn btn-outline-danger ms-1">Delete</button>
                                    </form>
                                @else
                                    <form action="/volunteer/pet-schedule" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="volunteer_id"
                                               value="{{Auth::user()->id}}">
                                        <input type="hidden" name="animal_id"
                                               value="{{$result[0]->animal_id}}">
                                        <button type="submit" class="btn btn-outline-primary ms-1">Schedule</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
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
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
