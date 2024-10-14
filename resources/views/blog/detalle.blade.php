@extends('blog.app')
@section('main')
<style>
    .form {
        padding: 3rem;
    }

    .tab {
        padding: 10px 100px;
    }

    .form .btn {
        color: white;
        background-color: #01276A;
        width: 100%;
    }
    .image-fit {
    max-height: 250px;
    max-width: 100%;
    background-color: #f5f5f5;  /* Fondo para imágenes más pequeñas */
    padding: 5px;
    border-radius: 8px;
}
.image-fit {
    width: 100%;
    aspect-ratio: 4/3; /* Relación de aspecto para imágenes horizontales y verticales */
    object-fit: cover;
}


</style>
<section>
    <div class="container">
        <div class="row justify-content-center my-md-5 my-2">
            <h2 class="text-start mb-md-4 mb-3">{{ $product->product }}</h2>
            <div class="owl-carousel justify-content-center d-flex" id="img-propiedad">
                @foreach ($images_product as $item)
                @if ($item->status == 1)
                <div class="item">
                    <a href="{{ asset('storage/product/' . $item->url_image) }}" data-lightbox="roadtrip">
                        <img src="{{ asset('storage/product/' . $item->url_image) }}" class="img-fluid image-fit">
                    </a>
                </div>
                @endif
                @endforeach
            </div>
        </div>

        <div class="row mb-md-5 my-2">
            <div class="col-md-6 col-lg-8 pe-5 order-md-1 order-2" style="text-align: justify">
                <h3 class="mb-3"><strong>Itinerario</strong></h3>

                <p>
                    {{ $product->itinerary }}
                </p>


            </div>
            <div class="col-lg-4 col-md-6 order-md-1 order-1">
                <form class="form m-auto border-1 border" action="">
                    <div class="d-flex m-auto justify-content-center align-items-center p-3">
                        <i class="fa-brands fa-whatsapp" style="font-size:60px"></i>
                        <span class="ms-3 fs-3 fw-bold">Contáctanos </span>
                    </div>
                    <textarea class="form-control mb-3" id="mensaje_form_detalle" rows="10">Hola, estoy intersado(a) con respecto a su servicio</textarea>
                    <button id="btn_form_detalle" type="button" class="btn btn-block btn-primary mb-4 p-2" onclick="enviarMensajeWhts()">Enviar</button>
                    <span style="text-transform: capitalize;"></span><br>
                    <div class="mt-2">
                        <p class="fs-4 m-0"></p>
                        <a href="mailto:" class="text-dark"></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
<div class="container">
    <div class="row">
        <div class="col-11 col-md-6">
            @php
            $hasIncludes1 = $includes->where('estado', 1)->count();
            @endphp
            @php
            $hasIncludes0 = $includes->where('estado', 0)->count();
            @endphp

            @if ($hasIncludes1 > 0)
            <h2 class="m-0 fw-bold my-2">Incluye</h2>
            @foreach ($includes as $include)
            @if ($include->estado == 1)
            <p><i class="fa-solid fa-check"></i> {{ $include->includes }}</p>
            @endif
            @endforeach
            @endif
        </div>


        <div class="col-11 col-md-6">
            @if ($hasIncludes0 > 0)
            <h2 class="m-0 fw-bold my-2">No incluye</h2>
            @foreach ($includes as $item)
            @if ($item->estado==0)
            <p><i class="fa-solid fa-x"></i> {{ $item->includes }}</p>
            @endif
            @endforeach
            @endif
        </div>
    </div>
    <h2 class="m-0 fw-bold mt-2">Precio por persona</h2>
    <span class="fs-1 fw-bold">${{ number_format($product->price_per_person,2) }}</span>

</div>
<div class="container">
    <div class="row">
        <h2 class="m-0 fw-bold my-2">Recomendaciones</h2>
        @foreach ($recommendations as $item)
        <p>{{$item->recommendation}}</p>
        @endforeach
    </div>

</div>
<script>
    function enviarMensajeWhts() {
        const mensaje_chat = document.getElementById('mensaje_form_detalle').value;
        const numero_telefono = '940377852'; // Reemplaza con el número correcto
        window.open(`https://wa.me/51${numero_telefono}?text=${encodeURIComponent(mensaje_chat)}`, '_blank');
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $(document).ready(function() {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,
                }
            },
            loop: true,
            margin: 10,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplaySpeed: 5000,
            autoplayHoverPause: true,
            slideTransition: 'linear'
        });
    });
</script>

@stop