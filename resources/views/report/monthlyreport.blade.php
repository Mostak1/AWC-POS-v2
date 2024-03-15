@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">List of Classes</h4>
            <div class="fs-4 text-danger">
                <span class="me-4">Total Order Item: {{ $orderCountD }}</span>
                <span class="me-4">Total Sale: {{ $totalSalesD }} TK</span>
                <span class="me-4">Total Discount: {{ $totalDisD }} TK</span>
                <span class="me-4">Net Sale: {{ $totalSalesD - $totalDisD }} TK</span>
            </div>

        </div>
        <!-- Card Body -->
        <div class="card-body mt-4">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="8" class="tablebtn text-end">
                            </th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Ordered By</th>
                            <th>Order Time</th>
                            <th>Food Name</th>
                            <th>Total Amount</th>
                            <th>Discount</th>
                            <th>Reason</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($items as $offorder)
                            <tr>
                                <td>{{ $offorder->id }}</td>
                                <td>{{ $offorder->user->name }}</td>
                                <td>{{ $offorder->created_at->format('dM-y H:i A') }}</td>
                                <td>
                                    @foreach ($offorder->offorderdetails as $detail)
                                        <div class="">
                                            <span class="fs-6 ">{{ $detail->menu->name }} -</span>
                                            <span class="fs-6">Qty: {{ $detail->quantity }} </span>
                                        </div>
                                    @endforeach
                                </td>
                                <td>{{ $offorder->total }}</td>
                                <td>{{ $offorder->discount }}</td>
                                <td>{{ $offorder->reason }}</td>

                                <td class="skip d-flex justify-content-center">
                                    {!! Form::open(['method' => 'delete', 'route' => ['offorder.destroy', $offorder->id], 'id' => 'deleteform']) !!}
                                    <a href="javascript:void(0)" class="btn btn-danger  btn-sm" title="Delete"
                                        onclick="event.preventDefault();if (!confirm('Are you sure?')) return; document.getElementById('deleteform').submit();">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                    {!! Form::close() !!}
                                    &nbsp;
                                    <a href="{{ url('offorder/' . $offorder->id . '/edit') }}" class="btn btn-info  btn-sm"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    &nbsp;
                                    <a href="{{ url('offorder/' . $offorder->id) }}" class="btn btn-info  btn-sm"
                                        title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
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
