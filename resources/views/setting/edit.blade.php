@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">Update Setting</h4>
            <a href="{{ url('setting') }}" class="btn btn-info  btn-sm" title="Back to Class">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body">
            {!! Form::model($setting, [
                'method' => 'put',
                'enctype' => 'multipart/form-data',
                'class' => 'user',
                'route' => ['setting.update', $setting->id],
            ]) !!}
            {{-- @include('partial.flash')
            @include('partial.error') --}}

            <div class="form-group row">
                
               
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="c_name" class="form-label">Company Name :</label>
                    {!! Form::text('c_name', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'c_name',
                        'placeholder' => 'Company Name',
                    ]) !!}
                </div>

               
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="address" class="form-label">Address :</label>
                    {!! Form::text('address', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'address',
                        'placeholder' => 'Address',
                    ]) !!}
                </div>
                <div class="col-sm-3">
                    <label for="image" class="form-label">Input Logo:</label>
                    {!! Form::file('image', ['class' => 'form-control', 'id' => 'image', 'title' => 'menu Picture']) !!}

                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="mobile" class="form-label">Mobile :</label>
                    {!! Form::text('mobile', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'mobile',
                        'placeholder' => 'Mobile',
                    ]) !!}
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="phone" class="form-label">Phone :</label>
                    {!! Form::text('phone', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'phone',
                        'placeholder' => 'Phone',
                    ]) !!}
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="website" class="form-label">Website :</label>
                    {!! Form::text('website', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'website',
                        'placeholder' => 'Website',
                    ]) !!}
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="tax" class="form-label">Tax :</label>
                    {!! Form::number('tax', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'tax',
                        'placeholder' => 'Tax',
                    ]) !!}
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="discount" class="form-label">Discount :</label>
                    {!! Form::number('discount', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'discount',
                        'placeholder' => 'Discount',
                    ]) !!}
                </div>
               
            </div>
            <div class="form-group row">




            </div>


            <div class="form-group">
                {!! Form::submit('Update Setting', ['class' => 'mt-3 btn btn-info btn-profile btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('script')
    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="X-CSRF-TOKEN"]').attr('content')
            }
        });
    </script>
@endsection