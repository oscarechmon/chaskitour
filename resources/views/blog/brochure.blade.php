@extends('blog.app')
@section('main')

<div class="carousel-inner">
    <div class="carousel-item active">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="">VIVE LA HISTORIA Y EL PRESENTE</h2>
      </div>
      <img src="{{ asset('images/slide1.jpg') }}" class="d-block w-100" alt="img-1" />
    </div>
    <div class="carousel-item">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="">VIVE LA HISTORIA Y EL PRESENTE</h2>
      </div>
      <img src="{{ asset('images/slide2.jpg') }}" class="d-block w-100" alt="img-2" />
    </div>
    <div class="carousel-item">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="">VIVE LA HISTORIA Y EL PRESENTE</h2>
      </div>
      <img src="{{ asset('images/slide3.jpg') }}" class="d-block w-100" alt="img-3" />
    </div>
  </div>
<section class="mt-5">
    <div class="container">
        <div class="row justify-content-center align-items-center ">
            @foreach ( $brochures as $item)
            <div class="col-12 col-lg-4 col-sm-6">
                <div class="card mx-auto my-3" data-aos="flip-right" style="width: 18rem;">
                    <iframe class="card-img-top" src="{{ asset('storage/brochure/'.$item->url_brochure) }}" width="100%" height="300px" frameborder="0"></iframe>

                    <div class="card-body">
                        <h5 class="card-title">{{$item->title}}</h5>
                        <p class="card-text">{{$item->description}}</p>
                        <a href="{{ asset('storage/brochure/'.$item->url_brochure) }}" target="_blank" class="btn btn-primary">Ver brochure</a>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</section>

<!-- <section class="my-5">
    <div class="container">
        <div class="row jutify-content-center">
            <div class="col" data-aos="flip-right"><img src="{{ asset('images/slide1.jpg') }}" class="img-fluid" alt=""></div>
            <div class="col" data-aos="flip-left"><img src="{{ asset('images/slide1.jpg') }}" class="img-fluid" alt=""></div>
        </div>
    </div>

</section> -->
@stop