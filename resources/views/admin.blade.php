@extends('layouts.app')

@section('content')
<head>
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/all.css')}}" rel="stylesheet">
    @include('adminheader')
</head>
@include('alertbox')
@include('errorbox')
@include('successbox')

    <div style="width: 80%; margin: 30px auto 30px auto" class="input-group">
        <form style="width:100%; margin-left: 8%;" method="GET">
            <div class="form-outline">
                <input value="{{request('searchUser')}}" style="width:85%; margin: auto; padding-left: 15px;  border-radius: 8px; border-color: lightgray; border-width: 1px; height: 2rem" type="text" name="searchUser" class=""
                       placeholder="Search users by name, surname, role, email, number, confirmation state or age" />

                <button style="width:5%; min-width: 30px; height: 2rem;"type="submit" class="btn btn-primary"><i class="fa fa-search center" aria-hidden="true"></i></button>

            </div>
        </form>
    </div>
        @unless(sizeof($users) == 0)
        <div class="row justify-content-center">
            <div class="col-md-12">


                    <div class="card">
                        <div class="card-header text-center">{{ __('Manage Users') }}</div>
                        <div class="card-body">

                            <table class="table text-center">
                                    <thead class="bg-white">
                                        <tr style="vertical-align: middle;">
                                        <th>ID</th>
                                        <th style="width: 12%">Name</th>
                                        <th style="width: 12%">Surname</th>
                                        <th>Email</th>
                                        <th>Date of birth</th>
                                        <th style="width: 8%">Age</th>
                                        <th>Phone</th>
                                        <th  style="width: 8%">Role</th>
                                        <th>Confirmation</th>
                                        <th>Save</th>
                                        <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($users as $user)

                                        <tr style="vertical-align: middle;" class="alert text-center" role="alert">
                                            <form action="/admin/manage/user" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" id="user_id" name="user_id" value="{{$user['id']}}">
                                            <td>{{$user['id']}}</td>
                                            <td><input style="text-align: center;"value="{{$user['name']}}" type="text" name="name" id="name" class="form-control form-control-sm" required/></td>
                                            <td><input style="text-align: center;"value="{{$user['surname']}}" type="text" name="surname" id="surname" class="form-control form-control-sm" required/></td>
                                            <td><input style="text-align: center;"value="{{$user['email']}}" type="email" name="email" id="email" class="form-control form-control-sm" required/></td>
                                            <td><input value="{{$user['birth_date']}}" type="date" placeholder="DD-MM-YYYY" min="01-01-1900" name="birth_date" class="form-control form-control-sm" id="birth_date" data-date-format='d-m-Y'/></td>
                                            <td><input style="text-align: center;"value="{{$user['age']}}" type="number" name="age" id="age" class="form-control form-control-sm"/></td>
                                            <td><input style="text-align: center;"value="{{$user['phone']}}" type="tel" name="phone" id="phone" class="form-control form-control-sm" required/></td>

                                            <td>
                                                <select class="form-control form-control-sm" id="role" name="role">
                                                    <option value="admin" @if($user['role'] == "admin") selected="selected" @endif>admin</option>
                                                    <option value="careman" @if($user['role'] == "careman") selected="selected" @endif>careman</option>
                                                    <option value="vet" @if($user['role'] == "vet") selected="selected" @endif>vet</option>
                                                    <option value="volunteer" @if($user['role'] == "volunteer") selected="selected" @endif>volunteer</option>
                                                </select>
                                            </td>

                                            <td>
                                                <select class="form-control form-control-sm" id="confirmation" name="confirmation">
                                                    <option value="waiting" @if($user['confirmation'] == "waiting") selected="selected" @endif>waiting</option>
                                                    <option value="accepted" @if($user['confirmation'] == "accepted") selected="selected" @endif>accepted</option>
                                                </select>
                                            </td>
                                            <td><button type="submit" class="btn text-success fa-solid fa-check"></button></td>
                                            </form>
                                            @if(Auth::user() != $user)
                                            <form action="/admin/remove/user" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" id="id" name="id" value="{{$user->id}}">

                                            <td><button type="submit" class="btn text-danger fa-solid fa-xmark"></button></td>
                                            </form>
                                            @endif


                                            </tr>

                                        @endforeach

                                    </tbody>
                            </table>

                        </div>
                    </div>


        </div>
        </div>
        @else
            <h3 class="mb-5 mt-3" >No users found</h3>
        @endunless

        <div class="card mt-5">
            <div class="card-header pt-2 text-center">{{ __('Create user') }}</div>
                <div class="card-body">

                    <table class="table text-center">
                        <thead class="bg-white">
                            <tr style="vertical-align: middle;">
                            <th style="width: 12%">Name</th>
                            <th style="width: 12%">Surname</th>
                            <th>Email</th>
                            <th>Date of birth</th>
                            <th style="width: 8%">Age</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Confirmation</th>
                            <th>Password</th>
                            <th>Create</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr style="vertical-align: middle;" class="alert text-center" role="alert">
                                <form action="/admin/create/user" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <td><input style="text-align: center;"value="" type="text" name="name" id="name" pattern="[A-Ž]{1}[a-ž]+" class="form-control form-control-sm" required/></td>
                                    <td><input style="text-align: center;"value="" type="text" name="surname" id="surname" pattern="[A-Ž]{1}[a-ž]+" class="form-control form-control-sm" required/></td>
                                    <td><input style="text-align: center;"value="" type="email" name="email" id="email" pattern="[a-z0-9]+@[a-z0-9]+.[[a-z]+" class="form-control form-control-sm" required/></td>
                                    <td><input value="" type="date" placeholder="DD-MM-YYYY" min="01-01-1900" name="birth_date" class="form-control form-control-sm" id="birth_date" data-date-format='d-m-Y'/></td>
                                    <td><input style="text-align: center;"value="" type="number" name="age" id="age" pattern="[0-9]+" class="form-control form-control-sm"/></td>
                                    <td><input style="text-align: center;"value="" type="tel" name="phone" id="phone" pattern="(\+421|00421|0)[9][0-9]{8}|(\+420|00420|0)[4-7][0-9]{8}" class="form-control form-control-sm" required/></td>

                                    <td>
                                        <select class="form-control form-control-sm" id="role" name="role">
                                            <option value="volunteer" selected="selected">volunteer</option>
                                            <option value="vet">vet</option>
                                            <option value="careman">careman</option>
                                            <option value="admin">admin</option>
                                            </select>
                                    </td>

                                    <td>
                                        <select class="form-control form-control-sm" id="confirmation" name="confirmation">
                                            <option value="waiting">waiting</option>
                                            <option value="accepted" selected="selected">accepted</option>
                                        </select>
                                    </td>
                                    <td><input style="text-align: center;"value="" type="password" name="password" id="password" class="form-control form-control-sm" required/></td>

                                    <td><button type="submit" class="btn text-success fa-solid fa-check"></button></td>
                                    </form>


                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection

