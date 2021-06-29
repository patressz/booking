@extends('master')

@section('title')
    <div class="columns is-centered">
        <div class="column is-half has-text-centered mt-6">
            <h1 class="title">
                {{ $title }}
            </h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="columns is-centered">
        <div class="column is-one-third">

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Stav</th>
                        <th class="has-text-centered">
                            <span class="icon is-small">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                            Dátum
                        </th>
                        <th>
                            <span class="icon is-small">
                                <i class="fas fa-clock"></i>
                            </span>
                            Čas
                        </th>
                        <th class="has-text-centered">
                            Akcia
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_booking as $booking)
                        <tr>
                            <th>
                                #{{ $booking->id }}
                            </th>
                            <th>
                                @if (!$booking->client_id)
                                    Voľný
                                @else
                                    Obsadený
                                @endif
                            </th>
                            <th>
                                {{ \Carbon\Carbon::parse($booking->date)->translatedFormat('l d. F Y') }}
                            </th>
                            @if ($booking->client_id)
                                <th class="has-text-danger">
                                    {{ \Carbon\Carbon::parse($booking->time)->format('H:i') }}
                                </th>
                            @else
                                <th>
                                    {{ \Carbon\Carbon::parse($booking->time)->format('H:i') }}
                                </th>
                            @endif
                            <th>
                                <a href="{{ route('editBooking', $booking->id) }}" class="button is-warning mr-2">
                                    <span class="icon is-small">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                </a>
                                <a href="{{ route('deleteBooking', $booking->id) }}" class="button is-danger">
                                    <span class="icon is-small">
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                </a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
