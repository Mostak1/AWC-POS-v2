@extends('layouts.main')
@section('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap');

        @media print {

            table,
            .ptext,
            .r-text {
                font-size: 8pt;
                margin-bottom: 1px;
                font-weight: 900;
                font-family: "Oswald", sans-serif;
                font-optical-sizing: auto;
                font-style: normal;
            
            }

            th,
            td {
                padding: 0px;
                height: 4px;

            }

            @page {
                margin: .4cm;
            }
        }
    </style>
@endsection
@section('content')
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-info">Order Report Table</h4>
        <div class="m-0 font-weight-bold btn btn-outline-info" id="submitp"><i class="fa-solid fa-print"></i></div>

    </div>

    <div id="print" class="card p-2">
        <div class=" d-print-block">
            <div class="fs-4 text-center r-heading">GREEN KITCHEN</div>
            <div class="r-text  text-center">Islam Tower,2nd Floor,102 Shukrabad,Dhanmondi-32,Dhaka-1207 <br>
                Phone#
                01979756069
            </div>

            <div class="d-flex justify-content-between my-2">
                <div class="r-text ">
                    Date: @php
                        $currentDateTime = date('Y-m-d');
                        echo $currentDateTime;
                    @endphp

                </div>

                <div class="r-text ">
                    Time: @php
                        $currentTime = date('h:i A');
                        echo $currentTime;
                    @endphp

                </div>


            </div>
            <div class="d-flex justify-content-between my-2">
                <div class="fs-4 font-weight-bold">Paid</div>
                <div class="r-text">Invoice ID: 000{{ $invoice }}
                </div>
            </div>
        </div>
        <div class="row row-cols-1 r-text  d-print-block">
            <div class="col">Payment Methode: {{ $payMethod }}</div>
            <div class="col"> <span id="transactionId1"></span></div>
        </div>


        <div id="invoiceStaff" class="text-center text-danger fs-4 my-2">

        </div>


        <div class="row r-text mb-2">
            <div class="col-3">
                Item
            </div>
            <div class="col-2">
                Qty
            </div>
            <div class="col-3">
                Price
            </div>
            <div class="col-2">
                Total
            </div>
        </div>


        <div class="orders r-text" id="orders">
            @if ($active == 1)
                @foreach ($staffData as $item)
                    <div class="row r-text mb-2">
                        <div class="col-3">
                            {{ $item['menuName'] }}
                        </div>
                        <div class="col-2">
                            {{ $item['quantity'] }}
                        </div>
                        <div class="col-3">

                            <div class="">
                                {{ $item['price'] }}Tk
                            </div>
                        </div>
                        <div class="col-2">
                            {{ $item['total'] }}
                        </div>
                    </div>
                @endforeach
            @else
                @foreach ($staffData as $item)
                    <div class="row r-text mb-2">
                        <div class="col-3">
                            {{ $item['menuName'] }}
                        </div>
                        <div class="col-2">
                            {{ $item['quantity'] }}
                        </div>
                        <div class="col-3">

                            <div class="text-decoration-line-through">
                                {{ $item['price'] }}Tk
                            </div>
                            @if ($item['cprice'] !== 0)
                                {{ $item['cprice'] }}Tk
                            @else
                                {{ $item['sprice'] }}Tk
                            @endif

                        </div>
                        <div class="col-2">
                            {{ $item['total'] }}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>



        {{-- <div class="mt-4">
            <span>GROSS Total: </span>
            <span id="total-order"></span>
            <span>TK</span>
        </div>


        <div class="form-row my-2">
            <div class="form-group col-md-6 col-sm-6">
                <label for="staffs">Staff Name</label>
                <select name="staffs" id="staffs" class="form-control select2">
                    <option value="0">Customer</option>
                     @foreach ($staffs as $staff)
                        <option value="{{ $staff->id }}" data-sname="{{ $staff->name }}-{{ $staff->employeeId }}">
                            {{ $staff->name }} -
                            {{ $staff->employeeId }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div> --}}


        {{-- <div class="">
            <span>Special Discount: </span>
            <span id="discount">0</span>
            <span>TK</span>
        </div> --}}
        <div class="r-text">
            <span>GROSS Total: {{ $total }} </span>
            <span id="total-order2"></span>
            <span>TK</span>
        </div>
        <div class="r-text">
            @if ($total > $total - $discount)
                <div class="div">20% Discount Applied</div>
            @endif
            <span>Ammount to Pay: {{ $total - $discount }} </span>
            <span id="total-order2"></span>
            <span>TK</span>
        </div>

        <div class="aw-ul r-text text-center">----------------</div>
        <div class="r-text d-print-block text-center">
            THANK YOU, COME AGAIN <br> Print By:
            @if (Auth::Check())
                {{ Auth::user()->name }}
            @endif

        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#submitp').click(function() {
            var printContents = $('#print').html();
            $(".order-q").removeClass("");
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        });
    </script>
@endsection
