@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">List of Discount Policy</h4>
            <div class="">
                <a class="btn btn-sm btn-info" href="{{ url('discounts/create') }}">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </a>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body mt-4">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="12" class="tablebtn text-end">
                            </th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Discount(%)</th>
                            <th>Discount(Fixed)</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->discount }}</td>
                                <td>{{ $item->fixed }}</td>
                                <td class="">
                                    <div class="skip d-flex justify-content-center">


                                        {!! Form::open(['method' => 'delete', 'route' => ['discounts.destroy', $item->id], 'class' => 'delete-form']) !!}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                           >
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                        {!! Form::close() !!}

                                        &nbsp;
                                        <a href="{{ url('discounts/' . $item->id . '/edit') }}" class="btn btn-info  btn-sm"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        &nbsp;
                                        {{-- <a href="{{ url('discounts/' . $item->id) }}" class="btn btn-info  btn-sm"
                                            title="View">
                                            <i class="fas fa-eye"></i>
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // JavaScript code to submit the form with SweetAlert
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If user confirms, submit the form
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
