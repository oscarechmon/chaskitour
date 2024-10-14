@extends('blog.app')
@section('main')
<div class="container">
    <div class="row justify-content-evenly align-content-center my-md-5 my-3">
        <div class="col-12 col-md-5">
            <h2>Comunidad</h2>
            <h2>
                Contáctanos Diseñamos viajes a la medida, orientados a
                crear experiencias únicas.
            </h2>
            <p>
                Somos dos hermanos peruanos, dedicados al rubro turístico y
                especializados en el diseño de viajes a la medida. Tenemos más de
                15 años de experiencia en RECEPTIVO; nuestros estándares de
                calidad son muy altos, lo cual garantiza una atención y servicio
                A1.
            </p>
            <button class="btn btn-light">Contactar</button>
        </div>
        <div class="col-4">
            <img src="{{ asset('images/img.png') }}" class="img-fluid d-none d-md-block" alt="">
        </div>
    </div>
</div>
</section>
<section class="mt-5 bg-light">
    <div class="container py-5">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row justify-content-center align-items-center ">
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <h3>Contáctanos</h3>
                <div class="d-md-flex justify-content-">
                    <div class="mb-3 form-floating col-md-6 col-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="name@example.com">
                        <label for="name">Nombre(s) y Apellidos</label>
                    </div>
                    <div class="mb-3 form-floating col-md-6 col-12">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                        <label for="email">Email address</label>
                    </div>
                </div>
                <div class="">
                    <div class="mb-3 form-floating col-12">
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="name@example.com">
                        <label for="phone">Telefono</label>
                    </div>
                </div>
                <div class="">
                    <div class="mb-3 form-floating col-12">
                        <textarea class="form-control" name="message" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Mensaje</label>
                    </div>
                </div>
                <button class="btn btn-dark">Enviar</button>
            </form>
        </div>
    </div>
</section>
<section class="my-5">
    <div class="container d-flex" data-aos="fade-up"
    data-aos-anchor-placement="center-bottom">
        <img src="{{ asset('images/bground.jpg') }}" class="img-fluid rounded-3 mx-auto" alt="">
    </div>
</section>
@stop