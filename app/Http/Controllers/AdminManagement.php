<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Trip;
use App\Models\TripUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminManagement extends Controller
{
    function destinationPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'latitude',
            'longitude',
            'price' => 'required',
            'rating',
            'image_url' => 'required'
        ]);
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['latitude'] = $request->latitude;
        $data['longitude'] = $request->longitude;
        $data['price'] = $request->price;
        $data['rating'] = $request->rating == null ? 5.0 : $request->rating;
        $data['image_url'] = $request->image_url;
        $destination = Destination::create($data);

        if (!$destination) {
            return redirect(route('destination.dashboard'))->with("error", "Neuspješno kreiranje nove destinacije.");
        } else {
            return redirect()->intended(route('destination.dashboard'))->with("success", "Uspješno dodana destinacija.");
        }
    }

    function destinationDashboard()
    {
        $destinations = Destination::all();
        if (Auth::user()->role === "admin") {
            return view('destination_dashboard', compact('destinations'));
        } else {
            return redirect(route('home'))->with("error", "Nemate dozvolu da vidite ovaj zaslon");
        }
    }

    function destination()
    {
        if (Auth::user()->role === "admin") {
            return view('add_destination_view');
        } else {
            return redirect(route('home'))->with("error", "Nemate dozvolu da vidite ovaj zaslon");
        }
    }

    function tripPost(Request $request)
    {
        $request->validate([
            'destination_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'spots' => 'required',
            'discounted_price' => 'required'
        ]);
        $data['destination_id'] = $request->destination_id;
        $data['date_start'] = $request->date_start;
        $data['date_end'] = $request->date_end;
        $data['spots'] = $request->spots;
        $data['discounted_price'] = $request->discounted_price;
        $trip = Trip::create($data);

        if (!$trip) {
            return redirect(route('destination.dashboard'))->with("error", "Neuspješno kreiranje novog putovanja!");
        } else {
            return redirect()->intended(route('destination.dashboard'))->with("success", "Uspješno dodano novo putovanje!.");
        }
    }

    function trip(Request $request)
    {
        $request->validate([
            'destination_id' => 'required',
            'name' => 'required',
        ]);
        if ($request->action == 'all_trips') {
            $trips = DB::table('trips')->where('destination_id', $request->destination_id)->get();
            return view('all_trips', compact('trips'));
        }
        $destination_data['destination_id'] = $request->destination_id;
        $destination_data['name'] = $request->name;
        if (Auth::user()->role === "admin") {
            return view('add_trip_view', compact('destination_data'));
        } else if (Auth::user()->role === "editor") {
            return view('add_trip_view', compact('destination_data'));
        } else {
            return redirect(route('home'))->with("error", "Nemate dozvolu da vidite ovaj zaslon");
        }
    }

    function reserveTrip(Request $request)
    {
        $request->validate([
            'trip_id' => 'required'
        ]);
        $trip_id = $request->trip_id;
        return view('reserve_trip', compact('trip_id'));
    }

    function reserveTripPost(Request $request)
    {
        $data = $request->validate([
            'trip_id' => 'required|integer',
            'selected_seat_count' => 'required|integer',
            'full_name_.*' => 'required|string',
            'birth_date_.*' => 'required',
        ]);

        $selectedSeatCount = $data['selected_seat_count'];

        // Create an array to store reservation data
        $reservations = [];

        for ($i = 1; $i <= $selectedSeatCount; $i++) {
            $reservations[] = [
                'full_name' => $request->input("full_name_$i"),
                'birth_date' => $request->input("birth_date_$i"),
            ];
        }

        // Encode the array as JSON
        $reservationData = json_encode($reservations);

        // Save the reservation data to the database
        $success = DB::table('trip_user')->insert([
            'trip_id' => $request->trip_id, // Replace with the actual trip_id
            'user_id' => Auth::user()->id, // Replace with the actual user_id
            'spots' => $selectedSeatCount,
            'reservation_data' => $reservationData,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($success) {
            return redirect(route('home'))->with("success", "Uspješno rezervirano putovanje!");
        } else {
            return redirect(route('home'))->with("error", "Neuspješno rezervirano putovanje!");
        }
    }

    function reserveTripDelete(Request $request)
    {
        $request->validate([
            'trip_id' => 'required'
        ]);
        $trip_id = $request->trip_id;
        $success = DB::table('trip_user')->where('id', $trip_id)->delete();
        if ($success) {
            return redirect(route('user.trip.list'))->with("error", "Izbrisan je zahtjev za rezervaciju putovanja!");
        } else {
            return redirect(route('user.trip.list'))->with("error", "Neuspješno brisanje zahtjeva za rezervaciju putovanja!");
        }
    }

    function userTripList()
    {
        if (Auth::user()->role === "admin") {
            $allUserTrips = TripUser::all();
        } else {
            $allUserTrips = TripUser::where('user_id', Auth::user()->id)->get();
        }
        $userTripsWithData = new Collection();
        foreach ($allUserTrips as $tripUser) {
            $reservations = json_decode($tripUser->reservation_data, true);

            $tripUser->reservations = $reservations;
            $tripUser->userName = DB::table('users')->where('id', $tripUser->user_id)->first()->name;
            $userTripsWithData->push($tripUser);
        }
        $role = Auth::user()->role ? Auth::user()->role : "user";
        return view('reserved_trips', compact('userTripsWithData', 'role'));
//        return $reservations[1]['full_name'];
    }

    function userTripRating(Request $request)
    {
        $tripUserId = $request->query('trip_user_id');
        $tripUser = TripUser::where('id', $tripUserId)->first();
        $trip = DB::table('trips')->where('id', $tripUser->trip_id)->first();
        $tripUser->destinationName = DB::table('destinations')->where('id', $trip->destination_id)->first()->name;
        return view('user_trip_rating', compact('tripUser'));
    }

    function userTripRatingPost(Request $request)
    {
        $request->validate([
            'trip_user_id' => 'required|integer',
            'rating' => 'required',
            'review' => 'required|string',
        ]);

        $tripUserId = $request->trip_user_id;
        $rating = $request->rating;
        $review = $request->review;
        $success = DB::table('destination_rating')->insert([
            'trip_user_id' => $tripUserId,
            'rating' => $rating,
            'review' => $review,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        if ($success) {
            return redirect(route('home'))->with("success", "Uspješno ocijenjeno putovanje!");
        } else {
            return redirect(route('home'))->with("error", "Neuspješno ocijenjeno putovanje!");
        }
    }
}
