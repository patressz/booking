<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingEditRequest;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
        $all_booking = Booking::all();

        return view('all_booking')
                            ->with('title', 'Všetky termíny')
                            ->with('all_booking', $all_booking);
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('booking')
                         ->with('title', 'Pridaj nový termín!');
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(BookingRequest $request)
     {
        $date = str_replace(' ', '', $request->date);
        $date = \Carbon\Carbon::parse($date)->format('Y-m-d');

        foreach ( $request->time as $time )
        Booking::create([
            'date' => $date,
            'time' => $time,
        ]);

        return redirect()->route('createBooking')->withStatus('Termín bol úspšene pridaný!');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
        $booking = Booking::findOrFail($id);

        return view('delete_booking')
                            ->with('title', 'Vymazať termín')
                            ->with('booking', $booking);
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
        $booking = Booking::findOrFail($id);
        $clients = Client::select('id', 'name')->get();

        return view('edit_booking')
                            ->with('title', 'Úpraviť termín')
                            ->with('booking', $booking)
                            ->with('clients', $clients);
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(BookingEditRequest $request, $id)
     {
        $booking = Booking::findOrFail($id);

        if ( $booking->client ) {

            $booking->client->update([
                'booking_id' => null,
            ]);

        }

        $date = str_replace(' ', '', $request->date);
        $date = \Carbon\Carbon::parse($date)->format('Y-m-d');

        $booking->update([
            'date' => $date,
            'time' => $request->time,
            'client_id' => $request->client,
        ]);

        if ( $request->client ) {

            $client = Client::findOrFail($request->client);
            $client->update([
                'booking_id' => $booking->id,
            ]);

        }

        return redirect()->route('allBooking')->withStatus('Termín bol úspešne zmenený!');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('allBooking');
     }
}
