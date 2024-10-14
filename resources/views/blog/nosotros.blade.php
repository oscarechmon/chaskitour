@extends('blog.app')
@section('main')
<style>
    li {
        list-style-type: none;
        margin-bottom: 5px;
    }
    .card {
    border: none;
    transition: transform 0.3s ease-in-out;
}

.card:hover {
    transform: scale(1.05);
}

.card i {
    transition: color 0.3s;
}

.card:hover i {
    color: #ff9800;
}

.card-body {
    padding: 2rem;
}

.card-title {
    font-size: 1.25rem;
    font-weight: bold;
    margin-top: 1rem;
}

.card-text {
    font-size: 1rem;
    color: #6c757d;
}
</style>
<div class="container">
    <div
        class="row justify-content-evenly align-content-center my-md-5 my-3">
        <div class="col-12 col-md-5" data-aos="flip-right">
            <h2>Misión</h2>

            <p>
                CHASKI TOUR, tiene como misión ofrecerles a nuestros pasajeros
                nacionales e internacionales una experiencia única e inolvidable.
                Nos especializamos en Eco turismo, Étno turismo, turismo de
                aventura (100% adrenalina), cultural, y no convencional; cuidando
                siempre nuestro medio ambiente, y zonas arqueológicas, haciendo
                participe a cada una de las comunidades nativas del desarrollo,
                crecimiento y sostenibilidad del lugar. <br>
                Somos profesionales especializados en el sector turístico, con más de 15 años de
                experiencia; trabajando para compañías nacionales y
                transnacionales.<!--  André & Yohél decidieron lanzar su propia marca
                turística, diseñando viajes hechos a la medida, escuchando y
                atendiendo a sus necesidades de relax, descanso, aventura, cultura
                y diversión; acompañándolos en todo momento durante su estadía en
                Perú <br> -->
                Aquí, podrán realizar: <br> Excursiones, Tours, Destinos varios,
                Full days, y Circuitos turísticos en privados y de forma regular.
            </p>

        </div>
        <div class="col-4" data-aos="flip-left">
            <img
                src="{{ asset('images/vision.png') }}"
                class="img-fluid d-none d-md-block"
                alt="" />
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-evenly align-content-center my-md-5 my-3">
        <div class="col-4" data-aos="flip-right">
            <img
                src="{{ asset('images/mision.png') }}"
                class="img-fluid rounded-3 d-none d-md-block"
                alt="" />
        </div>
        <div class="col-12 col-md-5" data-aos="flip-left">
            <h2>Vision</h2>
            <p>
                CHASKI TOUR, tiene como visión ser una de las DIEZ mejores
                agencias de viajes & tour operadoras, RECEPTIVO del PERÚ, dentro
                de los próximos DOS años. <br> Nos proyectamos a crecer como empresa
                sostenible e innovadora, trabajando medioambientalmente
                responsable, y socioculturalmente inclusiva. <br> Queremos ser una
                empresa modelo para el diseño y desarrollo de experiencias
                sensoriales turísticas sostenibles, de calidad y calidez a nivel
                nacional, posicionándonos como una buena alternativa proveedora de
                servicios turísticos a nivel internacional.
            </p>

        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center text-center my-md-5 my-3">
        <h2 class="text-center my-5 mx-0 p-0">Nuestros Valores</h2>
        <p class="mx-0 p-0 mb-5">
            Como parte de nuestra cultura empresarial, asumimos como normas o principios de conducta los siguientes valores:
        </p>

        <!-- Columna de valores -->
        <div class="col-12 col-md-4 mb-4" data-aos="fade-up">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <i class="fa-solid fa-hand-holding-heart fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">PRIMERO EL CLIENTE</h5>
                    <p class="card-text">Nuestro enfoque siempre está en brindar la mejor experiencia para nuestros clientes.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-4" data-aos="fade-up">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <i class="fa-solid fa-people-carry-box fa-3x text-success mb-3"></i>
                    <h5 class="card-title">VOCACIÓN DE SERVICIO</h5>
                    <p class="card-text">Entregamos nuestros servicios con pasión y dedicación hacia los demás.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-4" data-aos="fade-up">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <i class="fa-solid fa-handshake fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">EMPATÍA</h5>
                    <p class="card-text">Nos esforzamos por entender las perspectivas y necesidades de nuestros clientes y colegas.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-4" data-aos="fade-up">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <i class="fa-solid fa-shield-alt fa-3x text-danger mb-3"></i>
                    <h5 class="card-title">INTEGRIDAD</h5>
                    <p class="card-text">Actuamos con honestidad y principios sólidos en todas nuestras acciones.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-4" data-aos="fade-up">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <i class="fa-solid fa-gem fa-3x text-info mb-3"></i>
                    <h5 class="card-title">CALIDAD</h5>
                    <p class="card-text">Buscamos la excelencia en cada aspecto de nuestro trabajo y servicios.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-4" data-aos="fade-up">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <i class="fa-solid fa-users fa-3x text-secondary mb-3"></i>
                    <h5 class="card-title">TRABAJO EN EQUIPO</h5>
                    <p class="card-text">El esfuerzo colectivo impulsa nuestro éxito, colaboramos siempre.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-4" data-aos="fade-up">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <i class="fa-solid fa-lightbulb fa-3x text-dark mb-3"></i>
                    <h5 class="card-title">ESPACIO PARA LA INNOVACIÓN</h5>
                    <p class="card-text">Fomentamos la creatividad y la búsqueda de nuevas ideas para mejorar constantemente.</p>
                </div>
            </div>
        </div>
    </div>
</div>

</section>

<section class="my-5">
    <div class="container d-flex">

    </div>
</section>
@stop