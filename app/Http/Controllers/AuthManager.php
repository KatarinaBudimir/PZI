<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\DestinationRating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    function home()
    {
        $destinations = Destination::all();
        $lastFiveRatingsInitial = DestinationRating::orderBy('id', 'desc')
            ->take(5)
            ->get();
        $lastFiveRatings = new Collection();
        foreach ($lastFiveRatingsInitial as $rating) {
            $userId = DB::table('trip_user')->where('id', $rating->trip_user_id)->first()->user_id;
            $user = DB::table('users')->where('id', $userId)->first();
            $rating->name = $user->name;
            $rating->image_url = $user->avatar_url;
            $lastFiveRatings->push($rating);
        }
        foreach ($destinations as $destination) {
            // Get all trips with this destination, and get the lowest discounted_price item
            $trips = DB::table('trips')->where('destination_id', $destination->id)->get();
            $lowestPrice = 0;
            foreach ($trips as $trip) {
                if ($lowestPrice == 0) {
                    $lowestPrice = $trip->discounted_price;
                } else {
                    if ($trip->discounted_price < $lowestPrice) {
                        $lowestPrice = $trip->discounted_price;
                    }
                }
            }
            $destination->lowestPrice = $lowestPrice;
        }
        if (Auth::check()) {
            $role = Auth::user()->role;
            return view('welcome', compact('destinations', 'lastFiveRatings', 'role'));
        }
        return view('welcome', compact('destinations', 'lastFiveRatings'));
    }

    function login()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('login');
    }

    function registration()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('registration');
    }

    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        } else {
            return redirect(route('login'))->with("error", "Login details are not valid.");
        }
    }

    function registrationPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        if (!$user) {
            return redirect(route('registration'))->with("error", "Registration failed.");
        } else {
            return redirect()->intended(route('login'))->with("success", "Registration successful, you can now login.");
        }
    }

    function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    function profile()
    {
        return auth()->user()->name;
    }
}
