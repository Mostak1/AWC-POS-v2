@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">List of Food Category</h4>
            <div class="">
                <a class="btn btn-sm btn-info" href="{{ url('card/create') }}">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </a>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body mt-4">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="11" class="tablebtn text-end">
                            </th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>Card Number</th>
                            <th>Card Validity</th>
                            <th>Card Activation</th>
                            <th>Card Status</th>
                            <th>Menu</th>
                            <th>Total Meal</th>
                            <th>Consumed Meal</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->customer_card_number }}</td>
                                <td>{{ $item->card_valid_date }}</td>
                                <td>{{ $item->card_activation_date }}</td>
                                <td>{{ $item->card_status }}</td>
                                <td>{{ $item->menu->name }}</td>
                                <td>{{ $item->total_meal }}</td>
                                <td>{{ $item->consumrd_meal }}</td>
                                <td class="">
                                    <div class="skip d-flex justify-content-center">


                                        {!! Form::open(['method' => 'delete', 'route' => ['card.destroy', $item->id], 'id' => 'deleteform']) !!}
                                        <a href="javascript:void(0)" class="btn btn-danger  btn-sm" title="Delete"
                                            onclick="event.preventDefault();if (!confirm('Are you sure?')) return; document.getElementById('deleteform').submit();">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                        {!! Form::close() !!}
                                        &nbsp;
                                        <a href="{{ url('card/' . $item->id . '/edit') }}" class="btn btn-info  btn-sm"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        &nbsp;
                                        <a href="{{ url('card/' . $item->id) }}" class="btn btn-info  btn-sm"
                                            title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
@endsection
