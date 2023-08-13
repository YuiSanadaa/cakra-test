@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-2">
            <div class="card">
                <div class="card-header">{{ __('Detail Country') }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Country Code</th>
                                <th>Country Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $countries['id'] }}</td>
                                <td>{{ $countries['country_code'] }}</td>
                                <td>{{ $countries['country_name'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection