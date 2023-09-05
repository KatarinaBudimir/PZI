<div class="heder">
    <a href="{{route('home')}}" class="logo"><span>Bez</span> Granica</a>
    <nav class="traka">
        @if(Route::current()->getName() === 'home')
            <a href="#">POČETNA</a>
            <a href="#rezervacije">REZERVACIJA</a>
            <a href="#ponuda">PONUDA</a>
            <a href="#usluge">USLUGE</a>
            <a href="#recenzije">RECENZIJE</a>
            <a href="{{route('trip.list')}}">LISTA SVIH PUTOVANJA</a>
            <a href="#urednici">VODITELJI STRANICE</a>
        @endif
        @auth
            @isset($role)
                @if($role === "admin")
                    <a href="{{route('destination.dashboard')}}">DESTINACIJE</a>
                @endif
            @endisset
            <a href="{{route('logout')}}">LOGOUT({{auth()->user()->name}})</a>
        @else
            <a href="{{route('login')}}">LOGIN</a>
            <a href="{{route('registration')}}">REGISTRACIJA</a>
        @endauth
    </nav>
    <div class="icons">
    </div>
</div>
