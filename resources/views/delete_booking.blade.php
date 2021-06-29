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

            <form action="{{ route('destroyBooking', $booking->id) }}" method="POST" id="delete_form">
                @csrf
                @method('DELETE')
                <div class="field is-size-2">
                    <label class="label">Dátum</label>
                    <div class="control has-icons-right">
                        <input type="text" id="text-calendar" class="input calendar" placeholder="Výber dátum!" name="date"
                            value="{{ \Carbon\Carbon::parse($booking->date)->format('d. m. Y') }}" disabled>
                        <span class="icon is-small is-right">
                            <i class="fa fa-calendar-o"></i>
                        </span>
                    </div>
                </div>

                <div class="field is-size-2">
                    <label class="label">Čas</label>
                    <div class="control is-expanded">
                        <input type="time" class="input mb-2" name="time" value="{{ $booking->time }}" disabled>
                    </div>

                    @if (isset($booking->client->name))
                        <div class="field is-size-2">
                            <label class="label">Klient</label>
                            <div class="control is-expanded">
                                <input type="text" class="input mb-2" name="name" value="{{ $booking->client->name }}" disabled>
                            </div>
                    @endif

                </div>

                <button class="button is-danger is-outlined" id="delete_confirm">
                    <span class="icon is-small">
                        <i class="fas fa-times"></i>
                    </span>
                    <span>Vymazať</span>
                </button>

            </form>

        </div>
    </div>
@endsection
