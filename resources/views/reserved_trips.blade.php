@extends('layout')
@section('title', 'Rezervirana putovanja')
@section('content')
    <div class="container">
        @include('include.alerts_header')
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="col-1">ID Putovanja</div>
                <div class="col-1">Korisnik(ID)</div>
                <div class="col-1">Broj mjesta</div>
                <div class="col-1">Ostavi rating</div>
                <div class="col-1">Podatci o rezervaciji</div>
                <div class="col-1"></div>
            </li>
            @foreach($userTripsWithData as $reservation)
                <form action="{{route('trip.reserve.delete')}}" method="post">
                    @csrf
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="col-1">ID Putovanja: {{$reservation->id}}</div>
                        <div class="col-1"><strong>{{$reservation->userName}}</strong>({{$reservation->user_id}})</div>
                        <p>Ukupan broj mjesta: <span
                                class="badge justify-content-end bg-primary rounded-pill">{{$reservation->spots}}</span>
                        </p>
                        <div class="user-info">
                            @foreach($reservation->reservations as $item)
                                <p>Ime: {{ $item['full_name'] }}</p>
                                <p>Datum rođenja: {{ $item['birth_date'] }}</p>
                                <hr/>
                            @endforeach
                        </div>
                        @method('delete')
                        <input type="hidden" name="trip_id" value="{{$reservation->id}}"/>
                        @if($role !== 'admin')
                            <div class="col-1"><a
                                    href="{{ route('user.trip.rating') }}?trip_user_id={{ $reservation->id }}">Ostavi
                                    rating!</a></div>
                        @endif
                        <button type="submit" class="btn btn-danger">Ukloni rezervaciju</button>
                    </li>
                </form>
            @endforeach
        </ul>
    </div>
@endsection
