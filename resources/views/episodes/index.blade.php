@extends('layouts.master')
@section('content')
    <section class="section details">
        <!-- details background -->
        <div class="details__bg" data-bg="{{ asset('frontend-asset/img/home/home__bg.jpg') }}"></div>
        <!-- end details background -->

        <!-- details content -->
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="details__title">{{ $episode->title }}</h1>
                        </div>
                        <div>
                            <button class="like-btn section__btn" data-id="{{ $episode->id }}"
                                data-auth="{{ auth()->check() ? 'true' : 'false' }}">
                                <div class=""
                                    style="    margin: 0 5%; padding: 2% 3%; display:flex; justify-content: center;align-items: center; background-color: black;border-radius: 50%;">
                                    <i class="icon ion-ios-heart"></i>
                                </div>

                                <span>{{ auth()->check() && auth()->user()->likes->contains($episode->id) ? 'Unlike' : 'Like' }}</span>
                            </button>

                        </div>
                    </div>




                </div>
                <!-- end title -->

                <!-- content -->
                <div class="col-12 col-xl-6">
                    <div class="card card--details">
                        <div class="row">
                            <!-- card cover -->
                            <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-5">
                                <div class="card__cover">

                                    <img src="{{ asset($episode->thumbnail) }}" alt="">
                                </div>
                            </div>
                            <!-- end card cover -->

                            <!-- card content -->
                            <div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                                <div class="card__content">
                                    <div class="card__wrap">
                                        <span class="card__rate"><i class="icon ion-ios-star"></i>8.4</span>

                                        <ul class="card__list">
                                            <li>HD</li>
                                            <li>16+</li>
                                        </ul>
                                    </div>

                                    <ul class="card__meta">



                                        <li><span>Duration:</span> <a href="#">{{ $episode->duration }}</a> </li>
                                        <li><span>Airing:</span> <a href="#">{{ $episode->airing_time }}</a></li>

                                    </ul>

                                    <div class="card__description card__description--details">
                                        {{ $episode->description }}
                                    </div>
                                </div>
                            </div>
                            <!-- end card content -->
                        </div>
                    </div>
                </div>
                <!-- end content -->

                <!-- player -->
                <div class="col-12 col-xl-6">
                    <video controls crossorigin playsinline
                        poster="../../../cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg" id="player">
                        <!-- Video files -->
                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4"
                            type="video/mp4" size="576">
                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4"
                            type="video/mp4" size="720">
                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4"
                            type="video/mp4" size="1080">
                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1440p.mp4"
                            type="video/mp4" size="1440">

                        <!-- Caption files -->
                        <track kind="captions" label="English" srclang="en"
                            src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt" default>
                        <track kind="captions" label="Français" srclang="fr"
                            src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt">

                        <!-- Fallback for browsers that don't support the <video> element -->
                        <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4"
                            download>Download</a>
                    </video>
                </div>
                <!-- end player -->


            </div>
        </div>
        <!-- end details content -->
    </section>
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.like-btn', function(e) {
            e.preventDefault();

            let episodeId = $(this).data('id');
            let isAuth = $(this).data('auth');
            let btn = $(this);

            if (isAuth !== true) {
                window.location.href = "{{ route('login') }}";
                return;
            }

            $.ajax({
                url: `/episodes/${episodeId}/like`,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    let spanText = btn.find('span');
                    if (data.status === 'like') {
                        spanText.text('Unlike');
                        btn.find('i').css('color', 'red');
                    } else {
                        spanText.text('Like');
                        btn.find('i').css('color', '');
                    }
                }
            });
        });
    </script>
@endpush
