@extends('layout')
@section('title', 'Dodavanje destinacije')
@section('content')
    <div class="container">
        @include('include.alerts_header')
        <div><a href="{{route('destination')}}">Dodaj novu destinaciju</a></div>
        <ul class="list-group">
            @foreach($destinations as $destination)
                <form action="{{route('trip')}}" method="GET">
                    @csrf
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="col-1">{{$destination->name}}</div>
                        <div class="col-8">{{$destination->description}}</div>
                        <span
                            class="badge justify-content-end bg-primary rounded-pill">{{$destination->price}} KM</span>
                        <span class="badge bg-primary rounded-pill">{{$destination->rating}} ⭐</span>
                        <button type="submit" name="action" value="new_trip">Kreiraj novo putovanje</button>
                        <button type="submit" name="action" value="all_trips">Provjeri dostupna putovanja</button>

                        <input type="hidden" name="destination_id" value="{{$destination->id}}"/>
                        <input type="hidden" name="name" value="{{$destination->name}}"/>
                    </li>
                </form>
            @endforeach
        </ul>
    </div>
@endsection
