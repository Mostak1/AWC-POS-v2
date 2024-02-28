@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">List of Classes</h4>
            <div class="">
                <a class="btn btn-sm btn-info" href="{{ url('order') }}">
                    <i class="fa-solid fa-plus"></i>
                    Go To Order
                </a>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body mt-4">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="9" class="tablebtn text-end">
                            </th>
                        </tr>
                        <tr>
                            <th>Invoice Id</th>
                            <th>Table Name</th>
                            <th>Total Amount</th>
                            <th>Discount</th>
                            <th>Reason</th>
                            <th>Staff/Other</th>
                            <th>Order By</th>
                            <th>Order Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($items as $offorder)
                            <tr>
                                <td>{{ $offorder->id }}</td>
                                <td>{{ $offorder->tab->name }}</td>
                                <td>{{ $offorder->total }}</td>
                                <td>{{ $offorder->discount }}</td>
                                <td>{{ $offorder->reason }}</td>
                                <td>
                                    @if ($offorder->active==1)
                                    Customer
                                    @elseif($offorder->active==2)
                                    Staff
                                    @endif
                                </td>
                                <td>{{ $offorder->user->name }}</td>
                                <td>{{ $offorder->created_at->format('d M y') }}</td>

                                <td class="">
                                    <div class="skip d-flex justify-content-center">

                                        {!! Form::open(['method' => 'delete', 'route' => ['offorder.destroy', $offorder->id], 'id' => 'deleteform']) !!}
                                        <a href="javascript:void(0)" class="btn btn-danger  btn-sm" title="Delete"
                                            onclick="event.preventDefault();if (!confirm('Are you sure?')) return; document.getElementById('deleteform').submit();">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                        {!! Form::close() !!}
                                        &nbsp;
                                        <a href="{{ url('offorder/' . $offorder->id . '/edit') }}"
                                            class="btn btn-info  btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        &nbsp;
                                        <a href="{{ url('offorder/' . $offorder->id) }}" class="btn btn-info  btn-sm"
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
