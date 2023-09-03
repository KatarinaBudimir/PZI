@extends('layout')
@section('title', 'Login')
@section('content')
    <div class="container">
        @include('include.alerts_header')
        <form action="{{route('login.post')}}" method="POST" class="ms-auto me-auto mt-auto" style="width: 500px">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                       aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Necemo dijeliti vasu email adresu s drugima</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Lozinka</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Potvrdi</button>
        </form>
    </div>
@endsection
