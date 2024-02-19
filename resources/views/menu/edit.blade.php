@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">Update Menu</h4>
            <a href="{{ url('menus') }}" class="btn btn-info  btn-sm" title="Back to Class">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body">
            {!! Form::model($menu, [
                'method' => 'put',
                'enctype' => 'multipart/form-data',
                'class' => 'user',
                'route' => ['menus.update', $menu->id],
            ]) !!}
            {{-- @include('partial.flash')
            @include('partial.error') --}}

            <div class="form-group row">
                <div class="col-sm-3 mb-3">
                    <label for="category_id" class="control-label">Category Name</label>
                    {!! Form::select('category_id', $categories, null, [
                        'required',
                        'class' => 'form-control',
                        'id' => 'category_id',
                        'placeholder' => 'category_id',
                    ]) !!}

                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="subcategory_id" class="control-label">Subcategory Name</label>
                    {!! Form::select('subcategory_id', [], null, [
                       
                        'class' => 'form-control ',
                        'id' => 'subcategory_id',
                        'placeholder' => 'subcategory_id',
                    ]) !!}

                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="name" class="form-label">Name :</label>
                    {!! Form::text('name', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'name',
                        'placeholder' => 'Name',
                    ]) !!}
                </div>

                <div class="col-sm-3">
                    <label for="image" class="form-label">Input Image:</label>
                    {!! Form::file('image', ['class' => 'form-control', 'id' => 'image', 'title' => 'menu Picture']) !!}

                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="details" class="form-label">Details :</label>
                    {!! Form::text('details', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'details',
                        'placeholder' => 'Name',
                    ]) !!}
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="price" class="form-label">Price :</label>
                    {!! Form::number('price', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'price',
                        'placeholder' => 'price',
                    ]) !!}
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="quantity" class="form-label">Quantity :</label>
                    {!! Form::number('quantity', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'quantity',
                        'placeholder' => 'quantity',
                    ]) !!}
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="discount" class="form-label">Discount :</label>
                    {!! Form::number('discount', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'discount',
                        'placeholder' => 'discount',
                    ]) !!}
                </div>
            </div>
            <div class="form-group row">




            </div>


            <div class="form-group">
                {!! Form::submit('Update Class', ['class' => 'mt-3 btn btn-info btn-profile btn-block']) !!}
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