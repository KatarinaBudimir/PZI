@extends('layout')
@section('title', 'Dodavanje destinacije')
@section('content')
    <div class="container">
        @include('include.alerts_header')
        <form action="{{route('trip.post')}}" method="POST" class="ms-auto me-auto mt-auto" style="width: 500px">
            @csrf
            <div class="mb-3">
                <label class="form-label">Destinacija: {{$destination_data['name']}}
                    (ID {{$destination_data['destination_id']}})</label>
            </div>
            <div class="mb-3">
                <label class="form-label">Datum polaska</label>
                <input type="date" class="form-control" name="date_start">
            </div>
            <div class="mb-3">
                <label class="form-label">Datum odlaska</label>
                <input type="date" class="form-control" name="date_end">
            </div>
            <div class="mb-3">
                <label class="form-label">Broj dostupnih mjesta</label>
                <input type="number" class="form-control" name="spots">
            </div>
            <div class="mb-3">
                <label class="form-label">Cijena</label>
                <input type="number" step="0.01" class="form-control" name="discounted_price">
            </div>
            <input type="hidden" name="destination_id" value="{{$destination_data['destination_id']}}"/>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
