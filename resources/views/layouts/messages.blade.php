@if ( session('status') )
    <div class="notification is-success" id="alert">
        <button class="delete"></button>
        <ul>
            <li>{{ session('status') }}</li>
        </ul>
    </div>
@endif
