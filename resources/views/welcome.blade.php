@extends('layout')
@section('content')
    @if($errors->any() || session()->has('error') || session()->has('success'))
        @include('include.alerts_header')
    @endif
    {{--<div class="login-form-container">
        <i class="fas fa-times" id="form-close"></i>
        <form action="">
            <h3>Prijavite se</h3>
            <input type="email" class="box" placeholder="unesite Vaš email">
            <input type="password" class="box" placeholder="unesite Vašu šifru">
            <input type="submit" value="Potvrdi" class="btn">
            <button type="button" class="mojbtn btn-primary">Ili Registriraj se</button>
        </form>
    </div>--}}

    <!---naslovnica-->
    <section class="početna" id="početna">
        <div class="content">
            <h3>Živimo Život </br> "BEZ GRANICA"</h3>
            <p>Vrijeme je za putovanje!!</p>
        </div>

        <div class="controls">
            <span class="video-btn"
                  data-src="slike/Sunset Over Beautiful Pier With Sky Background Loop (No Copyright).mp4"></span>
            <span class="video-btn active"
                  data-src="slike/Website Video Background - w_o writing a line of HTML, jQuery, CSS code!.mp4"></span>
            <span class="video-btn" data-src="slike/(4K_UHD)Sunset On Sea loop Free To Use (No Copyright).mp4"></span>
        </div>

        <div class="video-container">
            <video src="slike/Sunset Over Beautiful Pier With Sky Background Loop (No Copyright).mp4" id="video-slider"
                   loop autoplay muted></video>
        </div>
    </section>

    <!---rezervacije-->
    <section class="rezervacije" id="rezervacije">
        <h1 class="heading">
            <span>R</span>
            <span>E</span>
            <span>Z</span>
            <span>E</span>
            <span>R</span>
            <span>V</span>
            <span>I</span>
            <span>R</span>
            <span>A</span>
            <span>J</span>
            <span class="space"> </span>
            <span>O</span>
            <span>D</span>
            <span>M</span>
            <span>A</span>
            <span>H</span>
        </h1>
        <div class="row">
            <div class="slika">
                <img src="slike/slikaosobe.jpg" alt="">
            </div>
            <form action="{{route('trip.list')}}">
                <div class="unos">
                    <h3>Odaberi mjesto</h3>
                    <input type="text" name="destination_name" placeholder="Unesite naziv destinacije">
                </div>

                <input type="submit" class="mojbtn" value="Rezerviraj odmah!">
            </form>
        </div>
    </section>

    <!---ponudaa-->
    <section class="ponuda" id="ponuda">
        <h1 class="heading">
            <span>P</span>
            <span>O</span>
            <span>N</span>
            <span>U</span>
            <span>D</span>
            <span>A</span>
        </h1>
        <div class="box-container">
            @foreach($destinations as $destination)
                <div class="box">
                    <form action="{{route('trip.list')}}">
                        <img src="{{$destination->image_url}}" alt="">
                        <div class="content">
                            <h3><i class="fas fa-map-marker-alt"></i>{{$destination->name}}</h3>
                            <p>{{$destination->description}}</p>
                            <div class="stars">
                                @for($i = 0; $i < 5; $i++)
                                    @if($destination->rating > $i)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            @if($destination->lowestPrice != 0)
                                <div class="cijena">KM {{$destination->lowestPrice}} <span> KM {{$destination->price}}</span></div>
                            @else
                                <div class="cijena">KM {{$destination->price}}</div>
                            @endif
                            <input type="hidden" name="destination_name" value="{{$destination->name}}">
                            <input type="submit" class="mojbtn" value="Rezerviraj odmah!">
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </section>

    <!---usluge-->
    <section class="usluge" id="usluge">
        <h1 class="heading">
            <span>U</span>
            <span>S</span>
            <span>L</span>
            <span>U</span>
            <span>G</span>
            <span>E</span>
        </h1>
        <div class="box-container">
            <div class="box">
                <i class="fas fa-hotel"></i>
                <h3>Hoteli</h3>
                <p>Ukoliko ne znate koji hotel odabrati,agencija ima ponudu najboljih hotela na odabranim
                    lokacijama.</p>
            </div>
            <div class="box">
                <i class="fas fa-passport"></i>
                <h3>Vize</h3>
                <p>Problemi s vizama za određene zemlje su stvar prošlosti. Nudimo Vam usluge rješavanja viza za
                    odabrano putovanje ukoliko su potrebne.</p>
            </div>
            <div class="box">
                <i class="fas fa-utensils"></i>
                <h3>Hrana i piće</h3>
                <p>Agencija nudi velik izbor restorana i pića u kojima možete uživati i provesti ugodno vrijeme nakon
                    razgledanja lokacije.</p>
            </div>
            <div class="box">
                <i class="fas fa-book-medical"></i>
                <h3>Putno osiguranje</h3>
                <p>Uz nas budite sigurni osigurani na svakom putovanju. Usluge zdravstvenog osiguranja uvijek su dobra
                    ponuda.</p>
            </div>
            <div class="box">
                <i class="fas fa-car"></i>
                <h3>Najam automobila</h3>
                <p>Ukoliko niste ljubitelji gradskih prijevoza na Vašem putovanju, ponuda najma automobila uvijek je
                    dobar izbor.</p>
            </div>
            <div class="box">
                <i class="fas fa-umbrella-beach"></i>
                <h3>Izleti</h3>
                <p>Ukoliko ne znate koje atrakcije odabranog grada posijetiti nudimo Vam brojne fakultativne izlete
                    kojima ne ćete biti razočarani.</p>
            </div>
        </div>
    </section>
    <!--recenzije-->
    <section class="recenzije" id="recenzije">
        <h1 class="heading">
            <span>R</span>
            <span>E</span>
            <span>C</span>
            <span>E</span>
            <span>N</span>
            <span>Z</span>
            <span>I</span>
            <span>J</span>
            <span>E</span>
        </h1>
        <div class="review-slider">
            <div class="swiper-wrapper">
                @foreach($lastFiveRatings as $individualRating)
                    <div class="slider">
                        <div class="box">
                            <img src="{{url($individualRating->image_url)}}" alt="">
                            <h3>{{$individualRating->name}}</h3>
                            <p>{{$individualRating->review}}</p>
                            <div class="stars">
                                @for($i = 0; $i < 5; $i++)
                                    @if($individualRating->rating > $i)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!---urednici--->
    @auth
        <p></p>
    @else
        <section class="urednici" id="urednici">
            <h1 class="heading">
                <span>O</span>
                <span class="space"> </span>
                <span>N</span>
                <span>A</span>
                <span>M</span>
                <span>A</span>
            </h1>
            <div class="box-container">
                <div class="box">
                    <img src="slike/IMG-20230110-WA0004.jpg" alt="">
                    <div class="content">
                        <h3><i class="slika"></i>Josipa Čolak</h3>
                        <p>Dolazim iz Širokog Brijega.</br> Imam 21 godinu. </br> Studentica sam treće godine studija
                            Matematika-informatika.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="slike/IMG_6630 A.jpg" alt="">
                    <div class="content">
                        <h3><i class="slika"></i>Katarina Budimir</h3>
                        <p>Dolazim iz Posušja.</br> Imam 21 godinu. </br> Studentica sam treće godine studija
                            Matematika-informatika.</p>
                    </div>
                </div>
            </div>
        </section>
    @endauth

    <!--dno-->
    <section class="footer">
        <div class="icons">
            <p>Pronaći nas možete i na:</p>
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter-square"></i>
            <i class="fa fa-instagram"></i>
        </div>

    </section>
@endsection
