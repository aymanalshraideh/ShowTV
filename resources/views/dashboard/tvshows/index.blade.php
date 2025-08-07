@extends('dashboard.layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <h2>TV Shows/Series </h2>
            <div class="d-flex justify-content-between align-items-center mt-4">
                <input type="text" id="search-input" class="form-control" placeholder="Search title...">
            </div>

            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tvshowModal">
                Add TV Show
            </button>
        </div>

        <!-- Table to display all TV shows -->
        <div class="table-responsive">
            <table id="tvshows-table" class="table mt-4">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Airing Time</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div id="pagination-links" class="mt-3"></div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="tvshowModal" tabindex="-1" aria-labelledby="tvshowModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="tvshow-form" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tvshowModalLabel">TV Show Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id" id="tvshow-id">

                        <div class="row mb-3">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Title</label>
                                    <input class="form-control" type="text" name="title" id="title"
                                        placeholder="Enter Title" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select" name="type" id="type" required>
                                        <option value="">Select Type</option>
                                        <option value="TV Show">TV Show</option>
                                        <option value="Series">Series</option>
                                    </select>
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

                            <!-- Hidden input to store the combined string -->
                            <input type="hidden" name="airing_time" id="airing_time">
                            <div class="col-md-12">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input class="form-control" type="file" name="thumbnail" id="thumbnail" accept="image/*">
                                <div class="mt-2">
                                    <img id="thumbnail-preview" src="" alt="Preview"
                                        style="max-height: 120px; display: none;">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Write a short description"
                                rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- View Modal -->
    <div class="modal fade" id="viewTvShowModal" tabindex="-1" aria-labelledby="viewTvShowModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">TV Show Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img id="view-thumbnail" src="" alt="Thumbnail" style="max-height: 180px;">
                    </div>
                    <p><strong>Title:</strong> <span id="view-title"></span></p>
                    <p><strong>Airing Time:</strong> <span id="view-airing-time"></span></p>
                    <p><strong>Description:</strong></p>
                    <p id="view-description"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts-admin')
    <script>
        $(document).ready(function() {
            fetchTvShows();


            $('[data-bs-target="#tvshowModal"]').on('click', function() {
                $('#tvshow-form')[0].reset();
                $('#tvshow-id').val('');
                $('#thumbnail-preview').hide().attr('src', '');
            });

        });


        const tvShowRoutes = {
            index: "{{ route('tvsh.index') }}",
            store: "{{ route('tvsh.store') }}",
            update: (id) => `{{ route('tvsh.update', ':id') }}`.replace(':id', id),
            destroy: (id) => `{{ route('tvsh.destroy', ':id') }}`.replace(':id', id),
        };

        console.log(tvShowRoutes);

        $('#tvshow-form').submit(function(e) {
            e.preventDefault();

            let id = $('#tvshow-id').val();
            let url = id ? tvShowRoutes.update(id) : tvShowRoutes.store;
            let method = id ? 'POST' : 'POST'; // Always POST when using _method override
            let day = $('#airing_day').val();
            let time = $('#airing_time_select').val();

            if (!day || !time) {
                alert('Please select both airing day and time.');
                return;
            }

            let formattedAiringTime = `${day} @ ${time}`;
            $('#airing_time').val(formattedAiringTime);

            let formData = new FormData();
            formData.append('title', $('#title').val());
            formData.append('description', $('#description').val());
            formData.append('airing_time', $('#airing_time').val());
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('type', $('#type').val());


            if (id) {
                formData.append('_method', 'PATCH');
            }

            let thumbnailInput = $('#thumbnail')[0];
            if (thumbnailInput && thumbnailInput.files.length > 0) {
                formData.append('thumbnail', thumbnailInput.files[0]);
            }

            $.ajax({
                url: url,
                method: method,
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
                    $('#tvshow-form')[0].reset();
                    $('#tvshow-id').val('');
                    fetchTvShows();
                    $('#tvshowModal').modal('hide');
                }
            });
        });

        const assetBaseUrl = "{{ asset('') }}";

        function fetchTvShows(page = 1) {
            const search = $('#search-input').val();

            $.ajax({
                url: tvShowRoutes.index + `?page=${page}&search=${search}`,
                method: 'GET',
                success: function(data) {
                    const tvshows = data.data;

                    $('#tvshows-table tbody').empty();
                    $.each(tvshows, function(index, show) {
                        $('#tvshows-table tbody').append(`
                    <tr>
                        <td><img src="${assetBaseUrl + show.thumbnail}" width="60"></td>
                        <td>${show.title}</td>
                        <td>${show.airing_time}</td>
                        <td>${show.description}</td>
                        <td>${show.type}</td>
                        <td>
                            <button class="btn btn-success btn-sm view" data-title="${show.title}" ...>View</button>
                            <button class="btn btn-info btn-sm edit" data-id="${show.id}" ...>Edit</button>
                            <button class="btn btn-danger btn-sm delete" data-id="${show.id}">Delete</button>
                        </td>
                    </tr>
                `);
                    });

                    renderPagination(data);
                }
            });
        }
        $('#search-input').on('input', function() {
            fetchTvShows(1);
        });

        function renderPagination(data) {
            let html = `<nav><ul class="pagination justify-content-center">`;

            if (data.prev_page_url) {
                html +=
                    `<li class="page-item"><a href="#" class="page-link" data-page="${data.current_page - 1}">Previous</a></li>`;
            }

            for (let i = 1; i <= data.last_page; i++) {
                html += `<li class="page-item ${i === data.current_page ? 'active' : ''}">
                    <a href="#" class="page-link" data-page="${i}">${i}</a>
                 </li>`;
            }

            if (data.next_page_url) {
                html +=
                    `<li class="page-item"><a href="#" class="page-link" data-page="${data.current_page + 1}">Next</a></li>`;
            }

            html += `</ul></nav>`;
            $('#pagination-links').html(html);
        }

        $(document).on('click', '#pagination-links .page-link', function(e) {
            e.preventDefault();
            const page = $(this).data('page');
            fetchTvShows(page);
        });

        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            let title = $(this).data('title');
            let description = $(this).data('description');
            let airingTime = $(this).data('airing_time');
            let [dayPart, timePart] = airingTime.split(' @ ');
            let type = $(this).data('type');


            $('#tvshow-id').val(id);
            $('#title').val(title);
            $('#description').val(description);
            $('#airing_day').val(dayPart);
            $('#airing_time_select').val(timePart);
            $('#airing_time').val(airingTime);
            $('#type').val(type);
            // Show thumbnail preview
            let thumbnailUrl = $(this).closest('tr').find('img').attr('src');
            $('#thumbnail-preview').attr('src', thumbnailUrl).show();

            let modal = new bootstrap.Modal(document.getElementById('tvshowModal'));
            modal.show();
        });


        $(document).on('click', '.delete', function() {
            let id = $(this).data('id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: tvShowRoutes.destroy(id),
                    method: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        fetchTvShows();
                    }
                });
            }
        })
        // Show preview when a file is selected
        $('#thumbnail').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#thumbnail-preview')
                        .attr('src', e.target.result)
                        .show();
                };
                reader.readAsDataURL(file);
            } else {
                $('#thumbnail-preview').hide();
            }
        });
        $(document).on('click', '.view', function() {
            let title = $(this).data('title');
            let description = $(this).data('description');
            let airingTime = $(this).data('airing_time');
            let thumbnail = $(this).data('thumbnail');

            $('#view-title').text(title);
            $('#view-description').text(description);
            $('#view-airing-time').text(airingTime);
            $('#view-thumbnail').attr('src', thumbnail);

            let viewModal = new bootstrap.Modal(document.getElementById('viewTvShowModal'));
            viewModal.show();
        });
    </script>
@endpush
