<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logoblanco.png') }}" type="image/png">
    <script
        src="https://kit.fontawesome.com/0121ca8a86.js"
        crossorigin="anonymous"></script>
    <title>Chaski Tour</title>
    <style>
        .carousel-inner {
            z-index: -1 !important;
        }
        .carousel-item {
            position: relative;
        }
        .carousel-item::before{
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .carousel-item img {
            height: 75vh;
            object-fit: cover;
            z-index: 1;
        }

        @media screen and (max-width:900px) {
            .carousel-item img {
                height: 40vh;
                object-fit: cover;
                z-index: 0;
            }

        }
        @media screen and (max-width:550px) {
            .carousel-item img {
                height: 30vh;
                object-fit: cover;
                z-index: 0;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
</head>