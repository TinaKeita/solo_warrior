<header>
<nav>
    <a href="/">Sākums</a>

    @auth
        @if (auth()->user()->role === 'teacher')
            <a href="/grades">Visas atzīmes</a>
            <a href="/students">Skolēni</a>
            <a href="/subjects">Priekšmeti</a>
        @else
            <a href="/grades">Manas atzīmes</a>
        @endif
            <a href="/profile">Profils</a>
    <form method="POST" action="/logout">
        @csrf
        @method('DELETE')
        <button type="submit">Izrakstīties</button>
    </form>

    @else
        <a href="/register">Reģistrēties</a>
        <a href="/login">Ienākt</a>
    @endauth
</nav>

</header>