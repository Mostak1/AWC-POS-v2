@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">List of Food Category</h4>
            <div class="">
                <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#ModalCreate"
                    href="{{ url('customer/create') }}">
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
                            <th colspan="7" class="tablebtn text-end">
                            </th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Discount</th>
                            <th>Total Order</th>
                            <th>Total Bill</th>

                            {{-- <th>Card Number</th>
                            <th>Card Validity</th>
                            <th>Card Activation</th>
                            <th>Menu</th>
                            <th>Total Meal</th>
                            <th>Consumed Meal</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->user->email }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>
                                    @if ($item->card_status == 1)
                                        Customer
                                    @elseif($item->card_status == 2)
                                        Staff
                                    @elseif($item->card_status == 3)
                                        Pathao
                                    @elseif($item->card_status == 4)
                                        Food Panda
                                    @elseif($item->card_status == 5)
                                        Chairman Sir
                                    @endif
                                   ({{ $item->discount }})


                                </td>
                                <td>{{ $item->total_meal }}</td>
                                <td>{{ $item->consumed_meal }}</td>
                                {{-- <td>{{ $item->card_number }}</td>
                                <td>{{ $item->valid_date }}</td>
                                <td>{{ $item->active_date }}</td> --}}
                                {{-- <td>
                                    @if ($item->card_status == 1)
                                        Customer
                                    @elseif($item->card_status == 2)
                                        Staff
                                    @elseif($item->card_status == 3)
                                        Pathao
                                    @elseif($item->card_status == 4)
                                        Food Panda
                                    @elseif($item->card_status == 5)
                                        Chairman Sir
                                    @endif
                                </td> --}}
                                {{-- <td>{{ $item->menu->name }}</td> --}}
                                {{-- <td>{{ $item->total_meal }}</td>
                                <td>{{ $item->consumed_meal }}</td> --}}
                                <td class="">
                                    <div class="skip d-flex justify-content-center">


                                        {!! Form::open(['method' => 'delete', 'route' => ['customer.destroy', $item->id], 'id' => 'deleteform']) !!}
                                        <a href="javascript:void(0)" class="btn btn-danger  btn-sm" title="Delete"
                                            onclick="event.preventDefault();if (!confirm('Are you sure?')) return; document.getElementById('deleteform').submit();">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                        {!! Form::close() !!}
                                        &nbsp;
                                        <a href="{{ url('customer/' . $item->id . '/edit') }}" class="btn btn-info  btn-sm"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        &nbsp;
                                        {{-- <a href="{{ url('customer/' . $item->id) }}" class="btn btn-info  btn-sm"
                                            title="View">
                                            <i class="fas fa-eye"></i>
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('customer.modal')
@endsection

@section('script')
@endsection
