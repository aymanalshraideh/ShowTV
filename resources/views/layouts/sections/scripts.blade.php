<!-- JS -->
<script src="{{ asset('frontend-asset/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('frontend-asset/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend-asset/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend-asset/js/jquery.mousewheel.min.js') }}"></script>
<script src="{{ asset('frontend-asset/js/jquery.mCustomScrollbar.min.js') }}"></script>
<script src="{{ asset('frontend-asset/js/wNumb.js') }}"></script>
<script src="{{ asset('frontend-asset/js/nouislider.min.js') }}"></script>
<script src="{{ asset('frontend-asset/js/plyr.min.js') }}"></script>
<script src="{{ asset('frontend-asset/js/jquery.morelines.min.js') }}"></script>
<script src="{{ asset('frontend-asset/js/photoswipe.min.js') }}"></script>
<script src="{{ asset('frontend-asset/js/photoswipe-ui-default.min.js') }}"></script>
<script src="{{ asset('frontend-asset/js/main.js') }}"></script>
@stack('scripts')

<script>
 $(document).ready(function() {

    $('#search').on('keyup', function() {
        let query = $(this).val();

        if (query.length > 1) {
            $.ajax({
                url: '{{ route('search') }}',
                type: 'GET',
                data: { q: query },
                success: function(data) {
                    let resultsDiv = $('#search-results');
                    resultsDiv.empty().show();
                    console.log(data);


                    if (data.tv_shows.length === 0 && data.episodes.length === 0) {
                        resultsDiv.append('<div style="padding:10px;">No results found</div>');
                        return;
                    }


                    if (data.tv_shows.length > 0) {
                        resultsDiv.append('<div style="background:black; color:white; padding:5px; font-weight:bold;">TV Shows</div>');
                        data.tv_shows.forEach(function(show) {
                            resultsDiv.append(`
                                <div style="padding:10px; border-bottom:1px solid #eee; cursor:pointer; display:flex; justify-content:space-between; align-items:center;"
                                    onclick="window.location='/tvshows/${show.id}'">
                                    <div>
                                        <strong>${show.title}</strong>
                                        <br>
                                        <small>${show.description}</small>
                                    </div>
                                    <div>
                                       <img style="width: 50px;" src="{{ asset('') }}${show.thumbnail || 'frontend-asset/img/default.jpg'}" />

                                    </div>
                                </div>
                            `);
                        });
                    }


                    if (data.episodes.length > 0) {
                        resultsDiv.append('<div style="background:black; color:white; padding:5px; font-weight:bold;">Episodes</div>');
                        data.episodes.forEach(function(episode) {
                            resultsDiv.append(`
                                <div style="padding:10px; border-bottom:1px solid #eee; cursor:pointer; display:flex; justify-content:space-between; align-items:center;"
                                    onclick="window.location='/episodes/${episode.id}'">
                                    <div>
                                        <strong>${episode.title}</strong>
                                        <br>
                                        <small>${episode.tv_show ? episode.tv_show.title : ''}</small>
                                    </div>
                                    <div>
                                         <img style="width: 50px;" src="{{ asset('') }}${episode.thumbnail || 'frontend-asset/img/default.jpg'}" />
                                    </div>
                                </div>
                            `);
                        });
                    }
                }
            });
        } else {
            $('#search-results').hide();
        }
    });


    $(document).on('click', function(e) {
        if (!$(e.target).closest('#search, #search-results').length) {
            $('#search-results').hide();
        }
    });

});

</script>
