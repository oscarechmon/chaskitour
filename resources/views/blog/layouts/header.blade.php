<header>
    <div class="info-bar text-center bg-dark text-white">
        <div class="container p-2">
            <div class="row align-items-center justify-content-evenly text-center">
                <div class="col-6 text-center">
                    <span><i class="fa-solid fa-location-dot"></i> Calle Tarapacá 417 - 2do Piso, Miraflores</span>
                </div>
                <div class="col-6 text-center">
                    <span><i class="fa-solid fa-phone"></i> +51 963 318 993 Lima e Ica</span><br>
                    <span><i class="fa-solid fa-phone"></i> +51 987 620 911 Cusco</span>
                </div>
                <div class="col-6 text-center">
                    <span><i class="fa-regular fa-envelope"></i> chaskitourperu@gmail.com</span>
                </div>
                <div class="col-6 text-center">
                    <span>
                        <a href="https://www.instagram.com/chaski.tour/" target="_blank"><i class="fa-brands fa-square-facebook me-3"></i></a>
                        <a href="https://www.instagram.com/chaski.tour/" target="_blank"><i class="fa-brands fa-square-instagram me-3"></i></a>
                        <a href="https://www.instagram.com/chaski.tour/" target="_blank"><i class="fa-brands fa-square-youtube"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('inicio') }}"><img src="{{ asset('images/logo.png') }}" style="height: 50px;" alt=""> CHASKI TOUR</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('inicio') }}">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('nosotros') }}">NOSOTROS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('brochure') }}">BROCHURE</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('preguntas-frecuentes') }}">PREGUNTAS FRECUENTES</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contactanos') }}">CONTACTANOS</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>