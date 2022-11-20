@extends('layouts.app')

@section('content')

<head>
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/all.css')}}" rel="stylesheet">
</head>
<div style="width:97%; margin:auto; text-align: center;"class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header text-center">{{ __('Animal examination requests') }}</div>
                <div class="card-body">
                    <table class="table text-center">
                        <thead class="bg-white">
                            <tr style="vertical-align: middle;">
                            <th>Applicant</th>
                            <th>Animal Name</th>
                            <th>Species</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Administer</th>
                            </tr>
                        </thead>
                        <tbody>
            
                            @foreach ($examinations as $examination)
                                @php ($style = '#FFFFFF')
                                @if($examination->examination_status == 'requested')
                                    @php ($style = 'text-orange')
                                @endif
                                @if($examination->examination_status == 'done')
                                    @php ($style = 'text-success')
                                @endif
                                @if($examination->examination_status == 'planned')
                                    @php ($style = 'text-info')
                                @endif
                                <tr style="vertical-align: middle;" class="alert text-center" role="alert">
                                <td>{{$examination->name . " " . $examination->surname}}</td>
                                <td>{{$examination->animal_name}}</td>
                                <td>{{$examination->species}}</td>
                                <td>{{$examination->examination_description}}</td>
                                <td class="{{$style}}">{{$examination->examination_status}}</td>
                                <td>  
                                    <form action="/vet/request/{{$examination->examination_id}}" method="POST">
                                        @csrf
                                        <input type="hidden" id="examination_id" name="examination_id" value="{{$examination->examination_id}}">
                                        <button title="Administer" class="btn text-primary fa-solid fa-book"></button>
                                    </form>
                                </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center">{{ __('Animal medical records') }}</div>
                <div class="card-body">
                    <table class="table text-center">
                        <thead class="bg-white">
                            <tr style="vertical-align: middle;">
                            <th>Animal ID</th>
                            <th>Animal Name</th>
                            <th>Species</th>
                            <th>Age</th>
                            <th>Show</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($records as $record)
                                <tr style="vertical-align: middle;" class="alert text-center" role="alert">
                                <td>{{$record->animal_id}}</td>
                                <td>{{$record->animal_name}}</td>
                                <td>{{$record->species}}</td>
                                <td>{{$record->animal_age}}</td>
                                <td>  
                                    <form action="/vet/records/animal/{{$record->animal_id}}" method="POST">
                                        @csrf
                                        <input type="hidden" id="animal_id" name="animal_id" value="{{$record->animal_id}}">
                                        <button title="Show records" class="btn text-primary fa-solid fa-eye"></button>
                                    </form>
                                </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
