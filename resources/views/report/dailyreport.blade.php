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
                                    <th class="text-start">Total Sale {{ $staffSale }} tk</th>
                                    <th class="text-end" colspan="2">Total Discount {{ $staffDis }} tk</th>
                                    <th class="text-end" colspan="2">Net Sale {{ $staffSale - $staffDis }} tk</th>
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
                                    <th class="text-start">Total Sale {{ $customerSale }} tk</th>
                                    <th class="text-end" colspan="2">Total Discount {{ $customerDis }} tk</th>
                                    <th class="text-end" colspan="2">Net Sale {{ $customerSale - $customerDis }} tk</th>
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
                <div class="col-12">
                    <div class="table-responsive" id="">
                        <div class="text-center fs-5">Pathao</div>
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
                                    <th class="text-start">Total Sale {{ $pathaoSale }} tk</th>
                                    <th class="text-end" colspan="2">Total Discount {{ $pathaoDis }} tk</th>
                                    <th class="text-end" colspan="2">Net Sale {{ $pathaoSale - $pathaoDis }} tk</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($pathao as $item)
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
                <div class="col-12">
                    <div class="table-responsive" id="">
                        <div class="text-center fs-5">Food Panda</div>
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
                                    <th class="text-start">Total Sale {{ $foodPandaSale }} tk</th>
                                    <th class="text-end" colspan="2">Total Discount {{ $foodPandaDis }} tk</th>
                                    <th class="text-end" colspan="2">Net Sale {{ $foodPandaSale - $foodPandaDis }} tk
                                    </th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($foodPanda as $item)
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
                <div class="col-12">
                    <div class="table-responsive" id="">
                        <div class="text-center fs-5">IPD</div>
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
                                    <th class="text-start">Total Sale {{ $ipdSale }} tk</th>
                                    <th class="text-end" colspan="2">Total Discount {{ $ipdDis }} tk</th>
                                    <th class="text-end" colspan="2">Net Sale {{ $ipdSale - $ipdDis }} tk</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($ipd as $item)
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
                <div class="col-12">
                    <div class="table-responsive" id="">
                        <div class="text-center fs-5">Chairman Sir</div>
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
                                    <th class="text-start">Total Sale {{ $chairmanSale }} tk</th>
                                    <th class="text-end" colspan="2">Total Discount {{ $chairmanDis }} tk</th>
                                    <th class="text-end" colspan="2">Net Sale {{ $chairmanSale - $chairmanDis }} tk
                                    </th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($chairman as $item)
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
                <div class="pt-2 ptext d-flex flex-row align-items-center justify-content-between">
                    <div class="m-0 font-weight-bold ">
                        <span class="me-2">
                            Date: {{ $selectedDate }}
                        </span>
                        <span class="me-2">
                            Total Order: {{ $orderCountD }}
                        </span>
                    </div>
                    <div>
                        Total Sale: {{ $totalSalesD }}TK ;
                    </div>
                    <div>
                        Total Discount: {{ $totalDisD }}TK ;
                    </div>
                    <div>
                        Net Sale: {{ $totalSalesD-$totalDisD }}TK ;
                    </div>
                    

                </div>
                <div class="py-2 ptext d-flex flex-row align-items-center justify-content-between">
                        <div class=" bold">Cash on Hand: {{ $totalSalesD+$pathaoDis+$foodPandaDis-$totalDisD-$foodPandaSale-$pathaoSale-$ipdSale-$bkash-$card }}TK;</div>
                        <div class="">Bkash:{{ $bkash }}TK;</div>
                        <div class=""> Card: {{ $card }}TK</div>
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
