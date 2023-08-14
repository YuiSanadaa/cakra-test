@extends('layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-2">
                <div class="card">
                    <div class="card-header">{{ __('List City') }}</div>
                    <div class="card-body">
                        <div class="form-group">
                            <button type="button" data-toggle="modal" data-target="#createModal"
                                class="btn btn-primary btn-sm float-right mb-2">Create Data</button>
                        </div>
                        <table class="table table-bordered table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Country Code</th>
                                    <th>Country Name</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $country)
                                    <tr>
                                        <td>{{ $country->id }}</td>
                                        <td>{{ $country->country_code }}</td>
                                        <td>{{ $country->country_name }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary edit-button" data-toggle="modal"
                                                data-target="#editModal" data-id="{{ $country->id }}"
                                                data-country_code="{{ $country->country_code }}"
                                                data-country_name="{{ $country->country_name }}">Edit</button>
                                            <button type="button" class="btn btn-info detail-button" data-toggle="modal"
                                                data-target="#detailModal" data-id="{{ $country->id }}"
                                                data-country_code="{{ $country->country_code }}"
                                                data-country_name="{{ $country->country_name }}">Detail</button>
                                            <button type="button" class="btn btn-danger delete-button"
                                                data-country_id="{{ $country->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('management.country.modal')
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var token = '{{ Session::get('jwt_token') }}';
            $('#createButton').click(function() {
                var formData = {
                    country_code: $('#country_code').val(),
                    country_name: $('#country_name').val()
                };
                $.ajax({
                    url: 'http://backend-dev.cakra-tech.co.id/api/country',
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    data: JSON.stringify(formData),
                    dataType: 'json',
                    success: function(response) {
                        $('#createModal').modal('hide');
                        showSuccessPopup();
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    },
                    error: function(error) {
                        alert('Gagal!')
                        console.log(error)
                    }
                });
            });

            $('#saveEditButton').click(function() {
                var id = $('#edit_id').val();
                var countryCode = $('#edit_country_code').val();
                var countryName = $('#edit_country_name').val();
                var editFormData = {
                    id: id,
                    country_code: countryCode,
                    country_name: countryName
                };

                $.ajax({
                    url: 'http://backend-dev.cakra-tech.co.id/api/country',
                    type: 'PUT',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    data: JSON.stringify(editFormData),
                    dataType: 'json',
                    success: function(response) {
                        $('#editModal').modal('hide');
                        showSuccessPopup();
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    },
                    error: function(error) {
                        alert('Edit failed!');
                        if (error.responseJSON && error.responseJSON.message) {
                            var errorMessage = error.responseJSON.message;
                            alert('Error: ' + errorMessage);
                        } else {
                            alert('An error occurred.');
                        }
                        console.log(error);

                    }
                });
            });

            $('.delete-button').click(function() {
                var countryId = $(this).data('country_id');

                if (confirm('Are you sure you want to delete this country?')) {
                    $.ajax({
                        url: 'http://backend-dev.cakra-tech.co.id/api/country/' + countryId,
                        type: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            $(this).closest('tr').remove();
                            showSuccessPopup();
                        },
                        error: function(error) {
                            alert('Delete failed!');
                            console.log(error);
                        }
                    });
                }
            });

            function showSuccessPopup() {
                $('#successModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#successModal').modal('show');
                startCountdown()

            }

            function startCountdown() {
                var seconds = 3;
                var countdownElement = $('#countdown');
                countdownElement.text(seconds);

                var countdownInterval = setInterval(function() {
                    seconds--;
                    countdownElement.text(seconds + (seconds === 1 ? '' :
                        's'));
                    if (seconds <= 0) {
                        clearInterval(countdownInterval);
                        location.reload();
                    }
                }, 1000);
            }

            $('.edit-button').click(function() {
                var id = $(this).data('id');
                var countryCode = $(this).data('country_code');
                var countryName = $(this).data('country_name');
                $('#edit_id').val(id);
                $('#edit_country_code').val(countryCode);
                $('#edit_country_name').val(countryName);
            });

            $('.detail-button').click(function() {
                var id = $(this).data('id');
                var countryCode = $(this).data('country_code');
                var countryName = $(this).data('country_name');
                $('#detail_id').val(id);
                $('#detail_country_code').val(countryCode);
                $('#detail_country_name').val(countryName);
                $('#detailModal').modal('show');
            });
        });
    </script>
@endsection
