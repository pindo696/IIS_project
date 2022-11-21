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
                            <form action="/careman/animals/createScheduleItem/add" method="POST">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="animal_id" value="{{$result}}">
                                @if(Session::has('dateError'))
                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">
                                        <div class="form-outline datepicker w-100">
                                            <label for="dateFrom" class="form-label">Date from</label>
                                            <input type="date" placeholder="dd-mm-yyyy" min="01.01.1900" name="dateFrom" class="form-control form-control-lg is-invalid" data-date-format='d-m-Y'/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 d-flex align-items-center">
                                        <div class="form-outline datepicker w-100">
                                            <label for="dateTo" class="form-label">Date to</label>
                                            <input type="date" placeholder="dd-mm-yyyy" min="01.01.1900" name="dateTo" class="form-control form-control-lg is-invalid" data-date-format='d-m-Y'/>
                                        </div>
                                    </div>
                                </div>
                                @else
                                    <div class="row">
                                        <div class="col-md-6 mb-4 d-flex align-items-center">
                                            <div class="form-outline datepicker w-100">
                                                <label for="dateFrom" class="form-label">Date from *</label>
                                                <input type="date" placeholder="dd-mm-yyyy" min="01.01.1900" name="dateFrom" class="form-control form-control-lg" data-date-format='d-m-Y'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4 d-flex align-items-center">
                                            <div class="form-outline datepicker w-100">
                                                <label for="dateTo" class="form-label">Date to *</label>
                                                <input type="date" placeholder="dd-mm-yyyy" min="01.01.1900" name="dateTo" class="form-control form-control-lg" data-date-format='d-m-Y'/>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-12 text-center mt-4 pt-2">
                                        <input class="btn btn-info btn-lg" type="submit" value="Create schedule item"/>
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
