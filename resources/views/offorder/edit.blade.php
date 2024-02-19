@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">Update Order</h4>
            <a href="{{ url('offorder') }}" class="btn btn-info  btn-sm" title="Back to Class">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body">
            {!! Form::model($offorder, [
                'method' => 'put',
                'enctype' => 'multipart/form-data',
                'class' => 'Order',
                'route' => ['offorder.update', $offorder->id],
            ]) !!}
           
          
            
            <div class="form-group row">
                  <div class="col-sm-4">
                <label for="tab_id" class="form-label">Table Name:</label>
                {!! Form::select('tab_id',$tabs,null, [
                    'required',
                    'class' => 'form-control form-control-profile',
                    'id' => 'tab_id',
                ]) !!}
            </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="total" class="form-label">Total :</label>
                    {!! Form::number('total', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'total',
                    ]) !!}
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="discount" class="form-label">Discount :</label>
                    {!! Form::number('discount', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'discount',
                    ]) !!}
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="reason" class="form-label">Reason :</label>
                    {!! Form::text('reason', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'reason',
                    ]) !!}
                </div>
                
               
            </div>
            <div class="form-group">
                {!! Form::submit('Update Orders', ['class' => 'mt-3 btn btn-info btn-profile btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
