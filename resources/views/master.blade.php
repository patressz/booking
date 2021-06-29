@include('partials.header')

<header>
    <div class="columns is-centered">
        <div class="column is-half">
            @include('layouts.nav')
            @include('layouts.errors')
            @include('layouts.messages')
        </div>
    </div>
    @yield('title')
</header>

<section>
    @yield('content')
</section>

@include('partials.footer')
