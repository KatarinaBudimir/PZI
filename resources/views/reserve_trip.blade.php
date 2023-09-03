@extends('layout')
@section('title', 'Dodavanje destinacije')
@section('content')
    @include('include.alerts_header')
    <div class="container">
        <h1>Seat Reservation</h1>
        <form method="post" action="{{ route('trip.reserve.post') }}"> // Define your form action
            @csrf

            <div class="form-group">
                <label for="seat_count">Select Number of Seats:</label>
                <select class="form-control" id="seat_count" name="seat_count">
                    @for ($i = 1; $i <= 10; $i++)
                        // Adjust the maximum number of seats as needed
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <br/><hr/>
            <input type="hidden" id="selected_seat_count" name="selected_seat_count">
            <input type="hidden" id="trip_id" name="trip_id" value="{{$trip_id}}">
            <div id="dynamic_fields"></div>
            <br/>
            <button type="submit" class="btn btn-primary">Rezerviraj!</button>
        </form>
    </div>
    <script>
        // Add event listener to the seat_count dropdown
        document.getElementById('seat_count').addEventListener('change', function () {
            const seatCount = this.value;
            const dynamicFieldsContainer = document.getElementById('dynamic_fields');
            dynamicFieldsContainer.innerHTML = '';  // Clear existing fields

            // Create "First name" and "Last name" input fields based on seatCount
            for (let i = 1; i <= seatCount; i++) {
                dynamicFieldsContainer.innerHTML += `
                <div class="form-group">
                    <label for="full_name_${i}">Puno ime osobe za mjesto ${i}:</label>
                    <input type="text" class="form-control" id="full_name_${i}" name="full_name_${i}" required>
                </div>
                <div class="form-group">
                    <label for="last_name_${i}">Datum rodjenja osobe za mjesto ${i}:</label>
                    <input type="date" class="form-control" id="birth_date_${i}" name="birth_date_${i}" required>
                </div>
                <br/><hr/>
            `;
            }

            document.getElementById('selected_seat_count').value = seatCount;
        });

        document.getElementById('seat_count').value = '1';
        document.getElementById('seat_count').dispatchEvent(new Event('change'));
    </script>
@endsection
