@extends('layouts.app')

@section('content')
<div class="container">

    @unless (count($animals) == 0)
    <div class="row justify-content-center p-2">
    @foreach ($animals as $animal)
        
            <div style="height: 300px;" class=" img-fluid col-3 border border-dark rounded m-2 p-1 bg-light">
                
                <img style="height: 150px; max-width: 200px;"class="img-thumbnail mx-auto d-block" src={{$animal->photo_path ? asset('storage/' . $animal->photo_path) : asset("images/default.png")}} alt="Animal"/>
                
                <div class="">
                    <h3 class="font-weight-bold d-flex justify-content-center"> 
                        Name: {{$animal['animal_name']}}
                    </h3>

                    <p class="font-weight-light d-flex justify-content-center">Species: {{$animal['species']}} </p>
                    <p class="font-weight-light d-flex justify-content-center">Age: {{$animal['animal_age']}} years</p>
                    <p class=" font-weight-light d-flex justify-content-center">Gender: {{$animal['gender']}}
                </div>
                
            </div>

    @endforeach
    </div>

    @else  
    <p>No animals are currently in the shelter.</p>
    @endunless
    <div style="width: 80%; margin: auto;">
        {!! $animals->links('pagination::bootstrap-5'); !!}
        </div>
</div>


@endsection