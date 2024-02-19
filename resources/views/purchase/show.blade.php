@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">Purchases Details List</h4>
            <div class="">
                <a class="btn btn-sm btn-info" href="{{ url('purchase/create') }}">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </a>
            </div>
        </div>
    </div>
    <!-- Card Body -->
    <div class="card p-2">
        <div id="print">
            <div class="fs-3 text-center r-heading">Green Kitchen Purchase Details</div>
            <div class="r-text text-center">Islam Tower,Dhanmondi-32(Sukrabad), Mirpur Road,Dhaka-1207 <br>
                Mobile No:
                09666747470
            </div>
            <div class="d-flex justify-content-between my-2">
                <div class="">
                    @foreach ($item_p as $item)
                        <span>Supplier Name: </span>
                        <span>{{ $item->supplier->name }}</span><br>
                        <span>Supplier Email: </span>
                        <span>{{ $item->supplier->email }}</span><br>
                        <span>Supplier Mobile: </span>
                        <span>{{ $item->supplier->mobile }}</span><br>
                        <span>Total Cost: </span>
                        <span>{{ $item->total }}</span><br>
                        <span>Purchased By: </span>
                        <span>{{ $item->user->name }}</span><br>
                    @endforeach
                </div>
                <div class="r-text ">
                    Date: @php
                        $currentDateTime = date('Y-m-d H:i:s');
                        echo $currentDateTime;
                    @endphp <br>
                    <div id="submitp" class="d-print-none fs-3">

                        <i class="fa-solid fa-print fa-beat-fade"></i>
                    </div>

                </div>

            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                        {{-- <tr>
                        <th colspan="7" class="tablebtn"> dataTable
                        </th> --}}
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Material Name</th>
                            <th>Material Unit</th>
                            <th>Quantity</th>
                            <th>Material Unit Price</th>
                            <th>Purchase Amount</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Material Name</th>
                            <th>Material Unit</th>
                            <th>Quantity</th>
                            <th>Material Unit Price</th>
                            <th>Purchase Amount</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>

                                <td>{{ $item->material->name }}</td>
                                <td>{{ $item->material->unit }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->material->price }}</td>
                                <td>{{ $item->material->price * $item->quantity }}</td>

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
        $(document).ready(function(){
            $('#submitp').click(function() {
                var printContents = $('#print').html();
                // $(".order-q").removeClass("d-none");
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            });
        });
    </script>
@endsection
