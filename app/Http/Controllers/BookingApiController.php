<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
    public function time(Request $request)
    {
        $booking = Booking::select('time')->where('client_id', null)->where('date', $request->date)->OrderBy('time', 'desc')->pluck('time');

        $booking = collect($booking)->map(function ($item, $key) {
            return Carbon::parse($item)->format('H:i');
        })->all();

        if ( $booking && $booking != [] ) {
            return response()->json([
                'time' => $booking,
            ], 200);
        }

        return response()->json([
            'error' => 'Time for this date does not exist!',
        ], 404);


    }

    public function date(Request $request)
    {
        $booking = Booking::select('date')->where('client_id', null)->groupBy('date')->pluck('date');

        return response()->json([
            'date' => $booking,
        ], 200);
    }

    public function client(Request $request)
    {
        $client = Client::select('id', 'name')->get();

        return response()->json([
            'client' => $client,
        ], 200);
    }

}
