@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">Customer Card Details</h4>
            <a href="{{ url('card') }}" class="btn btn-info  btn-sm" title="Back to Class">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body">
            <table class="table table-responsive">
                <tr class="table-bordered">
                    <th>Id:</th>
                    <td>{{ $card->id }}</td>
                </tr>
                <tr class="table-bordered">
                    <th>Name:</th>
                    <td>{{ $card->name }}</td>
                </tr>
                <tr class="table-bordered text-start">
                    <th>Active:</th>
                    <td>
                    <td>{{ $card->email }}</td>
                    </td>
                </tr>
                <tr class="table-bordered">
                    <th>Description:</th>
                    <td>{{ $card->consumrd_meal }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
