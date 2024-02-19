@extends('layouts.main')
@section('css')
    <style>
        @media print {

            table,
            .ptext {
                font-size: 10pt;
                margin-bottom: 1px;
            }

            th,
            td {
                padding: 0px;
                height: 4px;

            }



            @page {
                margin: 0.2in;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container">


        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">Order Report Table</h4>
            <div class="m-0 font-weight-bold btn btn-outline-info" id="submitp"><i class="fa-solid fa-print"></i></div>

        </div>
        <div class="card p-4 d-print-block">

            <div class="row fs-6" id="printTable">
                <div class="col-12">
                    <div class="table-responsive">
                        <div class="text-center fs-5">Green-Kitchen Daily Report</div>

                        <div class="text-center fs-5">Staff </div>

                        <table class="table table-bordered" id="stafforderdetails" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Menu Name</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>

                                    <!-- Add more table headers based on your new filters -->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-end" colspan="4">Total Staff Sale</th>
                                    <th> {{ $staffSale }} Tk</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($staffData as $item)
                                    <tr>
                                        <td>{{ $item['menuName'] }}</td>
                                        <td>{{ $item['category'] }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>{{ $item['price'] }}</td>
                                        <td>{{ $item['total'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="stafftotal">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="table-responsive" id="">
                        <div class="text-center fs-5">Customer</div>
                        <div class="text-center fs-3" id="filterHead"></div>
                        <table class="table table-bordered" id="customerdata" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Menu Name</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-end" colspan="4">Total Customer Sale</th>
                                    <th> {{ $customerSale }} tk</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($customerData as $item)
                                    <tr>
                                        <td>{{ $item['menuName'] }}</td>
                                        <td>{{ $item['category'] }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>{{ $item['price'] }}</td>
                                        <td>{{ $item['total'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="customertotal">

                        </div>
                    </div>
                </div>
                <div class="py-1 ptext d-flex flex-row align-items-center justify-content-between">
                    <span class="m-0 font-weight-bold ">Date: {{ $selectedDate }}
                    </span>
                    <span>
                        Total Order: {{ $orderCountD }}
                    </span>
                    <span>
                        Total Sale: {{ $totalSalesD }}TK ; Cash: {{ $cash }}TK; Bkash:
                        {{ $bkash }}TK; Card: {{ $card }}TK
                    </span>
                </div>
            </div>


        </div>
    </div>
@endsection

@section('script')
    <script>
        // Printn
        $('#submitp').click(function() {
            var printContents = $('#printTable').html();

            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;


            // $("#orders").empty();
            location.reload();
        });
    </script>
@endsection
