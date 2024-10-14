@extends('blog.app')
@section('main')

<section class="my-5">
    <div class="container">
        @foreach ($articles as $item)
        <div class="row my-3 justify-content-center">
        <a href="{{ route('detalle', ['id' => $item->id]) }}">
            <div class="col-lg-4 md-11">
                @php
                    $imageUrl = 'default-image.jpg';
                    if ($item->imagesArticle->isNotEmpty()) {
                        $firstImage = $item->imagesArticle->first();
                        $imageUrl = $firstImage->urlImage;
                    }
                @endphp
                <img src="{{ asset('storage/article/' . $imageUrl) }}" class="img-fluid">
            </div>
            <div class="col-lg-8 md-11">

            </div>
        </a>
        </div>
    @endforeach



    </div>
</section>


@stop