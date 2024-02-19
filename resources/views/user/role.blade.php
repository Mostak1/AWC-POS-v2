@extends('layouts.main')
@section('content')
   <div class="">
    <div class="row">
        <div class="col-md-4">
            <div class="card p-2">
                <div >
                    <div class="text-center fs-3">Role</div>
                    <a class="btn btn-outline-info my-1" href="{{ url('role/create') }}"> <i class="fa-solid fa-plus"></i>Add Role</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            {{-- <tr>
                                <th colspan="5" class="tablebtn">
                                </th>
                            </tr> --}}
                            <tr>
                                <th>Role</th>
                                <th>Name</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($roles as $tab)
                                <tr>
                                    <td>{{ $tab->id }}</td>
                                    <td>{{ $tab->role_name }}</td>
                                    <td>{{ $tab->is_active }}</td>
                                    
                                    
                                    <td class="skip d-flex justify-content-center">
                                        {!! Form::open(['method' => 'delete', 'route' => ['role.destroy', $tab->id], 'id' => 'deleteform']) !!}
                                        <a href="javascript:void(0)" class="btn btn-danger  btn-sm" title="Delete"
                                            onclick="event.preventDefault();if (!confirm('Are you sure?')) return; document.getElementById('deleteform').submit();">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                        {!! Form::close() !!}
                                        &nbsp;
                                        <a href="{{ url('role/' . $tab->id . '/edit') }}" class="btn btn-info  btn-sm"
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
        <div class="col-md-8">
            <div class="card p-2">
                <div >
                    <div class="text-center fs-3">Role User</div>
                    <a class="btn btn-outline-info my-1" href="{{ url('urole/create') }}"> <i class="fa-solid fa-plus"></i>Add Role</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" id="" width="100%" cellspacing="0">
                        <thead>
                            {{-- <tr>
                                <th colspan="5" class="tablebtn">
                                </th>
                            </tr> --}}
                            <tr>
                                <th>ID</th>
                                <th>Role Name</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($items as $tab)
                                <tr>
                                    <td>{{ $tab->id }}</td>
                                    <td>{{ $tab->role->role_name }}</td>
                                    <td>{{ $tab->user->name }}</td>
                                    
                                    
                                    <td class="skip d-flex justify-content-center">
                                        {!! Form::open(['method' => 'delete', 'route' => ['urole.destroy', $tab->id], 'id' => 'deleteform']) !!}
                                        <a href="javascript:void(0)" class="btn btn-danger  btn-sm" title="Delete"
                                            onclick="event.preventDefault();if (!confirm('Are you sure?')) return; document.getElementById('deleteform').submit();">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                        {!! Form::close() !!}
                                        &nbsp;
                                        <a href="{{ url('urole/'.$tab->id.'/edit') }}" class="btn btn-info  btn-sm"
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
    </div>
   </div>
@endsection

@section('script')
@endsection
