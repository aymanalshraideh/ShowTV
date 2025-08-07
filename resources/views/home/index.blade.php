@extends('layouts.master')
@section('content')
    <section class="home home--bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="home__title"><b>NEW </b> Tv Show </h1>

                    <button class="home__nav home__nav--prev" type="button">
                        <i class="icon ion-ios-arrow-round-back"></i>
                    </button>
                    <button class="home__nav home__nav--next" type="button">
                        <i class="icon ion-ios-arrow-round-forward"></i>
                    </button>
                </div>

                <div class="col-12">
                    <div class="owl-carousel home__carousel">
                        @foreach ($tvShows as $item)
                            <div class="item">
                                <!-- card -->
                                <div class="card card--big">
                                    <div class="card__cover" style="height: 200px">
                                        <img src="{{ asset($item->thumbnail) }}" style="height: 100%" alt="">
                                        <a href="{{ route('tvshows.show', $item->id) }}" class="card__play">
                                            <i class="icon ion-ios-link"></i>

                                        </a>
                                    </div>
                                    <div class="card__content">
                                        <h3 class="card__title"><a
                                                href="{{ route('tvshows.show', $item->id) }}">{{ $item->title }}</a></h3>
                                        <span class="card__category">

                                            <a href="#">Airing: {{ $item->airing_time }}</a>
                                            <div>
                                                <p href="#" class="text-white" style="color: white">Type:{{ $item->type }}</p>
                                            </div>

                                        </span>

                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->
    <section class="content home">
        <div class="content__head">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- content title -->
                        <h2 class="content__title">New Episodes</h2>
                        <!-- end content title -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- content tabs -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-2" role="tabpanel" aria-labelledby="2-tab">
                    <div class="row">
                        <!-- card -->
                        @foreach ($episodes as $episode)
                            <div class="col-6 col-sm-12 col-lg-6">
                                <div class="card card--list">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="card__cover">
                                                <img src="{{ asset($episode->thumbnail) }}" alt="{{ $episode->title }}">
                                                <a href="{{ route('episodes.show', $episode->id) }}" class="card__play"
                                                    target="_blank">
                                                    <i class="icon ion-ios-play"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-8">
                                            <div class="card__content">
                                                <h3 class="card__title"><a
                                                        href="{{ route('episodes.show', $episode->id) }}">{{ $episode->title }}</a>
                                                </h3>
                                                <span class="card__category">

                                                    <a href="#">Duration: {{ $episode->duration }}</a>
                                                    <a href="#">Airing: {{ $episode->airing_time }}</a>
                                                    <a href="{{ route('tvshows.show', $episode->tvShow->id) }}">Tv Show:
                                                        <span style="color: white">{{ $episode->tvShow->title }}</span>
                                                    </a>
                                                </span>

                                                <div class="card__wrap">

                                                    <span class="card__rate"><i class="icon ion-ios-star"></i>8.4</span>

                                                    <ul class="card__list">
                                                        <li>HD</li>
                                                        <li>16+</li>
                                                    </ul>
                                                </div>

                                                <div class="card__description">
                                                    <p>{{ $episode->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <!-- end card -->
                        {{-- @if ($episodes->hasPages())
                            <div class="col-12">
                                <ul class="paginator"> --}}

                        {{-- Previous Page Link --}}
                        {{-- <li
                                        class="paginator__item paginator__item--prev {{ $episodes->onFirstPage() ? 'disabled' : '' }}">
                                        <a href="{{ $episodes->previousPageUrl() ?? '#' }}">
                                            <i class="icon ion-ios-arrow-back"></i>
                                        </a>
                                    </li> --}}

                        {{-- @php
                                        $current = $episodes->currentPage();
                                        $last = $episodes->lastPage();
                                        $start = 1;
                                        $end = $last;

                                        $visiblePages = [];

                                        // Always show first 3
                                        for ($i = 1; $i <= 3 && $i <= $last; $i++) {
                                            $visiblePages[] = $i;
                                        }

                                        // Show current -1, current, current +1
                                        for ($i = $current - 1; $i <= $current + 1; $i++) {
                                            if ($i > 3 && $i < $last - 1) {
                                                $visiblePages[] = $i;
                                            }
                                        }

                                        // Always show last 2
                                        for ($i = $last - 1; $i <= $last; $i++) {
                                            if ($i > 3) {
                                                $visiblePages[] = $i;
                                            }
                                        }

                                        $visiblePages = array_unique($visiblePages);
                                        sort($visiblePages);
                                    @endphp --}}

                        {{-- @php $lastShown = 0; @endphp
                                    @foreach ($visiblePages as $page)
                                        @if ($page - $lastShown > 1)
                                            <li class="paginator__item disabled"><a href="#">...</a></li>
                                        @endif

                                        <li
                                            class="paginator__item {{ $page == $current ? 'paginator__item--active' : '' }}">
                                            <a href="{{ $episodes->url($page) }}">{{ $page }}</a>
                                        </li>

                                        @php $lastShown = $page; @endphp
                                    @endforeach --}}

                        {{-- Next Page Link --}}
                        {{-- <li
                                        class="paginator__item paginator__item--next {{ !$episodes->hasMorePages() ? 'disabled' : '' }}">
                                        <a href="{{ $episodes->nextPageUrl() ?? '#' }}">
                                            <i class="icon ion-ios-arrow-forward"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div> --}}
                        {{-- @endif --}}


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
