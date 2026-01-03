<header>
    <nav>
        @auth
            <p>LOGGED IN as {{ auth()->user()->username }}</p>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit">Izrakstīties</button>
            </form>
        @else
            <p>NOT LOGGED IN</p>
        @endauth
    </nav>
</header>
