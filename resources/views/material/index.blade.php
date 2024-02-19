@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">material List</h4>
            <div class="">
                <a class="btn btn-sm btn-info" href="{{ url('material/create') }}">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </a>
            </div>
        </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="6" class="tablebtn text-end">
                        </th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                         
                            
                            <td class="skip d-flex justify-content-center">
                                {{-- onclick="event.preventDefault(); document.getElementById('submit-form').submit();" --}}
                                {!! Form::open(['method' => 'delete', 'route' => ['material.destroy', $item->id], 'id' => 'deleteform']) !!}
                                <a href="javascript:void(0)" class="btn btn-danger  btn-sm" title="Delete"
                                    onclick="event.preventDefault();if (!confirm('Are you sure?')) return; document.getElementById('deleteform').submit();">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                                {!! Form::close() !!}
                                &nbsp;
                                <a href="{{ url('material/' . $item->id . '/edit') }}"
                                    class="btn btn-info  btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                &nbsp;
                                <a href="{{ url('material/' . $item->id) }}" class="btn btn-info  btn-sm"
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
@endsection

@section('script')
    <script>
      
    </script>
@endsection
