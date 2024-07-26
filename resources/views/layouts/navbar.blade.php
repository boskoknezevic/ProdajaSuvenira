<nav class="navbar navbar-expand navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('welcome') }}">Продавница Сувенира</a>
    <ul class="navbar-nav ms-auto">
            @if(Route::has('login'))
                @auth
                    <li class="nav-item">
                        <a href="{{ url('/home') }}" class="nav-link text-dark">Измени</a>
                    </li>

                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link text-dark">Пријави се</a>
                    </li>
                @endauth
            @endif
    </ul>
</nav>