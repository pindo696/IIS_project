@extends('layouts.app')
@section('content')
<div style="width: 80%; margin: auto; text-align: center;">
<h1 style="margin-bottom: 2rem;"> Animal Shelter Of Gray Paw</h1>

<p>Animal shelter that takes care of many species of animals. Including but not limited to cats, dogs, birds, fish and squirrels.  </p>

<p>We take good care of abandoned animals including medical checkups and scheduled walks. We rely primarily on volunteers to
    take some tamer animals for walk. If your apartment won`t allow animals, this is great opportunity for you to spend some time with one of ours
abandoned pets. You can register online and apply for a walk with a pet of your choice.
We sincerely thank every participant in place of our pets. </p>
<div class="container py-2">
    <div class="row">

        <div class="col-lg-7" style="margin: auto; width: 80%;">
            <div class="card mb-4" style="text-align: center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="mb-0">Shelter Name</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted mb-0">Gray Paw</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="mb-0">Location</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted mb-0">Brno, Purkyňova 1243</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="mb-0">Opening Hours</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted mb-0">Daily 8:00 - 18:00</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted mb-0"><a class="page-link" href=mailto:"graypaw@gmail.com">graypaw@gmail.com</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="mb-0">Phone Number</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted mb-0">+421 950 712 630</p>
                        </div>
                    </div>
                    </hr>
                </div>
            </div>
        </div>
        {{--                @endforeach--}}
    </div>
</div>

</div>

@endsection
