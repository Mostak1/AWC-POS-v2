
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Insert A New Customer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ Form::open(['route' => 'customer.store', 'class' => 'user', 'enctype' => 'multipart/form-data', 'id' => 'customerForm']) }}
                <div class="form-group row g-4">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label for="name" class="form-label position-relative">Name<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-danger">*
                          </span> :</label>
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
                            'class' => 'form-control form-control-profile',
                            'id' => 'email',
                            'placeholder' => 'name@domain.com',
                        ]) !!}
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label for="mobile" class="form-label position-relative">Mobile
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-danger">
                                *
                              </span>
                            :</label>
                        {!! Form::text('mobile', null, [
                            'required',
                            'class' => 'form-control form-control-profile',
                            'id' => 'mobile',
                            'placeholder' => '01XXXXXXXXX (11Digit only)',
                        ]) !!}
                    </div>

                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label for="discount" class="control-label">Customer Group:</label>
                        {!! Form::select(
                            'discount',
                            [
                                0 => 'Customer',
                                30 => 'Staff',
                                10=> 'Special Customer',
                                
                            ],
                            null,
                            [
                                'class' => 'form-control',
                                'id' => 'discount',
                            ],
                        ) !!}
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label for="place" class="control-label">Select Place:</label>
                        {!! Form::select('place', ['' => 'Select Place'] + $places->toArray(), null, [
                            'class' => 'form-control',
                            'id' => 'place',
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
                   
                </div>

                <div class="form-group mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {!! Form::submit('Add Customer Information', ['class' => 'my-3 btn btn-info', 'id' => 'customerSubmitBtn']) !!}

                </div>
                {!! Form::close() !!}
            </div>
            
        </div>
    </div>
</div>
