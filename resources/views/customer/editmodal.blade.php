<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel1">Update Customer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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

                    </div>

                </div>
                <div class="form-group p-4">
                    {!! Form::submit('Update Customer Info', ['class' => 'mt-3 btn btn-info btn-profile btn-block']) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
