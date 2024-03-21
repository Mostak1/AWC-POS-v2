@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">Update Customer Info</h4>
            <a href="{{ url('customer') }}" class="btn btn-info  btn-sm" title="Back to Customer">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body">

            {!! Form::model($customer, [
                'method' => 'put',
                'enctype' => 'multipart/form-data',
                'class' => 'user',
                'route' => ['customer.update', ['customer' => $customer->id]],
            ]) !!}
            <input type="text" name="user_id" hidden value="{{ $user->id }}">
            <div class="form-group row g-4">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="name" class="form-label">Name :</label>
                    {!! Form::text('name', $user->name, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'name',
                        'placeholder' => 'Name',
                    ]) !!}
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="email" class="form-label">Email :</label>
                    {!! Form::text('email', $user->email, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'email',
                        'placeholder' => 'Email',
                    ]) !!}
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="mobile" class="form-label">Mobile :</label>
                    {!! Form::text('mobile', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'mobile',
                        'placeholder' => 'Mobile Number',
                    ]) !!}
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="address" class="form-label">Address :</label>
                    {!! Form::text('address', null, [
                      
                        'class' => 'form-control form-control-profile',
                        'id' => 'address',
                        'placeholder' => 'Address',
                    ]) !!}
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="discount" class="control-label">Customer Group:</label>
                    {!! Form::select(
                        'discount',
                        [
                            0 => 'Customer',
                            30 => 'Staff',
                            10 => 'Special Customer',
                        ],
                        null,
                        [
                            'class' => 'form-control',
                            'id' => 'discount',
                        ],
                    ) !!}
                </div>
                {{-- <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="menu_id" class="control-label">Menu :</label>
                    {!! Form::select('menu_id', $menu, null, [
                        'required',
                        'class' => 'form-control',
                        'id' => 'menu_id',
                        'placeholder' => 'Menu',
                    ]) !!}
                </div> --}}
                {{-- <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="card_status" class="control-label">Sector:</label>
                    {!! Form::select(
                        'card_status',
                        [
                            1 => 'Customer',
                            2 => 'Staff',
                            3 => 'Pathao',
                            4 => 'Food Panda',
                            5 => 'Chairman Sir',
                            6 => 'IPD',
                        ],
                        null,
                        [
                            'class' => 'form-control',
                            'id' => 'card_status',
                        ],
                    ) !!}
                </div> --}}
                {{-- <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="total_meal" class="control-label">Total Meal :</label>
                    {!! Form::number('total_meal', 12, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'total_meal',
                        'placeholder' => 'Total Meal According to Menu 12/15/20',
                    ]) !!}
                </div> --}}
            </div>

        </div>
        <div class="form-group p-4">
            {!! Form::submit('Update Customer Info', ['class' => 'mt-3 btn btn-info btn-profile btn-block']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
