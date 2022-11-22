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
    
    <div style="height: 300px;" class=" img-fluid m-2 p-1 bg-light">
    
    <img style="height: 250px; max-width: 300px;"class="img-thumbnail mx-auto d-block" src={{$pets[0]->photo_path ? asset('storage/' . $pets[0]->photo_path) : asset("images/default.png")}} alt="Animal"/>
    </div>

    <div class="card mb-4" style="text-align: center">
        <div class="card-body">

            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-4">Name</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted mb-4">{{$pets[0]->animal_name}}</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-4">Species</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted mb-4">{{$pets[0]->species}}</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-4">Gender</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted mb-4">{{$pets[0]->gender}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-4">Age</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted mb-4">{{$pets[0]->animal_age}}</p>
                </div>
            </div>
            




        </div>
    </div>
    
    <div class="col-md-12">
    @unless(sizeof($records) == 0)
        <div class="card">
            <div class="card-header text-center">{{ __('Animal medical records') }}</div>
            <div class="card-body">
                    
                <table class="table text-center">
                        <thead class="bg-white">
                            <tr style="vertical-align: middle;">
                            <th>Doctor</th>
                            <th>Record type</th>
                            <th>Notes</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                            <th>Update</th>
                            <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($records as $record)
                            <tr style="vertical-align: middle;" class="alert text-center" role="alert">
                                <form action="/vet/record/savechange" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="request_id" name="request_id" value="{{$record->examination_id}}">
                                    
                                <td>{{$record->name . " " . $record->surname}}</td>
                                <td><input @if($record->examination_status == "done") disabled @endif style="text-align: center;"value="{{$record->examination_type}}" type="text" name="examination_t" id="examination_t" class="form-control form-control-sm" required/></td>
                                <td><textarea @if($record->examination_status == "done") disabled @endif maxlength="255" name="vet_examination_notes" id="vet_examination_notes" class="form-control form-control-sm" rows="1" required>{{$record->vet_examination_notes}}</textarea>
                                </td>
                                <td><input @if($record->examination_status == "done") disabled @endif value="{{$record->examination_from}}" type="datetime-local" placeholder="DD-MM-YYYY" min="01-01-1900T08:30" name="examination_fr" class="form-control form-control-sm" id="examination_fr" data-date-format='d-m-Y'/></td>
                                <td><input @if($record->examination_status == "done") disabled @endif value="{{$record->examination_to}}" type="datetime-local" placeholder="DD-MM-YYYY" min="01-01-1900T08:30" name="examination_to" class="form-control form-control-sm" id="examination_to" data-date-format='d-m-Y'/></td>
                                
                            
                                <td>
                                    <select @if($record->examination_status == "done") disabled @endif class="form-control form-control-sm" id="status" name="status">
                                        <option @if($record->examination_status == "done") disabled @endif value="requested" @if($record->examination_status == "requested") selected="selected" @endif>requested</option>
                                        <option @if($record->examination_status == "done") disabled @endif value="planned" @if($record->examination_status == "planned") selected="selected" @endif>planned</option>
                                        <option @if($record->examination_status == "done") disabled @endif value="done" @if($record->examination_status == "done") selected="selected" @endif>done</option>
                                    </select>
                                </td>
                                <td>@if($record->examination_status == "done")  @else<button type="submit" class="btn text-success fa-solid fa-check"></button>@endif</td>
                                </form>
                                <form action="/vet/record/remove" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="req_id" name="req_id" value="{{$record->examination_id}}">
        
                                <td>@if($record->examination_status == "done")  @else <button  type="submit" class="btn text-danger fa-solid fa-xmark"></button> @endif</td>
                                </form>

                                </tr>
                            
                            @endforeach

                        </tbody>
                </table>
                    
            </div>
        </div>

    @else
    <h3 class="mb-5 mt-5" >This pet has no medical records yet.</h3>
    @endunless


        <div class="card">
            <div class="card-header pt-2 text-center">{{ __('Create animal medical record') }}</div>
                <div class="card-body">
                    
                    <table class="table text-center">
                        <thead class="bg-white">
                            <tr style="vertical-align: middle;">
                            <th>Doctor ID</th>
                            <th>Record type</th>
                            <th>Notes</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                            <th>Create</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr style="vertical-align: middle;" class="alert text-center" role="alert">
                                <form action="/vet/record/create" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="animal_id" name="animal_id" value="{{$pets[0]->animal_id}}">

                                <td><input style="text-align: center;"value="{{Auth::id()}}" type="text" name="doctorID" id="doctorID" class="form-control form-control-sm" required/></td>
                                <td><input style="text-align: center;"value="" type="text" name="examination_t" id="examination_t" class="form-control form-control-sm" required/></td>
                                <td><textarea  maxlength="255" name="vet_examination_notes" id="vet_examination_notes" class="form-control form-control-sm" rows="1" required></textarea>
                                </td>
                                <td><input value="" type="datetime-local" placeholder="DD-MM-YYYY" min="01-01-1900T08:30" name="examination_fr" class="form-control form-control-sm" id="examination_fr" data-date-format='d-m-Y'/></td>
                                <td><input value="" type="datetime-local" placeholder="DD-MM-YYYY" min="01-01-1900T08:30" name="examination_to" class="form-control form-control-sm" id="examination_to" data-date-format='d-m-Y'/></td>
                                
                            
                                <td>
                                    <select class="form-control form-control-sm" id="status" name="status">
                                        <option value="requested">requested</option>
                                        <option value="planned">planned</option>
                                        <option value="done" selected="selected">done</option>
                                    </select>
                                </td>
                                <td><button type="submit" class="btn text-success fa-solid fa-check"></button></td>
                                </form>
                        

                                </tr>
                            
                        </tbody>
                    </table>
                    
                </div>
        </div>



    </div>
    </div>

    
</div>
@endsection
