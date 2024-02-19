@extends('layouts.main')


@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">Update Sub-Category</h4>
            <a href="{{ url('subcategory') }}" class="btn btn-info  btn-sm" title="Back to Subject">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body">
            {!! Form::model($subcategory, [
                'method' => 'put',
                'enctype' => 'multipart/form-data',
                'class' => 'user',
                'route' => ['subcategory.update', $subcategory->id],
            ]) !!}


            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    {!! Form::text('name', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'name',
                        'placeholder' => 'Name',
                    ]) !!}
                </div>
              
            </div>
           

            <div class="form-group my-2">
                {!! Form::submit('Update Sub-Category', ['class' => 'btn btn-info btn-profile btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
