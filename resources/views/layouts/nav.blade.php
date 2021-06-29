<nav class="navbar" role="navigation" aria-label="main navigation">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">

            <a href="{{ route('home') }}" class="navbar-item">
                Domov
            </a>

            <a href="{{ route('createBooking') }}" class="navbar-item">
                Pridať termín
            </a>

            <a href="{{ route('allBooking') }}" class="navbar-item">
                Rezervácie
            </a>

        </div>
    </div>
</nav>
