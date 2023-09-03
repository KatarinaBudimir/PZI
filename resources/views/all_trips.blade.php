@extends('layout')
@section('title', 'Putovanja')
@section('content')
    <div class="container">
        @include('include.alerts_header')
        <nav class="navbar navbar-light bg-light">
            <form class="form-inline" action="{{route('trip.list')}}">
                <input class="form-control mr-sm-2" type="search" placeholder="Pretrazi" name="destination_name"
                       aria-label="Pretrazi">
                <input type="submit" class="btn btn-outline-success my-2 my-sm-0" value="Pretrazi">
            </form>
        </nav>
        <div><a href="{{route('user.trip.list')}}">Rezervirana putovanja</a></div>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="col-1">Datum polaska</div>
                <div class="col-1">Datum dolaska</div>
                <div class="col-1">Broj mjesta</div>
                <div class="col-1">Cijena</div>
            </li>
            @foreach($trips as $trip)
                <form action="{{route('trip.reserve')}}" method="GET">
                    @csrf
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="col-1">{{$trip->date_start}}</div>
                        <div class="col-1">{{$trip->date_end}}</div>
                        <span class="badge justify-content-end bg-primary rounded-pill">Mjesta: {{$trip->spots}}</span>
                        <span
                            class="badge bg-primary rounded-pill">Cijena s popustom: {{$trip->discounted_price}} KM</span>
                    </li>
                </form>
            @endforeach
        </ul>
    </div>
@endsection
