@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">Add Subject</h4>
            <a href="{{ url('supplier') }}" class="btn btn-info  btn-sm" title="Back to Subject List">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body">
            {{ Form::open(['route' => 'supplier.store', 'class' => 'user', 'enctype' => 'multipart/form-data']) }}
            {{-- @include('supplier.form') --}}


            <div class="form-group row">
              
                <div class="col-sm-3 mb-2">
                    {!! Form::text('name', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'name',
                        'placeholder' => 'Name',
                    ]) !!}
                </div>
                <div class="col-sm-3 mb-2">
                    {!! Form::email('email', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'email',
                        'placeholder' => 'Email Address',
                    ]) !!}
                </div>
                <div class="col-sm-3 mb-2">
                    {!! Form::text('mobile', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'mobile',
                        'placeholder' => 'Mobile Number',
                    ]) !!}
                </div>
                <div class="col-sm-3 mb-2">
                    {!! Form::text('address', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'address',
                        'placeholder' => 'Address',
                    ]) !!}
                </div>
                <div class="col-sm-3 mb-2" >
                    {!! Form::text('web', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'web',
                        'placeholder' => 'Web Address',
                    ]) !!}
                </div>
            </div>



            <div class="form-group">
                {!! Form::submit('Add Supplier', ['class' => 'btn btn-info btn-profile btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
