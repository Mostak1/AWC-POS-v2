@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">List of Classes</h4>
            <div class="">
                <a class="btn btn-sm btn-info" href="{{ url('category/create') }}">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </a>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body mt-4">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                       
                        <tr>
                          
                            <th>Name</th>
                            <th>Address</th>
                            <th>Logo</th>
                            <th>Mobile</th>
                            <th>Phone</th>
                            <th>Website</th>
                            <th>Tax</th>
                            <th>Discount</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                               
                                <td>{{ $item->c_name }}</td>
                                <td>{{ $item->address }}</td>
                                <td> <img class="" height="50px" src="{{asset(config('app.logo_path'))}}" alt="logo" /></td>
                                <td>{{ $item->mobile }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->website }}</td>
                                <td>{{ $item->tax }}</td>
                                <td>{{ $item->discount }}</td>
                                
                                <td class="">
                                  
                                    &nbsp;
                                    <a href="{{ url('setting/' . $item->id . '/edit') }}" class="btn btn-info  btn-sm"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    &nbsp;
                                   
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
