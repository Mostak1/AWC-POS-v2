@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info"> Add Discount Policy</h4>
            <a href="{{ url('discounts') }}" class="btn btn-info  btn-sm" title="Back to Card Informations">
                <i class="fas fa-arrow-left"></i>
            </a>
           
        </div>
        <div class="card-body mt-1">
            {{ Form::open(['route' => 'discounts.store', 'class' => 'user', 'enctype' => 'multipart/form-data']) }}

            {{-- @include('partial.flash')
            @include('partial.error') --}}

            <div class="form-group row g-4">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="name" class="form-label">Policy Name :</label>
                    {!! Form::text('name', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'name',
                        'placeholder' => 'Name',
                    ]) !!}
                </div>
               
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="discount" class="form-label">Discount In Percentage:</label>
                    {!! Form::number('discount', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'discount',
                        'placeholder' => '20/10/5',
                    ]) !!}
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="fixed" class="form-label">Discount In Fixed:</label>
                    {!! Form::number('fixed', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'fixed',
                        'placeholder' => '50/100/200',
                    ]) !!}
                </div>
                
                
            </div>

            <div class="form-group mt-3">
                {!! Form::submit('Add discounts Information', ['class' => 'my-3 btn btn-info']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
