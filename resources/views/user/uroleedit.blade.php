@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info"> Add User Role</h4>
            <a href="{{ url('role') }}" class="btn btn-info  btn-sm" title="Back to Class List">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body mt-1">
            {!! Form::model($userrole, [
                'method' => 'put',
                'enctype' => 'multipart/form-data',
                'class' => 'user',
                'route' => ['urole.update', $userrole->id],
            ]) !!}
            {{-- @include('partial.flash')
            @include('partial.error') --}}

            <div class="form-group row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="role_name" class="form-label">Role Name :</label>
                 
                    {!! Form::select('role_id', $role, null, [
                        'placeholder' => 'Select Class',
                        'id' => 'role_id',
                        'class' => 'form-control w-full',
                    ]) !!}
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="is_active" class="form-label">User Name :</label>
                 
                     {!! Form::select('user_id', $user, null, [
                        'placeholder' => 'Select Class',
                        'id' => 'user_id',
                        'class' => 'form-control w-full',
                    ]) !!}
                </div>
               
               
            </div>

           

            <div class="form-group mt-2">
                {!! Form::submit('User Role Update', ['class' => 'my-3 btn btn-info']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
