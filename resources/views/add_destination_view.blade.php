@extends('layout')
@section('title', 'Dodavanje destinacije')
@section('content')
    <div class="container">
        @include('include.alerts_header')
        <form action="{{route('destination.post')}}" method="POST" class="ms-auto me-auto mt-auto"
              style="width: 500px">
            @csrf
            <div class="mb-3">
                <label class="form-label">Naziv</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label class="form-label">Opis</label>
                <input type="text" class="form-control" name="description">
            </div>
            <div class="mb-3">
                <label class="form-label">Geografska sirina</label>
                <input type="number" step="0.0000001" class="form-control" name="latitude">
            </div>
            <div class="mb-3">
                <label class="form-label">Geografska duzina</label>
                <input type="number" step="0.0000001" class="form-control" name="longitude">
            </div>
            <div class="mb-3">
                <label class="form-label">Cijena</label>
                <input type="number" step="0.01" class="form-control" name="price">
            </div>
            <div class="mb-3">
                <label class="form-label">Ocjena</label>
                <input type="number" step="0.01" class="form-control" name="rating">
            </div>
            <div class="mb-3">
                <label class="form-label">Url slike</label>
                <input type="text" class="form-control" name="image_url">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
