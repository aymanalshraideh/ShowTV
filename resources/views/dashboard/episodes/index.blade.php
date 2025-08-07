@extends('dashboard.layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <h2>Episodes</h2>
            <div class="mb-3">
                <input type="text" id="search-episode" class="form-control" placeholder="Search by title or TV show...">
            </div>

            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#episodeModal">
                Add Episode
            </button>
        </div>
        <div class="table-responsive">

            <table id="episodes-table" class="table mt-4">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Tv Show/ Series </th>
                        <th>Title</th>
                        <th>Duration</th>
                        <th>Airing Time</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div id="pagination-links" class="mt-3"></div>

    </div>

    <!-- Episode Modal -->
    <div class="modal fade" id="episodeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="episode-form" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Episode Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="episode-id">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Title</label>
                                <input class="form-control" type="text" name="title" id="ep-title" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Duration</label>
                                <input class="form-control" type="text" name="duration" id="ep-duration" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="airing_day" class="form-label">Airing Day</label>
                                <select class="form-select" id="airing_day" required>
                                    <option value="">Select Day</option>
                                    <option>Sunday</option>
                                    <option>Monday</option>
                                    <option>Tuesday</option>
                                    <option>Wednesday</option>
                                    <option>Thursday</option>
                                    <option>Friday</option>
                                    <option>Saturday</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="airing_time_select" class="form-label">Airing Time</label>
                                <select class="form-select" id="airing_time_select" required>
                                    <option value="">Select Time</option>
                                    <option>6:00PM</option>
                                    <option>7:00PM</option>
                                    <option>8:00PM</option>
                                    <option>9:00PM</option>
                                    <option>10:00PM</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="airing_time" id="ep-airing_time">

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="ep-description" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Video URL</label>
                            <input class="form-control" type="text" name="video_url" id="video_url">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">TV Show</label>
                            <select name="tv_show_id" id="tv_show_id" class="form-select" required>
                                @foreach ($tvshows as $tvshow)
                                    <option value="{{ $tvshow->id }}">{{ $tvshow->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" id="ep-thumbnail" name="thumbnail">
                            <img id="thumbnail-preview" src="" style="max-height: 120px; display:none;"
                                class="mt-2">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewEpisodeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Episode Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img id="view-ep-thumbnail" src="" style="max-height: 180px;">
                    </div>
                    <p><strong>Title:</strong> <span id="view-ep-title"></span></p>
                    <p><strong>Duration:</strong> <span id="view-ep-duration"></span></p>
                    <p><strong>Airing Time:</strong> <span id="view-ep-airing-time"></span></p>
                    <p><strong>Description:</strong></p>
                    <p id="view-ep-description"></p>
                    <p><strong>Video URL:</strong> <span id="view-ep-video-url"></span></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts-admin')
    <script>
        $(document).ready(function() {
            fetchEpisodes();

            $('[data-bs-target="#episodeModal"]').on('click', function() {
                $('#episode-form')[0].reset();
                $('#episode-id').val('');
                $('#thumbnail-preview').hide().attr('src', '');
            });
        });

        const episodeRoutes = {
            index: "{{ route('epis.index') }}",
            store: "{{ route('epis.store') }}",
            update: (id) => `{{ route('epis.update', ':id') }}`.replace(':id', id),
            destroy: (id) => `{{ route('epis.destroy', ':id') }}`.replace(':id', id),
        };
        console.log(episodeRoutes);


        $('#episode-form').submit(function(e) {
            e.preventDefault();
            let id = $('#episode-id').val();
            let url = id ? episodeRoutes.update(id) : episodeRoutes.store;
            let day = $('#airing_day').val();
            let time = $('#airing_time_select').val();

            let formattedAiringTime = `${day} @ ${time}`;
            $('#ep-airing_time').val(formattedAiringTime);

            let formData = new FormData();
            formData.append('tv_show_id', $('#tv_show_id').val());
            formData.append('title', $('#ep-title').val());
            formData.append('description', $('#ep-description').val());
            formData.append('duration', $('#ep-duration').val());
            formData.append('airing_time', $('#ep-airing_time').val());
            formData.append('video_url', $('#video_url').val());
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            if (id) formData.append('_method', 'PATCH');

            let file = $('#ep-thumbnail')[0]?.files[0];
            if (file) formData.append('thumbnail', file);

            $.ajax({
                url,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
                    $('#episode-form')[0].reset();
                    $('#episode-id').val('');
                    fetchEpisodes();
                    $('#episodeModal').modal('hide');
                },
                error: function(xhr) {
                    console.error("Validation failed:", xhr.responseJSON);
                    alert("Validation error: " + JSON.stringify(xhr.responseJSON.errors));
                }

            });
        });

        const assetBaseUrl = "{{ asset('') }}";

        function fetchEpisodes(page = 1, search = '') {
            $.ajax({
                url: `${episodeRoutes.index}?page=${page}&search=${encodeURIComponent(search)}`,
                method: 'GET',
                success: function(response) {
                    const episodes = response.data;
                    $('#episodes-table tbody').empty();

                    $.each(episodes, function(_, ep) {
                        $('#episodes-table tbody').append(`
                    <tr>
                        <td><img src="${assetBaseUrl + ep.thumbnail}" alt="Thumbnail" width="60"></td>
                        <td>${ep.tv_show.type} :  ${ep.tv_show.title}</td>
                        <td>${ep.title}</td>
                        <td>${ep.duration}</td>
                        <td>${ep.airing_time}</td>
                        <td>
                            <button class="btn btn-success btn-sm view"
                                data-title="${ep.title}"
                                data-description="${ep.description}"
                                data-airing_time="${ep.airing_time}"
                                data-thumbnail="${assetBaseUrl + ep.thumbnail}"
                                data-video_url="${ep.video_url}"
                                data-duration="${ep.duration}">View</button>

                            <button class="btn btn-info btn-sm edit"
                                data-id="${ep.id}"
                                data-title="${ep.title}"
                                data-description="${ep.description}"
                                data-airing_time="${ep.airing_time}"
                                data-video_url="${ep.video_url}"
                                data-duration="${ep.duration}"
                                data-tv_show_id="${ep.tv_show_id}">Edit</button>

                            <button class="btn btn-danger btn-sm delete" data-id="${ep.id}">Delete</button>
                        </td>
                    </tr>
                `);
                    });

                    renderPagination(response, search);
                },
                error: function(err) {
                    console.error(err);
                }
            });
        }

        function renderPagination(data, search = '') {
            let pagination = `<nav><ul class="pagination justify-content-center">`;

            if (data.prev_page_url) {
                pagination += `<li class="page-item">
            <a class="page-link" href="#" data-page="${data.current_page - 1}" data-search="${search}">Previous</a>
        </li>`;
            }

            const lastPage = data.last_page;
            const currentPage = data.current_page;

            for (let i = 1; i <= Math.min(3, lastPage); i++) {
                pagination += `<li class="page-item ${currentPage === i ? 'active' : ''}">
            <a class="page-link" href="#" data-page="${i}" data-search="${search}">${i}</a>
        </li>`;
            }

            if (currentPage > 4) {
                pagination += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }

            if (currentPage > 3 && currentPage < lastPage - 2) {
                pagination += `<li class="page-item active"><a class="page-link" href="#">${currentPage}</a></li>`;
            }

            if (currentPage < lastPage - 3) {
                pagination += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }

            for (let i = Math.max(lastPage - 1, 4); i <= lastPage; i++) {
                if (i > 3) {
                    pagination += `<li class="page-item ${currentPage === i ? 'active' : ''}">
                <a class="page-link" href="#" data-page="${i}" data-search="${search}">${i}</a>
            </li>`;
                }
            }

            if (data.next_page_url) {
                pagination += `<li class="page-item">
            <a class="page-link" href="#" data-page="${data.current_page + 1}" data-search="${search}">Next</a>
        </li>`;
            }

            pagination += `</ul></nav>`;
            $('#pagination-links').html(pagination);
        }

        $('#search-episode').on('input', function() {
            const searchValue = $(this).val();
            fetchEpisodes(1, searchValue);
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).data('page');
            let search = $('#search-episode').val();
            fetchEpisodes(page, search);
        });


        $(document).on('click', '.edit', function() {
            let airingTime = $(this).data('airing_time');
            let [day, time] = airingTime.split(' @ '); // Split into day and time

            $('#airing_day').val(day);
            $('#airing_time_select').val(time);
            $('#ep-airing_time').val(airingTime);

            $('#episode-id').val($(this).data('id'));
            $('#ep-title').val($(this).data('title'));
            $('#ep-description').val($(this).data('description'));

            $('#video_url').val($(this).data('video_url'));
            $('#ep-duration').val($(this).data('duration'));
            $('#tv_show_id').val($(this).data('tv_show_id'));

            $('#thumbnail-preview').attr('src', $(this).closest('tr').find('img').attr('src')).show();
            new bootstrap.Modal(document.getElementById('episodeModal')).show();
        });

        $(document).on('click', '.delete', function() {
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: episodeRoutes.destroy($(this).data('id')),
                    method: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: fetchEpisodes
                });
            }
        });

        $(document).on('click', '.view', function() {
            $('#view-ep-title').text($(this).data('title'));
            $('#view-ep-description').text($(this).data('description'));
            $('#view-ep-airing-time').text($(this).data('airing_time'));
            $('#view-ep-video-url').text($(this).data('video_url'));
            $('#view-ep-duration').text($(this).data('duration'));
            $('#view-ep-thumbnail').attr('src', $(this).data('thumbnail'));
            new bootstrap.Modal(document.getElementById('viewEpisodeModal')).show();
        });

        $('#ep-thumbnail').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => $('#thumbnail-preview').attr('src', e.target.result).show();
                reader.readAsDataURL(file);
            } else {
                $('#thumbnail-preview').hide();
            }
        });
    </script>
@endpush
