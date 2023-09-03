@extends('layout')
@section('title', 'Rezervirana putovanja')
@section('content')
    <div class="container">
        @include('include.alerts_header')
        <form action="{{route('user.trip.rating.post')}}" method="POST" class="ms-auto me-auto mt-auto"
              style="width: 500px">
            @csrf
            <div><p>Rating za putovanje. (<strong>{{$tripUser->destinationName}}</strong>, broj
                    mjesta: {{$tripUser->spots}})</p></div>
            <div class="star-rating" dir="rtl">
                <input type="radio" id="star1" name="rating" value="5"/>
                <label for="star1" title="1 star"></label>
                <input type="radio" id="star2" name="rating" value="4"/>
                <label for="star2" title="2 stars"></label>
                <input type="radio" id="star3" name="rating" value="3"/>
                <label for="star3" title="3 stars"></label>
                <input type="radio" id="star4" name="rating" value="2"/>
                <label for="star4" title="4 stars"></label>
                <input type="radio" id="star5" name="rating" value="1"/>
                <label for="star5" title="5 stars"></label>
            </div>
            <div class="mb-3">
                <label class="form-label">Review</label>
                <input type="text" class="form-control" name="review">
            </div>
            <input type="hidden" name="rating" id="rating" value=""/>
            <input type="hidden" name="trip_user_id" id="trip_user_id" value="{{$tripUser->id}}"/>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script>
        const starRating = document.querySelectorAll('.star-rating input[type="radio"]');
        const selectedRating = document.getElementById('rating');
        document.getElementById('star1').addEventListener('change', function () {
            console.log('Selected rating: ' + this.value);
        });
        starRating.forEach((radio) => {
            radio.addEventListener('change', () => {
                selectedRating.value = radio.value;
            });
        });
    </script>
    <style>
        .star-rating {
            display: inline-block;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            font-size: 20px;
            cursor: pointer;
        }

        .star-rating label:before {
            content: "\2606"; /* Unicode character for an empty star (unselected) */
        }

        .star-rating input[type="radio"]:checked ~ label:before {
            content: "\2605"; /* Unicode character for a filled star (selected) */
        }

    </style>
@endsection
