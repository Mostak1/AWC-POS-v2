@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info"> Edit Role</h4>
            <a href="{{ url('role') }}" class="btn btn-info  btn-sm" title="Back to Class List">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body mt-1">
            {!! Form::model($role, [
                'method' => 'put',
                'enctype' => 'multipart/form-data',
                'class' => 'user',
                'route' => ['role.update', $role->id],
            ]) !!}
            {{-- @include('partial.flash')
            @include('partial.error') --}}

            <div class="form-group row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="role_name" class="form-label">Role Name :</label>
                    {!! Form::text('role_name', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'role_name',
                        'placeholder' => 'Role Name',
                    ]) !!}
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="is_active" class="form-label">Capacity :</label>
                    {!! Form::number('is_active', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'is_active',
                        'placeholder' => '1/0',
                    ]) !!}
                </div>
               
               
            </div>

           

            <div class="form-group mt-2">
                {!! Form::submit('Role Create', ['class' => 'my-3 btn btn-info']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
