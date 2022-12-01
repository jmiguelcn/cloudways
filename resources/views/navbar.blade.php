<!-- Navigation -->
<nav>
    <a href="{{ route('dashboard') }}">Inici</a>
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('llibre_list') }}">Llibres</a>
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('autor_list') }}">Autors</a>
    &nbsp;|&nbsp;
    @if (Auth::check()) 
    <form method="POST" id="logout" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
    </form>
    @else
    <a href="{{ route('login') }}">Login</a>
    &nbsp;
    <a href="{{ route('register') }}">Register</a>
    @endif
</nav>