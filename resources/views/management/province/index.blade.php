@extends('layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-2">
                <div class="card">
                    <div class="card-header">{{ __('List Country') }}</div>
                    <div class="card-body">
                        <div class="form-group">
                            <button type="button" data-toggle="modal" data-target="#createModal"
                                class="btn btn-primary btn-sm float-right mb-2">Create Data</button>
                        </div>
                        <table class="table table-bordered table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Province Code</th>
                                    <th>Province Name</th>
                                    <th>Country Name</th>
                                    <th class="text-center">Action</th>
                                    {{-- <th class="text-center">Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody id="provincesTable">
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <ul class="pagination">
                            <li class="page-item" id="prevPage">
                                <a class="page-link" href="#">Previous</a>
                            </li>
                            <li class="page-item" id="nextPage">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('management.province.modal')
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var token = '{{ Session::get('jwt_token') }}';

            var provinces = {!! json_encode($provinces) !!};
            var itemsPerPage = 10;
            var currentPage = 1;

            function displayProvinces(page) {
                var startIndex = (page - 1) * itemsPerPage;
                var endIndex = Math.min(startIndex + itemsPerPage, provinces.length);

                var provincesTable = document.getElementById('provincesTable');
                provincesTable.innerHTML = '';

                for (var i = startIndex; i < endIndex; i++) {
                    var province = provinces[i];
                    var row = '<tr><td>' + province.id + '</td><td>' + province.province_code + '</td><td>' +
                        province.province_name + '</td><td>' + province.country.country_name +
                        '</td><td class="text-center">' +
                        '<button class="btn btn-primary edit-button" data-toggle="modal" data-target="#editModal" ' +
                        'data-id="' + province.id + '" data-province_code="' + province.province_code + '" ' +
                        'data-province_name="' + province.province_name + '" data-country_id="' + province.country
                        .id + '" data-country_code="' + province.country.country_code + '" ' +
                        'data-country_name="' + province.country.country_name + '">Edit</button>' + '&nbsp' +
                        '<button class="btn btn-info detail-button" data-toggle="modal" data-target="#detailModal" ' +
                        'data-id="' + province.id + '" data-province_code="' + province.province_code + '" ' +
                        'data-province_name="' + province.province_name + '" data-country_id="' + province.country
                        .id + '" data-country_code="' + province.country.country_code + '" ' +
                        'data-country_name="' + province.country.country_name + '">Detail</button>' + '&nbsp' +
                        '<button type="button" class="btn btn-danger delete-button"' +
                        'data-province_id="' + province.id + '">Delete</button>' +
                        '</td></tr>';
                    provincesTable.insertAdjacentHTML('beforeend', row);
                }
            }

            displayProvinces(currentPage);

            document.getElementById('prevPage').addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    displayProvinces(currentPage);
                }
            });

            document.getElementById('nextPage').addEventListener('click', function() {
                if (currentPage < Math.ceil(provinces.length / itemsPerPage)) {
                    currentPage++;
                    displayProvinces(currentPage);
                }
            });

            $('.detail-button').click(function() {
                var id = $(this).data('id');
                var provinceCode = $(this).data('province_code');
                var provinceName = $(this).data('province_name');
                var countryId = $(this).data('country_id');
                var countryName = $(this).data('country_name');
                var countryCode = $(this).data('country_code')

                $('#detail_id').val(id);
                $('#detail_province_code').val(provinceCode);
                $('#detail_province_name').val(provinceName);
                $('#detail_country_name').val(countryName);
                $('#detail_country_code').val(countryCode);
                $('#detailModal').modal('show');
            });

            //buat create
            $.ajax({
                url: 'http://backend-dev.cakra-tech.co.id/api/country',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                success: function(response) {

                    var countrySelect = $('#country_id');
                    countrySelect.empty();


                    countrySelect.append('<option value="">Select Country Code</option>');


                    response.forEach(function(country) {
                        countrySelect.append('<option value="' + country.id + '">' + country
                            .country_code + '-' + country.country_name + '</option>');
                    });
                },
                error: function(error) {

                }
            });


            $(document).on('click', '.edit-button', function() {
                var id = $(this).data('id');
                var provinceCode = $(this).data('province_code');
                var provinceName = $(this).data('province_name');
                var countryId = $(this).data('country_id');
                var countryName = $(this).data('country_name');
                var countryOptions = '';

                $('#edit_id').val(id);
                $('#edit_province_code').val(provinceCode);
                $('#edit_province_name').val(provinceName);


                countryOptions += '<option value="' + countryId + '" selected>' + countryName + '</option>';
                countries.forEach(function(country) {
                    if (country.id !== countryId) {
                        countryOptions += '<option value="' + country.id + '">' + country
                            .country_name + '</option>';
                    }
                });


                $('#edit_country_id').html(countryOptions);
            });

            var countries = [];

            $.ajax({
                url: 'http://backend-dev.cakra-tech.co.id/api/country',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                success: function(response) {

                    countries = response;



                },
                error: function(error) {

                }
            });


            $('#saveProvinceButton').click(function() {
                var formData = {
                    province_code: $('#province_code').val(),
                    province_name: $('#province_name').val(),
                    country_id: $('#country_id').val()
                };
                console.log(formData)
                $.ajax({
                    url: 'http://backend-dev.cakra-tech.co.id/api/province',
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

            $('#saveEditProvinceButton').click(function() {
                var id = $('#edit_id').val();
                var provinceCode = $('#edit_province_code').val();
                var provinceName = $('#edit_province_name').val();
                var countryId = $('#edit_country_id').val();

                var editFormData = {
                    id: id,
                    province_code: provinceCode,
                    province_name: provinceName,
                    country_id: countryId
                };

                $.ajax({
                    url: 'http://backend-dev.cakra-tech.co.id/api/province',
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
                var provinceId = $(this).data('province_id');

                if (confirm('Are you sure you want to delete this Province?')) {
                    $.ajax({
                        url: 'http://backend-dev.cakra-tech.co.id/api/province/' + provinceId,
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

        });
    </script>
@endsection
