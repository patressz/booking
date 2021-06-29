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

            <span class="icon-text has-text-info" id="back">
                <span class="icon back">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span>Späť</span>
            </span>

            <span class="icon-text has-text-info" id="back-1">
                <span class="icon back">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span>Späť</span>
            </span>


            <form action="{{ route('storeReservation') }}" method="POST">
                @csrf
                <div class="field" id="haircut">
                    <label class="label"><span class="has-text-danger">* </span>Strih</label>
                    <div class="control has-icons-left">
                        <div class="select is-fullwidth">
                            <select name="haircut">
                                <option selected disabled value="-- Výberte službu --">-- Výberte službu --</option>
                                <option>Pánsky strih</option>
                                <option>Pánsky strih + úprava brady</option>
                                <option>Úprava brady</option>
                                <option>Holenie tváre do hladka</option>
                                <option>Junior strih</option>
                            </select>
                        </div>
                        <div class="icon is-small is-left">
                            <i class="fa fa-scissors"></i>
                        </div>
                    </div>
                </div>

                <div id="booking-inputs">

                    <div class="field" id="username">
                        <label class="label">Meno a priezvisko</label>
                        <div class="control has-icons-left">
                            <input class="input" type="text" name="name" placeholder="Zadajte meno a priezvisko">
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field" id="username">
                        <label class="label">E-mail</label>
                        <div class="control has-icons-left">
                            <input class="input" type="email" name="email" placeholder="Zadajte e-mail">
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field" id="username">
                        <label class="label">Telefón</label>
                        <div class="control has-icons-left">
                            <input class="input" type="tel" name="phone" placeholder="Zadajte telefónne číslo">
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Poznámka</label>
                        <div class="control">
                            <textarea class="textarea" name="message" placeholder="Poznámka"></textarea>
                        </div>
                    </div>

                    <div class="buttons mt-2" id="send_form">
                        <button class="button is-success is-outlined">
                            <span class="icon is-small">
                                <i class="fas fa-check"></i>
                            </span>
                            <span>Odoslať</span>
                        </button>
                    </div>

                </div>


            </form>
        </div>

    </div>

    <div class="columns is-centered">
        <div class="column is-one-fifth">

            <div class="calendar" id="calendar"></div>

        </div>

        <div class="column is-one-quarter">

            <div class="time">
                <div class="has-text-centered">
                    <img src="{{ asset('assets/img/loading.gif') }}" alt="loading" id="loading">
                </div>
                <h1 class="subtitle" id="morning">Dopoludnie</h1>
                <h1 class="subtitle" id="aftermoon">Popoludnie</h1>
            </div>

        </div>
    </div>

    <script src="{{ asset('assets/js/ajax.js') }}"></script>

@endsection
