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
                                    <th>City Code</th>
                                    <th>City Name</th>
                                    <th>Province Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="cityTable">
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
    @include('management.city.modal')
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var token = '{{ Session::get('jwt_token') }}';

            var citys = {!! json_encode($citys) !!};
            var itemsPerPage = 10;
            var currentPage = 1;

            function displaycitys(page) {
                var startIndex = (page - 1) * itemsPerPage;
                var endIndex = Math.min(startIndex + itemsPerPage, citys.length);

                var cityTable = document.getElementById('cityTable');
                cityTable.innerHTML = '';

                for (var i = startIndex; i < endIndex; i++) {
                    var city = citys[i];
                    var row = '<tr><td>' + city.id + '</td><td>' + city.city_code + '</td><td>' +
                        city.city_name + '</td><td>' + city.province.province_name +
                        '</td><td class="text-center">' +
                        '<button class="btn btn-primary edit-button" data-toggle="modal" data-target="#editModal" ' +
                        'data-id="' + city.id + '" data-city_code="' + city.city_code + '" ' +
                        'data-city_name="' + city.city_name + '" data-province_id="' + city.province
                        .id + '" data-province_code="' + city.province.province_code + '" ' +
                        'data-province_name="' + city.province.province_name + '">Edit</button>' + '&nbsp' +
                        '<button class="btn btn-info detail-button" data-toggle="modal" data-target="#detailModal" ' +
                        'data-id="' + city.id + '" data-city_code="' + city.city_code + '" ' +
                        'data-city_name="' + city.city_name + '" data-province_id="' + city.province
                        .id + '" data-province_code="' + city.province.province_code + '" ' +
                        'data-province_name="' + city.province.province_name + '">Detail</button>' + '&nbsp' +
                        '<button type="button" class="btn btn-danger delete-button"' +
                        'data-city_id="' + city.id + '">Delete</button>' +
                        '</td></tr>';
                    cityTable.insertAdjacentHTML('beforeend', row);
                }
            }

            displaycitys(currentPage);

            document.getElementById('prevPage').addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    displaycitys(currentPage);
                }
            });

            document.getElementById('nextPage').addEventListener('click', function() {
                if (currentPage < Math.ceil(citys.length / itemsPerPage)) {
                    currentPage++;
                    displaycitys(currentPage);
                }
            });

            $('.detail-button').click(function() {
                var id = $(this).data('id');
                var cityCode = $(this).data('city_code');
                var cityName = $(this).data('city_name');
                var provinceId = $(this).data('province_id');
                var provinceName = $(this).data('province_name');
                var provinceCode = $(this).data('province_code')

                $('#detail_id').val(id);
                $('#detail_city_code').val(cityCode);
                $('#detail_city_name').val(cityName);
                $('#detail_province_name').val(provinceName);
                $('#detail_province_code').val(provinceCode);
                $('#detailModal').modal('show');
            });

            //buat create
            $.ajax({
                url: 'http://backend-dev.cakra-tech.co.id/api/province',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                success: function(response) {

                    var provinceSelect = $('#province_id');
                    provinceSelect.empty();


                    provinceSelect.append('<option value="">Select province Code</option>');


                    response.forEach(function(province) {
                        provinceSelect.append('<option value="' + province.id + '">' + province
                            .province_code + '-' + province.province_name + '</option>');
                    });
                },
                error: function(error) {

                }
            });


            $(document).on('click', '.edit-button', function() {
                var id = $(this).data('id');
                var cityCode = $(this).data('city_code');
                var cityName = $(this).data('city_name');
                var provinceId = $(this).data('province_id');
                var provinceName = $(this).data('province_name');
                var provinceOptions = '';

                $('#edit_id').val(id);
                $('#edit_city_code').val(cityCode);
                $('#edit_city_name').val(cityName);


                provinceOptions += '<option value="' + provinceId + '" selected>' + provinceName +
                    '</option>';
                province.forEach(function(province) {
                    if (province.id !==
                        provinceId) {
                        provinceOptions += '<option value="' + province.id + '">' + province
                            .province_name + '</option>';
                    }
                });


                $('#edit_province_id').html(provinceOptions);
            });

            var province = [];

            $.ajax({
                url: 'http://backend-dev.cakra-tech.co.id/api/province',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                success: function(response) {

                    province = response;


                },
                error: function(error) {

                }
            });


            $('#saveCityButton').click(function() {
                var formData = {
                    city_code: $('#city_code').val(),
                    city_name: $('#city_name').val(),
                    province_id: $('#province_id').val()
                };
                console.log(formData)
                $.ajax({
                    url: 'http://backend-dev.cakra-tech.co.id/api/city',
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

            $('#saveEditCityButton').click(function() {
                var id = $('#edit_id').val();
                var cityCode = $('#edit_city_code').val();
                var cityName = $('#edit_city_name').val();
                var provinceId = $('#edit_province_id').val();

                var editFormData = {
                    id: id,
                    city_code: cityCode,
                    city_name: cityName,
                    province_id: provinceId
                };

                $.ajax({
                    url: 'http://backend-dev.cakra-tech.co.id/api/city',
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
                var cityId = $(this).data('city_id');

                if (confirm('Are you sure you want to delete this City?')) {
                    $.ajax({
                        url: 'http://backend-dev.cakra-tech.co.id/api/city/' + cityId,
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
