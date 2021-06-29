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
            <form action="{{ route('storeBooking') }}" method="POST">
                @csrf
                <div class="field is-size-2">
                    <label class="label">Výber dátum</label>
                    <div class="control has-icons-right">
                        <input type="text" id="text-calendar" class="input calendar" placeholder="Výber dátum!" name="date"
                            value="{{ \Carbon\Carbon::now()->format('d. m. Y') }}">
                        <span class="icon is-small is-right">
                            <i class="fa fa-calendar-o"></i>
                        </span>
                    </div>
                </div>

                <div class="field is-size-2 is-grouped time-div">
                    <div class="control is-expanded">
                        <input type="time" class="input mb-2 time-input" name="time[]" value="09:00">
                    </div>
                    <a class="button is-info is-outlined" id="add_new">
                        <span>Pridať nové</span>
                    </a>
                </div>

                <div class="buttons mt-2">
                    <button class="button is-success is-outlined">
                        <span class="icon is-small">
                            <i class="fas fa-check"></i>
                        </span>
                        <span>Odoslať</span>
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection
