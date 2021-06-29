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
        <div class="column is-one-fifth">

            <form action="{{ route('updateBooking', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="field is-size-2">
                    <label class="label">Výber dátum</label>
                    <div class="control has-icons-right">
                        <input type="text" id="text-calendar" class="input calendar" placeholder="Výber dátum!" name="date"
                            value="{{ \Carbon\Carbon::parse($booking->date)->format('d. m. Y') }}">
                        <span class="icon is-small is-right">
                            <i class="fa fa-calendar-o"></i>
                        </span>
                    </div>
                </div>

                <div class="field is-size-2">
                    <label class="label">Výber čas</label>
                    <div class="control is-expanded">
                        <input type="time" class="input mb-2" name="time"
                            value="{{ \Carbon\Carbon::parse($booking->time)->format('H:i') }}">
                    </div>

                    @if (isset($booking->client->name))
                        <div class="field" id="client">
                            <label class="label">Klient</label>
                            <div class="control has-icons-left">
                                <div class="select is-fullwidth">
                                    <select name="client">
                                        <option class="checked" value="{{ $booking->client->id }}">{{ $booking->client->name }}</option>
                                        @foreach ($clients as $client)
                                            @if ($booking->client->name !== $client->name)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="icon is-small is-left">
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

                <button class="button is-success is-outlined">
                    <span class="icon is-small">
                        <i class="fas fa-check"></i>
                    </span>
                    <span>Aktualiovať</span>
                </button>

            </form>

        </div>
    </div>

@endsection
