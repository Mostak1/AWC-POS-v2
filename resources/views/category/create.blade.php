@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info"> Add Class</h4>
            <a href="{{ url('category') }}" class="btn btn-info  btn-sm" title="Back to Class List">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body mt-1">
            {{ Form::open(['route' => 'category.store', 'class' => 'user', 'enctype' => 'multipart/form-data']) }}

            {{-- @include('partial.flash')
            @include('partial.error') --}}

            <div class="form-group row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="name" class="form-label">Name :</label>
                    {!! Form::text('name', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'name',
                        'placeholder' => 'Name',
                    ]) !!}
                </div>
               
                <div class="col-sm-4">
                    <label for="image" class="form-label">Input Image:</label>
                        {!! Form::file('image', ['class' => 'form-control', 'id' => 'image', 'title' => 'Category Picture']) !!}
                    
                </div>
            </div>

           

            <div class="form-group">
                {!! Form::submit('Add Category', ['class' => 'my-3 btn btn-info']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
