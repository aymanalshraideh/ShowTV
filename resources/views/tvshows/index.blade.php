@extends('layouts.master')
@section('content')
    <div class="catalog section section--first ">
        <div class="container " style="margin-top:10%">
            <div class="row">
                <!-- card -->
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card card--list">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="card__cover">
                                    <img src="{{ asset($tvShow->thumbnail) }}" alt="">

                                </div>
                            </div>

                            <div class="col-12 col-sm-8">
                                <div class="card__content">
                                    <h3 class="card__title"><a href="#">{{ $tvShow->title }}</a></h3>
                                    <span class="card__category">
                                        <a href="#"><strong>Airing Time: {{ $tvShow->airing_time }}</strong> </a>

                                    </span>

                                    <div class="card__wrap">
                                        <span class="card__rate"><i class="icon ion-ios-star"></i>8.4</span>

                                        <ul class="card__list">
                                            <li>HD</li>
                                            <li>16+</li>
                                        </ul>
                                    </div>

                                    <div class="card__description">
                                        <p>{{ $tvShow->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->


            </div>
        </div>
    </div>
    <section class="section section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-12">
                    <h2 class="section__title">Expected premiere</h2>
                </div>
                <!-- end section title -->
                @foreach ($tvShow->episodes as $item)
                    <!-- card -->
                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                        <div class="card">
                            <div class="card__cover">
                                <img src="{{ asset($item->thumbnail) }}" alt="">
                                <a href="{{ route('episodes.show',$item->id) }}" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="{{ route('episodes.show',$item->id) }}">{{ $item->title }}</a></h3>
                                <span class="card__category">
                                    <a href="#">Duration: {{ $item->duration }}</a>
                                    <a href="#">Airing: {{ $item->airing_time }}</a>
                                </span>
                                <span class="card__rate"><i class="icon ion-ios-star"></i>8.4</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- end card -->


            </div>
        </div>
    </section>
@endsection
