@extends('layouts.app')
@section('content')
    <section class="container-fluid">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-3">Add Pet</h3>
                                <form>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <label class="form-label" for="name">Name *</label>
                                                <input type="text" id="name" class="form-control form-control-lg" required/>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <label class="form-label" for="spiece">Specie *</label>
                                                <input type="text" id="spiece" class="form-control form-control-lg" required/>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4 d-flex align-items-center">

                                            <div class="form-outline datepicker w-100">
                                                <label for="discoveryDate" class="form-label">Discovery Date</label>
                                                <input type="date" class="form-control form-control-lg" id="discoveryDate" />
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <label class="form-label" for="discoveryPlace">Discovery place</label>
                                                <input type="text" id="discoveryPlace" class="form-control form-control-lg" />
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-9 mb-4 pt-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="description">Description</label>
                                                <input type="text" id="description" class="form-control form-control-lg" />
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-4 pt-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="age">Age</label>
                                                <input placeholder="years" type="number" min="0" max="150" id="age" class="form-control form-control-lg" />
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-6 mb-4 pt-2">

                                        <h6 class="mb-2 pb-1">Gender: *</h6>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender"
                                                   value="option1" checked />
                                            <label class="form-check-label" for="femaleGender">Female</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender"
                                                   value="option2" />
                                            <label class="form-check-label" for="maleGender">Male</label>
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-2">
                                        <input class="btn btn-warning btn-lg" type="submit" value="Add pet" />
                                    </div>


                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
