<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class GeneralController extends Controller
{
    function tripList(Request $request)
    {
        $request->validate([
            'destination_name',
            'destination_id',
            'start_date',
            'end_date',
        ]);

        $tripList = true;
        $tripsWithDestinations = array();

        if ($request->destination_name != null) {
            $destination = DB::table('destinations')->where('name', $request->destination_name)->first();
            if ($destination != null) {
                $trips = DB::table('trips')->where('destination_id', $destination->id)->get();
                $tripsWithDestinations[$destination->name] = $trips;
                if ($trips == null || $trips->isEmpty()) {
                    return redirect(route('trip.list'))->with("error", "Nema putovanja s tom destinacijom($destination->name)");
                } else {
                    return view('trips_destination', compact('tripsWithDestinations', 'tripList'));
                }
            } else {
                return redirect(route('trip.list'))->with("error", "Nema destinacije s tim imenom($request->destination_name)");
            }
        }
        if ($request->destination_id != null) {
            $destination = DB::table('destinations')->where('id', $request->destination_id)->first();
            if ($destination != null) {
                $trips = DB::table('trips')->where('destination_id', $destination->id)->get();
                $tripsWithDestinations[$destination->name] = $trips;
                if ($trips == null || $trips->isEmpty()) {
                    return redirect(route('home'))->with("error", "Nema putovanja s tom destinacijom($destination->name)");
                } else {
                    return view('trips_destination', compact('tripsWithDestinations', 'tripList'));
                }
            }
        }
        if ($request->start_date != null && $request->end_date != null) {

        }
        $destinations = Destination::all();

        foreach ($destinations as $destination) {
            $trips = DB::table('trips')->where('destination_id', $destination->id)->get();
            $tripsWithDestinations[$destination->name] = $trips;
        }

        return view('trips_destination', compact('tripsWithDestinations', 'tripList'));
    }
}
