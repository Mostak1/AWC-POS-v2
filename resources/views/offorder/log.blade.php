@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">List of Orders Log</h4>
            <div class="">
                
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
                            <th>Log ID</th>
                            <th>Order Id</th>
                            <th>User Name</th>
                            <th>Old Value</th>
                            <th>New Value</th>
                            <th>Process Sector</th>
                            <th>Process Time</th>
                           
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->off_order_id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->old }}</td>
                                <td>{{ $item->new }}</td>
                                <td>{{ $item->methode }}</td>
                                <td>{{ $item->created_at}}</td>
                                
                               
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
