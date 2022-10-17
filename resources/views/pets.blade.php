@extends('layouts.app')
@section('content')
@include('caremanheader')
<head>
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/all.css')}}" rel="stylesheet">
</head>
<div class="row justify-content-center">
    <a class="btn w-25 mb-3 border-warning justify-content-center d-flex text-center" href="/careman/animals/addpet" style="background-color: #ffffba">Add pet</a>
</div>
    <div class="row justify-content-center d-flex">
    <div class="col-md-10 ">
        <div class="card">
            <div class="card-header text-center">{{ __('Pets List') }}</div>
            <div class="card-body">
                <table class="table text-center">
                    <thead class="bg-white">
                    <tr>
                        <th>Name</th>
                        <th>Spiece</th>
                        <th>Discovery date</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
