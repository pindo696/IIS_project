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
                            <form action="/careman/animals/pet-detail/examinations" method="POST">
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-3">
                                    <button type="submit" class="btn border-0"><h4 title="pet examination"
                                                                                   style="margin: 0">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" id="animal_id" name="animal_id"
                                                   value="{{$result->animal_id}}">
                                            <a style="color: black"><i class="fa-solid fa-arrow-left"></i></a>
                                        </h4></button>
                                    Pet examination
                                </h3>
                            </form>
                            <form action="/careman/animals/pet-edit/request-examination/send" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <input type="hidden" id="animal_id" name="animal_id" value="{{$result->animal_id}}">
                                <input type="hidden" id="animal_name" name="animal_name" value="{{$result->animal_name}}">
                                <input type="hidden" id="careman_id" name="careman_id" value="{{Auth::user()->id}}">
                                <div class="row">
                                    <div class="col-md-12 mb-4 pt-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="examinationType">Examination type *</label>
                                            <select class="form-control" name="examinationType" id="examinationType" required>
                                                <option selected>Choose...</option>
                                                <option value="Prehliadka">Prehliadka</option>
                                                <option value="Očkovanie">Očkovanie</option>
                                                <option value="Vasektómia">Vasektómia</option>
                                                <option value="Strihanie">Strihanie</option>
                                                <option value="Lobotómia">Lobotómia</option>
                                                <option value="Kastrácia">Kastrácia</option>
                                                <option value="Strihanie pazúrov">Strihanie pazúrov</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-0 pt-0">
                                        <div class="form-outline">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea class="form-control" name="description" aria-label="With textarea"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-0 pt-0">
                                        <div class="mt-4 pt-2">
                                            <input class="btn btn-success btn-lg" type="submit" value="Create request"/>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
