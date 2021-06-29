<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Booking;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $booking_id = Booking::select('id', 'client_id')->where('date', $request->date)->where('time', $request->time)->get();

        foreach ( $booking_id as $booking )

        $client = Client::create([
            'booking_id' => $booking->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'haircut' => $request->haircut,
            'message' => $request->message,
        ]);

        if ( $booking->client_id != null ) {
            return redirect()->route('home')
                ->withErrors('Termín ' . Carbon::parse($request->date)->translatedFormat('l d. F Y') . ' o ' . Carbon::parse($request->time)->format('H:i') . ' už je obsadený!');
        }

        Booking::where('id', $booking->id)->update([
            'client_id' => $client->id,
        ]);

        return redirect()->route('home')
            ->withStatus('Rezervácia bola úspšená! Váš termín ' . Carbon::parse($request->date)->translatedFormat('l d. F Y') . ' o ' . Carbon::parse($request->time)->format('H:i') );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
