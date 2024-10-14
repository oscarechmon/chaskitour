@extends('blog.app')
@section('main')
<style>
  .ribbon-wrapper {
    width: 100px;
    height: 100px;
    overflow: hidden;
    position: absolute;
    top: -3px;
    left: -3px;
  }

  .ribbon {
    font: bold 15px sans-serif;
    text-align: center;
    transform: rotate(-45deg);
    /* Rotación de la cinta */
    position: relative;
    padding: 7px 0;
    top: 15px;
    left: -30px;
    width: 120px;
    background-color: #ebb134;
    /* Color de fondo de la cinta */
    color: #fff;
    /* Color del texto */
  }

  .ribbon span {
    display: block;
    transform: rotate(0deg);
    /* Mantiene el texto sin rotar */
  }.carousel-caption h2{
    font-size: 4rem;
    color: white !important;
    z-index: 99 !important;
  }

/* estosp */
  
</style>
<div
  id="carouselExampleFade"
  class="carousel slide carousel-fade"
  data-bs-ride="carousel"
  data-bs-interval="3000">
  
  <ol class="carousel-indicators">
    <li data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active"></li>
    <li data-bs-target="#carouselExampleFade" data-bs-slide-to="1"></li>
    <li data-bs-target="#carouselExampleFade" data-bs-slide-to="2"></li>
  </ol>

  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="">VIVE LA HISTORIA Y EL PRESENTE</h2>
      </div>
      <img src="{{ asset('images/slide1.jpg') }}" class="d-block w-100" alt="imagenes/slide1.jpg" />
    </div>
    <div class="carousel-item">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="">VIVE LA HISTORIA Y EL PRESENTE</h2>
      </div>
      <img src="{{ asset('images/slide2.jpg') }}" class="d-block w-100" alt="imagenes/slide1.jpg" />
    </div>
    <div class="carousel-item">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="">VIVE LA HISTORIA Y EL PRESENTE</h2>
      </div>
      <img src="{{ asset('images/slide3.jpg') }}" class="d-block w-100" alt="..." />
    </div>
  </div>

  <button
    class="carousel-control-prev"
    type="button"
    data-bs-target="#carouselExampleFade"
    data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button
    class="carousel-control-next"
    type="button"
    data-bs-target="#carouselExampleFade"
    data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<section class="my-5">
  <div class="container">
    <div class="row justify-content-between justify-content-center">
      <h2>Nuestros TOURS</h2>
      <div class="owl-carousel owl-theme">
        @foreach ($products as $item)
        <div class="card mx-auto my-3" style="width: 18rem;">
          <img class="card-img-top" src="{{ asset('storage/product/images/'.$item->main_image) }}" alt="Card image cap" style="height:204px;">
          <div class="card-body">
            <h5 class="card-title">{{$item->product}}</h5>
            <p class="card-text">{{$item->tour}}</p>
            <a href="{{ route('product', ['id' => $item->id]) }}" class="btn btn-primary">Ver Detalle</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row text-center">
      <div class="col-12 col-md-6">
        <h2>LIMA</h2>
        <video controls style=" max-width: 250px;height: auto;">
          <source src="{{ asset('storage/product/videos/asd.mp4') }}" type="video/mp4">
        </video> 
      </div>
      <div class="col-12 col-md-6">
      <h2>ICA</h2>
        <video controls style=" max-width: 250px;height: auto;">
          <source src="{{ asset('storage/product/videos/1727664551.mp4') }}" type="video/mp4">
        </video>
      </div>
  </div>
</section>
<!-- Owl Carousel CSS -->


<!-- Owl Carousel JS -->

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
      nav: true,  // Habilitar botones de navegación
      dots: false,  // Deshabilitar puntos de navegación
      autoplay: true,
      autoplayTimeout: 5000,
      autoplaySpeed: 5000,
      autoplayHoverPause: true,
      slideTransition: 'linear',
      navText: [
        '<i class="fa fa-chevron-left"></i>',  // Icono de flecha izquierda
        '<i class="fa fa-chevron-right"></i>'  // Icono de flecha derecha
      ]
    });
  });
</script>


@stop