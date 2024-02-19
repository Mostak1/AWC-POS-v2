@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info"> Add Card Informations</h4>
            <a href="{{ url('card') }}" class="btn btn-info  btn-sm" title="Back to Card Informations">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body mt-1">
            {{ Form::open(['route' => 'card.store', 'class' => 'user', 'enctype' => 'multipart/form-data']) }}

            {{-- @include('partial.flash')
            @include('partial.error') --}}

            <div class="form-group row g-4">
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
                    <label for="email" class="form-label">Email :</label>
                    {!! Form::text('email', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'email',
                        'placeholder' => 'Email',
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
                    <label for="card_status" class="control-label">Card Status :</label>
                    {!! Form::select('card_status', ['ACTIVE'=>'ACTIVE','SUSPEND'=>'SUSPEND', 'BLOCKED'=>'BLOCKED'], null, [
                        'required',
                        'class' => 'form-control',
                        'id' => 'card_status',
                        
                    ]) !!}
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="total_meal" class="control-label">Total Meal :</label>
                    {!! Form::number('total_meal', 12, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'total_meal',
                        'placeholder' => 'Total Meal According to Menu 12/15/20',
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
