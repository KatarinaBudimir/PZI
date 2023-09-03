@extends('layout')
@section('title', 'Registracija')
@section('content')
    <div class="container">
        @include('include.alerts_header')
        <form action="{{route('registration.post')}}" method="POST" class="ms-auto me-auto mt-auto"
              style="width: 500px">
            @csrf
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">Full name</label>
                <input type="text" class="form-control" id="exampleInputName1" name="name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                       aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
