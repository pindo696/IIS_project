@extends('layouts.app')

@section('content')

<head>
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/all.css')}}" rel="stylesheet">
</head>

<div style="width:97%; margin:auto; text-align: center;"class="row justify-content-center">
    <h3 class="mb-4 pb-2 pb-md-0 mb-md-3" style="text-align: left; position: absolute;">
        <button class="btn border-0"><h4 title="back to mp" style="margin: 0"><a
                    href="/vet/" style="color: black"><i class="fa-solid fa-arrow-left"></i></a>
            </h4></button>
        Back
    </h3>
    @unless(sizeof($records) == 0)
    <div style="height: 300px;" class=" img-fluid m-2 p-1 bg-light">
    
    <img style="height: 250px; max-width: 300px;"class="img-thumbnail mx-auto d-block" src={{$records[0]->photo_path ? asset('storage/' . $records[0]->photo_path) : asset("images/default.png")}} alt="Animal"/>
    </div>

    <div class="card mb-4" style="text-align: center">
        <div class="card-body">

            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-4">Name</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted mb-4">{{$records[0]->animal_name}}</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-4">Species</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted mb-4">{{$records[0]->species}}</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-4">Gender</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted mb-4">{{$records[0]->gender}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-4">Age</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted mb-4">{{$records[0]->animal_age}}</p>
                </div>
            </div>
            




        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center">{{ __('Animal medical records') }}</div>
                <div class="card-body">
                    
                    <table class="table text-center">
                        <thead class="bg-white">
                            <tr style="vertical-align: middle;">
                            <th>Doctor</th>
                            <th>Record type</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($records as $record)
                            <form action="/vet/record/savechange" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="request_id" name="request_id" value="{{$record->examination_id}}">
                                <tr style="vertical-align: middle;" class="alert text-center" role="alert">
                                <td>{{$record->name . " " . $record->surname}}</td>
                                <td><input style="text-align: center;"value="{{$record->examination_type}}" type="text" name="examination_t" id="examination_t" class="form-control form-control-sm" required/></td>
                                <td><input value="{{$record->examination_from}}" type="datetime-local" placeholder="DD-MM-YYYY" min="01-01-1900T08:30" name="examination_fr" class="form-control form-control-sm" id="examination_fr" data-date-format='d-m-Y'/></td>
                                <td><input value="{{$record->examination_to}}" type="datetime-local" placeholder="DD-MM-YYYY" min="01-01-1900T08:30" name="examination_to" class="form-control form-control-sm" id="examination_to" data-date-format='d-m-Y'/></td>
                                
                                <td><textarea  maxlength="255" name="examination_desc" id="examination_desc" class="form-control form-control-sm" rows="1" required>{{$record->examination_description}}</textarea>
                                </td>
                                <td>
                                    <select class="form-control form-control-sm" id="status" name="status">
                                        <option value="requested" @if($record->examination_status == "requested") selected="selected" @endif>requested</option>
                                        <option value="planned" @if($record->examination_status == "planned") selected="selected" @endif>planned</option>
                                        <option value="done" @if($record->examination_status == "done") selected="selected" @endif>done</option>
                                    </select>
                                </td>
                                <td><button type="submit" class="btn text-success fa-solid fa-check"></button></td>
                                
                            {{--
                                <td class="{{$style}}">{{$examination->examination_status}}</td>
                                <td>  
                                    <form action="/vet/request/{{$examination->examination_id}}" method="POST">
                                        @csrf
                                        <input type="hidden" id="examination_id" name="examination_id" value="{{$examination->examination_id}}">
                                        <button title="Administer" class="btn text-primary fa-solid fa-book"></button>
                                    </form>
                                </td> --}}
                                </tr>
                            </form>
                            @endforeach

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>

    @else
    <h3 class="mb-4 pb-2 pb-md-0 mb-md-3" style="margin-top: 15%;" >This pet has no medical records yet.</h3>
    @endunless
</div>
@endsection
