@extends('layouts.app')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <div class="col-md-12"> {{ __('Pet Schedule') }} </div>
                </div>
                <div class="card-body">
                    <div class="card-body pt-1">
                        <div class="row">
                            <div class="col-sm-3 text-center mt-0" style="font-weight: bold">
                                From
                            </div>
                            <div class="col-sm-3 text-center mt-0" style="font-weight: bold">
                                To
                            </div>
                            <div class="col-sm-3 text-center mt-0" style="font-weight: bold">
                                Volunteer
                            </div>
                            <div class="col-sm-3 text-center mt-0" style="font-weight: bold">
                                Approved by
                            </div>
                        </div>
                        <hr>
                        @foreach($result['upcomming'] as $data)
                            <div class="row">
                                <div class="col-sm-3 text-center mt-2">
                                    {{$data->reservation_from}}
                                </div>
                                <div class="col-sm-3 text-center mt-2">
                                    {{$data->reservation_to}}
                                </div>
                                <div class="col-sm-3 text-center mt-2">
                                    {{$data->name." ".$data->surname}}
                                </div>
                            </div>
                        @endforeach
                        <hr>
                        @foreach($result['past'] as $data)
                            <div class="row">
                                <div class="col-sm-3 text-center mt-2">
                                    {{$data->reservation_from}}
                                </div>
                                <div class="col-sm-3 text-center mt-2">
                                    {{$data->reservation_to}}
                                </div>
                                <div class="col-sm-3 text-center mt-2">
                                    {{$data->name." ".$data->surname}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
