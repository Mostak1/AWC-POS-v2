@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info"> Add Card Informations</h4>
            <a href="{{ url('cardp') }}" class="btn btn-info  btn-sm" title="Back to Card Informations">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body mt-1">
            {{ Form::open(['route' => 'cardp.store', 'class' => 'user', 'enctype' => 'multipart/form-data']) }}

            {{-- @include('partial.flash')
            @include('partial.error') --}}

            <div class="form-group row g-4">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="customer_prepaid_card_id" class="control-label">Card Holder</label>
                    {!! Form::select('customer_prepaid_card_id', $subscriber, null, [
                        'required',
                        'class' => 'form-control',
                        'id' => 'customer_prepaid_card_id',
                    ]) !!}
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="menu_id" class="control-label">Menu :</label>
                    {!! Form::select('menu_id', $menu, null, [
                        'required',
                        'class' => 'form-control',
                        'id' => 'menu_id',
                        'placeholder' => 'Menu',
                    ]) !!}
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="total_meal" class="control-label">Total Meal :</label>
                    {!! Form::number('total_meal', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'total_meal',
                        'placeholder' => 'Total Meal',
                    ]) !!}
                </div>


            </div>



            <div class="form-group mt-3">
                {!! Form::submit('Add card Information', ['class' => 'my-3 btn btn-info']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
