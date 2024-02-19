@extends('layouts.main')

@section('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oranienbaum&family=Share+Tech+Mono&display=swap');
        @media print {
            * {
                font-family: 'Oranienbaum', serif;
                /* font-family: 'Share Tech Mono', monospace; */
            }

            .pnone {
                display: none;
            }

            .r-text {
                font-size: 13px;
            }

            @page {

                margin: .06cm;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container my-5">
        <div class="card">
            <div class="row m-3">
                <div class="col-md-6">
                    <div id="print">


                        <div class="fs-3 text-center r-heading">Green Kitchen Purchases Items</div>
                        <div class="r-text text-center">Islam Tower,Dhanmondi-32(Sukrabad), Mirpur Road,Dhaka-1207 <br>
                            Mobile No:
                            09666747470
                        </div>
                        <div class="d-flex justify-content-between my-2">
                            <div class="r-text ">
                                Date: @php
                                    $currentDateTime = date('Y-m-d H:i:s');
                                    echo $currentDateTime;
                                @endphp

                            </div>

                            <div class="r-text">Invoice ID: 000{{ $lastOrderId + 1 }}</div>
                        </div>
                        <ol>
                            <div class="row r-text">
                                <div class="col-3">
                                    Item Name
                                </div>
                                <div class="col-3">
                                    Quantity
                                </div>
                                <div class="col-3">
                                    Price
                                </div>
                            </div>

                            <div class="orders r-text" id="orders">

                            </div>

                        </ol>
                        <div class="row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                {!! Form::select('supplier_id', $supplier, null, [
                                    'placeholder' => 'Select Supplier',
                                    'id' => 'supplier_id',
                                    'class' => 'form-control w-full',
                                ]) !!}
                            </div>
                        </div>
                        <div class="mt-4">
                            <span>Total Bill: </span>
                            <span id="total-order"></span>
                            <span>TK</span>
                        </div>
                        <div>
                            {{-- <div class="input-group mb-3 w-25">
                                <span class="input-group-text" id="basic-addon1">Tax</span>
                                <input type="text" class="form-control" id="tax" aria-label="Username"
                                    aria-describedby="basic-addon1">
                            </div> --}}
                            {{-- <span>Tax: </span>
                            {{-- <span id="tax">50</span> 
                            <span>TK</span> --}}
                        </div>

                        {{-- <div>
                            <span>Ammount to Pay: </span>
                            <span id="total-order2"></span>
                            <span>TK</span>
                        </div> --}}
                        <div class="text-center d-none d-print-block">

                        </div>
                        <button class="btn btn-outline-danger pnone mt-5" id="submitp">Input Purchases</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($items as $menu)
                                    <tr>
                                        <td>{{ $menu->id }}</td>
                                        <td>{{ $menu->name }}</td>
                                        <td>{{ $menu->unit }}</td>
                                        <td>{{ $menu->quantity }}</td>
                                        <td>{{ $menu->price }}</td>

                                        <td class="text-danger">
                                            <button class="btn btn-outline-danger select">Select</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="X-CSRF-TOKEN"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('.select').click(function() {
                var id = $(this).closest('tr').find('td:first').text();
                var name = $(this).closest('tr').find('td:nth-child(2)').text();
                var price = $(this).closest('tr').find('td:nth-child(5)').text();

                // Check if an item with the same id already exists
                var existingItem = $('#orders').find(`.order-item[data-id="${id}"]`);

                if (existingItem.length > 0) {
                    var quantity = parseInt(existingItem.find('.quantity').val());
                    quantity++;
                    existingItem.find('.quantity').val(quantity);
                    var total = (parseFloat(price) * quantity).toFixed(2);
                    existingItem.find('.total').text(total);
                } else {
                    var orderItem = `
                <li class="order-item mb-2" data-id="${id}">
                    <div class="row">
                                        <div class="col-3">
                                            <div class="order-info d-inline">
                                                <span class="order-name">${name}</span>
                                                <span class="order-price d-none">${price}</span>
                                                </div>
                                                </div>
                                                <div class="col-3">
                                                    <input type="number" class="quantity pnone" style="width:50px"  value="1" min="1">
                                                    <span class="order-q"></span>
                       
                                        </div>
                                        <div class="col-3">
                                            <span class="total">${price}</span>
                                            <span >TK</span>
                                        </div>
                                        <div class="col-3">
                                            <button class="pnone btn btn-outline-danger remove-item">Remove</button>
                                        </div>
                    </div>
                    
                   
                </li>
            `;

                    $('#orders').append(orderItem);
                }

                updateSubtotal();
                payAmount();
            });

            $(document).on('input', '.quantity', function() {
                var quantity = $(this).val();
                var price = $(this).closest('.order-item').find('.order-price').text();
                var total = (parseFloat(price) * parseInt(quantity)).toFixed(2);
                $(this).closest('.order-item').find('.total').text(total);

                updateSubtotal();
                payAmount();
            });

            $(document).on('click', '.remove-item', function() {
                $(this).closest('.order-item').remove();
                updateSubtotal();
                payAmount();
            });

            function updateSubtotal() {
                var subtotal = 0;
                $('#orders .order-item').each(function() {
                    var price = parseFloat($(this).find('.order-price').text());
                    var quantity = parseInt($(this).find('.quantity').val());
                    $(this).find('.order-q').text(quantity);
                    subtotal += (price * quantity);
                });

                $('#total-order').text(subtotal.toFixed(2));
            }

            function payAmount() {
                var tbill = parseFloat($('#total-order').text());
                var tax = parseFloat($('#tax').text());
                var dis = parseFloat($('#discount').text());

                var pay = (tbill + tax) - (tbill * (dis /
                    100)); // Adjusted parentheses for correct order of operations
                $('#total-order2').text(pay);
            }


            // Printn
            // $('#submitp').click(function() {
            //     var printContents = $('#print').html();
            //     $(".order-q").removeClass("d-none");
            //     var originalContents = document.body.innerHTML;
            //     document.body.innerHTML = printContents;
            //     window.print();
            //     document.body.innerHTML = originalContents;
            // });

            // order Submitted

            $('#submitp').click(function() {
                var items = [];
                var totalbill = $('#total-order').text();
                var supplier = $('#supplier_id').val();
                $('#orders .order-item').each(function() {
                    var id = $(this).data('id');
                    var quantity = $(this).find('.order-q').html();

                    items.push({
                        id: id,
                        quantity: quantity
                    });
                });

                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                $.ajax({
                    url: 'http://127.0.0.1:8000/purchase',
                    type: 'POST',
                    data: {
                        items: items,
                        totalbill: totalbill,
                        supplier_id:supplier,
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log(response.data);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

                $("#orders").empty();
                // location.reload();
            });

        });
    </script>
@endsection
