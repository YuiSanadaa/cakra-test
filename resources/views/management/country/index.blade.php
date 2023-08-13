@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-2">
            <div class="card">
                <div class="card-header">{{ __('List Country') }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Country Code</th>
                                <th>Country Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($countries as $country)
                            <tr>
                                <td>{{ $country['id'] }}</td>
                                <td>{{ $country['country_code'] }}</td>
                                <td>{{ $country['country_name'] }}</td>
                                <td>
                                    <a href="{{ route('countries.show', $country['id']) }}" class="btn btn-info">View</a>
                                    {{--<form action="{{ route('countries.destroy', $country['id']) }}" method="post" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this country?')">Delete</button>
                                    </form>--}}
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
@endsection