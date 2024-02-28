@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3">
            <div class="m-0 fs-2 font-weight-bold text-info">Order Details According To Order</div>
            <div class="text-center">Order ID:{{$offorder->id}}, Total: {{$offorder->total}}, Discount: {{$offorder->discount}} </div>
        </div>
    </div>
    <!-- Card Body -->
    <div class="card p-5 shadow">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th colspan="8" class="tablebtn text-end">
                        </th>
                    </tr>
                    <tr>
                        
                        <th>Name</th>
                        <th>Image</th>
                        <th>Details</th>
                        <th>Quantity</th>
                        <th>Product Price</th>
                        <th>Sealing Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $item)
                        <tr>
                           
                            <td>{{ $item->menu->name }}</td>
                            <td> <img class="" height="50px"
                                    src="{{ asset('storage/menu') }}/{{ $item->menu->image }}"
                                    alt="{{ $item->menu->image }}" /></td>
                            <td>{{ $item->menu->details }}</td>
                            <td>{{ $item->quantity}}</td>
                            <td>{{ $item->menu->price }}</td>
                            <td>{{ $item->total / $item->quantity }}</td>
                            <td>{{ $item->total }}</td>

                            <td class="">
                                <div class="skip d-flex justify-content-center">


                                    {{-- onclick="event.preventDefault(); document.getElementById('submit-form').submit();" --}}
                                    {!! Form::open(['method' => 'delete', 'route' => ['offorderdetails.destroy', $item->id], 'id' => 'deleteform']) !!}
                                    <a href="javascript:void(0)" class="btn btn-danger  btn-sm" title="Delete"
                                        onclick="event.preventDefault();if (!confirm('Are you sure?')) return; document.getElementById('deleteform').submit();">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                    {!! Form::close() !!}
                                    &nbsp;
                                    <a href="{{ url('offorderdetails/' . $item->id . '/edit') }}"
                                        class="btn btn-info  btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    &nbsp;
                                    <a href="{{ url('offorderdetails/' . $item->id) }}" class="btn btn-info  btn-sm"
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
@endsection

@section('script')
    <script></script>
@endsection
