@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">Update Class</h4>
            <a href="{{ url('tab') }}" class="btn btn-info  btn-sm" title="Back to Class">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body">
            {!! Form::model($tab, [
                'method' => 'put',
                'enctype' => 'multipart/form-data',
                'class' => 'user',
                'route' => ['tab.update', $tab->id],
            ]) !!}
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
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="capacity" class="form-label">Capacity :</label>
                    {!! Form::text('name', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'capacity',
                        'placeholder' => 'capacity',
                    ]) !!}
                </div>
               
               
            </div>

            <div class="form-group">
                {!! Form::submit('Update Class', ['class' => 'mt-3 btn btn-info btn-profile btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
