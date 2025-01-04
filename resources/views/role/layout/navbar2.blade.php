{{-- welcome blade php --}}
<ul>
    @auth
        @if (auth()->user()->hasRole('admin'))
            <li><a href="{{ route('dashboard-admin') }}">Dashboard Admin</a></li>
        @elseif (auth()->user()->hasRole('mahasiswa'))
            <li><a href="{{ route('dashboard-mahasiswa') }}">Dashboard Mahasiswa</a></li>
        @elseif (auth()->user()->hasRole('mentor'))
            <li><a href="{{ route('dashboard-mentor') }}">Dashboard Mentor</a></li>
        @elseif (auth()->user()->hasRole('dosen'))
            <li><a href="{{ route('dashboard-dosen') }}">Dashboard Dosen</a></li>
        @endif
    @endauth

    @guest
        <li><a href="{{ route('login') }}">Login</a></li>
        <li>sadas</li>
    @endguest
</ul>