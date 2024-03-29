@extends('layouts.app')

@section('content')

<head>
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/all.css')}}" rel="stylesheet">
</head>
<div style="width: 80%; margin: auto;" class="input-group">
    <form style="width:100%; margin-left: 5%;" action="/" method="GET">
        <div class="form-outline">
          <input value="{{request('search')}}" style="width:90%; margin: auto; padding-left: 15px;  border-radius: 8px; border-color: lightgray; border-width: 1px; height: 2rem" type="text" name="search" class=""
            placeholder="Search animals by name, species, age, color, gender or discovery location" />

        <button style="width:5%; min-width: 30px; height: 2rem;"type="submit" class="btn btn-primary"><i class="fa fa-search center" aria-hidden="true"></i></button>

        </div>
    </form>
</div>
<div class="container">

    @unless (count($animals) == 0)

    <div class="row justify-content-center p-2">
    @foreach ($animals as $animal)

            <div style="height: 300px;" class=" img-fluid col-3 border rounded m-2 p-1 bg-light">

                <a class="page-link" href="/animal/{{$animal->animal_id}}"><img style="height: 150px; max-width: 200px;"class="img-thumbnail mx-auto d-block" src={{$animal->photo_path ? asset('storage/' . $animal->photo_path) : asset("images/default.png")}} alt="Animal"/></a>

                <div class="">
                    <h3 class="font-weight-bold d-flex justify-content-center">
                        <a class="page-link" href="/animal/{{$animal->animal_id}}">{{$animal['animal_name']}}</a>
                    </h3>

                    <p class="font-weight-light d-flex justify-content-center">Species: {{$animal['species']}} </p>
                    <p class="font-weight-light d-flex justify-content-center">Age: {{$animal['animal_age']}} years</p>
                    <p class=" font-weight-light d-flex justify-content-center">Gender: {{$animal['gender']}}
                </div>

            </div>

    @endforeach
    </div>

    @else
    <h1 class="font-weight-bold d-flex justify-content-center" style="margin-top: 4rem;">Wow, so empty...</h1>
    <h3 class="font-weight-light d-flex justify-content-center" style="margin-top: 4rem;">No results found.</h3>
    @endunless
    <div style="width: 80%; margin: auto;">
        {!! $animals->links('pagination::bootstrap-5'); !!}
        </div>
</div>


@endsection
