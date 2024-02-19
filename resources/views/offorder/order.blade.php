@extends('layouts.main')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .form-check-label {
            text-transform: capitalize;
        }

        @import url('https://fonts.googleapis.com/css2?family=Oranienbaum&family=Share+Tech+Mono&display=swap');

        @import url('https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@1,700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Fira+Mono:wght@700&display=swap');

        .r-text {
            font-size: 18px;
        }

        .aw-ul {
            display: none;
            margin: 0;
            padding: 0;
        }

        @media print {
            @import url('https://fonts.googleapis.com/css2?family=DotGothic16&display=swap');

            * {
                /* font-family: 'Oranienbaum', serif; */
                /* font-family: 'Share Tech Mono', monospace; */
                /* font-family: 'Philosopher', sans-serif; */
                /* font-family: 'DotGothic16', sans-serif; */
                font-family: 'Fira Mono', monospace;
            }

            .aw-ul {
                display: block;
            }

            .pnone {
                display: none;
            }

            .r-text {
                font-size: 13px;
            }

            @page {

                margin: .4cm;
            }
        }
    </style>
@endsection
@section('content')
    <div class="my-5">
        <div class="card">
            <div class="row m-3">

                <div class="col-md-8">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search Product" aria-label="Username"
                            aria-describedby="basic-addon1">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                    </div>
                    <div class="card  mb-1">
                        <div class="card-header">
                            <div class="row row-cols-4 row-cols-md-6 g-3">

                                @foreach ($cats as $item)
                                    <div class="col">

                                        <div class="btn btn-outline-success catbtn " id="catbtn"><span
                                                class="cid d-none">{{ $item->id }}</span>{{ $item->name }}</div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="">

                        <div class="row row-cols-1 row-cols-md-4 g-4" id="menuContainer">




                        </div>
                        <div class="row row-cols-1 row-cols-md-4 g-4 d-none" id="menuContainer2">



                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div id="print" class="card p-2">
                        <div class="d-none d-print-block">
                            <div class="fs-3 text-center r-heading">GREEN KITCHEN</div>
                            <div class="r-text text-center">Islam Tower,2nd Floor,102 Shukrabad,Dhanmondi-32,Dhaka-1207 <br>
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
                                        $currentTime = date('H:i A');
                                        echo $currentTime;
                                    @endphp

                                </div>


                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <div class="fs-2 font-weight-bold">Paid</div>
                                <div class="r-text">Invoice ID: 000{{ $lastOrderId + 1 }}
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 d-none d-print-block">
                            <div class="col">Payment Methode: <span id="paymentMethod1">Cash</span></div>
                            <div class="col"> <span id="transactionId1"></span></div>
                        </div>
                        <div class="row row-cols-2 d-print-none">

                            <div class="mb-3 col">
                                <label for="paymentMethod" class="form-label">Select Payment Method</label>
                                <select class="form-select" id="paymentMethod" name="paymentMethod">
                                    <option value="cash">Cash</option>
                                    <option value="bkash">Bkash</option>
                                    <option value="card">Card</option>
                                </select>
                            </div>
                            <div class="col">

                                <div class="mb-3 d-none" id="bkashInput">
                                    <label for="transactionId" class="form-label">Transaction ID</label>
                                    <input type="text" class="form-control" id="transactionId" name="transactionId"
                                        required>
                                </div>

                                <div class="mb-3 d-none" id="cardInput">
                                    <label for="cardLastDigits" class="form-label">Laast 4 digit of Card</label>
                                    <input type="text" class="form-control" id="cardLastDigits" name="cardLastDigits"
                                        required>
                                </div>
                            </div>
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

                        </div>

                    

                        <div class="mt-4">
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
                                        <option value="{{ $staff->id }}"
                                            data-sname="{{ $staff->name }}-{{ $staff->employeeId }}">{{ $staff->name }} -
                                            {{ $staff->employeeId }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        {{-- <div class="">
                            <span>Special Discount: </span>
                            <span id="discount">0</span>
                            <span>TK</span>
                        </div> --}}
                        <div>
                            <span>Ammount to Pay: </span>
                            <span id="total-order2"></span>
                            <span>TK</span>
                        </div>

                        <div class="aw-ul text-center">----------------</div>
                        <div class="d-none d-print-block">
                            THANK YOU, COME AGAIN <br> Print By:
                            @if (Auth::Check())
                                {{ Auth::user()->name }}
                            @endif

                        </div>
                    </div>
                    <div class="d-flex justify-content-between">

                        <button class="btn btn-outline-danger pnone mt-5" id="submitp">Submit Order</button>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-info pnone mt-5" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" id="staffView">
                            Go TO Staff View
                        </button>
                        <button type="button" class="btn btn-outline-info mt-5 d-none" id="customerView">
                            <i class="fa-solid fa-backward fa-fade"></i> Back
                        </button>

                    </div>
                </div>


            </div>

        </div>

    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Card Customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <form method="POST" action="{{ url('cardcheck') }}">
                        @csrf --}}
                    <div class="mb-3">
                        <label class="form-label">Manager Password</label>
                        <input type="password" class="form-control" id="managerPass" name="managerPass">
                    </div>
                    {{-- <button type="submit" class="btn btn-outline-info">Submit</button> --}}
                    <button type="button" class="btn btn-outline-info" id="managerAuth"
                        data-bs-dismiss="modal">Submit</button>
                    {{-- </form> --}}
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        })
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="X-CSRF-TOKEN"]').attr('content')
            }
        });
        $(document).ready(function() {
            // product show by category
            $("#paymentMethod").change(function() {
                var selectedMethod = $(this).val();
                $("#paymentMethod1").text("");
                $("#paymentMethod1").text(selectedMethod);
                // Hide all input fields initially
                $("#bkashInput, #cardInput").hide();

                if (selectedMethod === "bkash") {
                    $("#bkashInput").show();
                    // $('#bkashInput').addClass('d-none');
                    $('#bkashInput').removeClass('d-none');
                    $("#cardInput input").val(""); // Clear card input if visible
                    $('#transactionId').on('input', function() {
                        $('#transactionId1').text('Transaction ID: '+ $(this).val());
                    });
                    $("#transactionId1").text(trid);
                } else if (selectedMethod === "card") {
                    $("#cardInput").show();
                    $('#cardInput').removeClass('d-none');
                    $("#bkashInput input").val(""); // Clear bkash input if visible
                    $('#cardLastDigits').on('input', function() {
                        $('#transactionId1').text('Card Last 4 Digit: ' +$(this).val());
                    });
                }
            });
            // Set the inactivity timeout in milliseconds (e.g., 5 minutes)
            var inactivityTimeout = 3000; // 5 minutes

            var timeout;

            // Function to reset the timeout
            function resetTimeout() {
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    // Redirect to the previous interface or another page
                    window.location.href = document.referrer;
                }, inactivityTimeout);
            }

            function render_quiz_questions(quizzes) {
                let q = "";
                let r = "";
                quizzes.forEach(menu => {
                    let html = '';

                    var cDiscount = menu.price - Math.round(((menu.category.discount * menu.price) / 100) /
                        5) * 5;
                    var sDiscount = cDiscount - Math.round(((menu.discount * cDiscount) / 100) / 5) * 5;
                    // var sDiscount = ((menu.discount * cDiscount)/100);

                    html +=

                        `<div class="col" >
                            <div class="card h-100">
                                    <img src="{{ asset('storage/menu') }}/${ menu.image }" height="150px" 
                                        class="card-img-top" alt="${ menu.image }">
                                    <div class="card-body">
                                        <span class="id d-none">${ menu.id }</span>
                                        <h5 class="card-title name">${ menu.name }</h5>
                                        <div class="card-text ">
                                            <div class="text-decoration-line-through">
                                                <span>Price: </span><span class="discount"> ${ menu.price }</span>TK
                                                </div>
                                           <div>
                                            <span>Discount Price:</span>
                                            <span  class="price customer"> ${cDiscount }</span>
                                            </div>
                                            
                                        </div>
                                        <div class="text-center mt-3">
                                            <button class="btn btn-outline-danger select">Add</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        `;

                    q += html;

                });
                quizzes.forEach(menu => {
                    let html = '';

                    var cDiscount = menu.price - Math.round(((menu.category.discount * menu.price) / 100) /
                        5) * 5;
                    var sDiscount = cDiscount - Math.round(((menu.discount * cDiscount) / 100) / 5) * 5;
                    // var sDiscount = ((menu.discount * cDiscount)/100);

                    html +=

                        `<div class="col" >
                            <div class="card h-100">
                                    <img src="{{ asset('storage/menu') }}/${ menu.image }" height="150px" 
                                        class="card-img-top" alt="${ menu.image }">
                                    <div class="card-body">
                                        <span class="id d-none">${ menu.id }</span>
                                        <h5 class="card-title name text-danger">${ menu.name }</h5>
                                        <div class="card-text ">
                                            <div class="text-decoration-line-through">
                                                <span>Price: </span><span class="discount"> ${ menu.price }</span>TK
                                                </div>
                                           <div>
                                            <span>Discount Price:</span>
                                            <span  class="sprice staff"> ${sDiscount}</span>
                                            </div>
                                            
                                        </div>
                                        <div class="text-center mt-3">
                                            <button class="btn btn-outline-danger staff">Staff</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        `;

                    r += html;

                });
                $("#menuContainer").html(q);
                $("#menuContainer2").html(r);

            }
            $('#customerView').click(function() {
                $('#menuContainer2').addClass('d-none');
                $('#menuContainer').removeClass('d-none');

                $('#customerView').addClass('d-none');
                $('#staffView').removeClass('d-none');

                $('.customer').removeClass('d-none');
                let sName = $('#staffs').data('sname');

                $('#invoiceStaff').text('');
                $('#orders').text('');

            });
            $('#managerAuth').click(function() {
                const managerPass = $('#managerPass').val();
                console.log(managerPass);
                // return;
                if (managerPass === 'A123') {
                    $('#orders').text('');
                    $('#menuContainer2').removeClass('d-none');
                    $('#menuContainer').addClass('d-none');

                    $('#customerView').removeClass('d-none');
                    $('#staffView').addClass('d-none');

                    $('.customer').addClass('d-none');
                    let sName = $('#staffs').data('sname');

                    $('#invoiceStaff').text('Staff-Invoice');

                    $(document).on('mousemove keydown', function() {
                        resetTimeout();
                    });
                    // resetTimeout();
                } else {


                    Swal.fire({
                        icon: 'warning',
                        title: 'Pleace Contact With Management',
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });
                }



            });

            // mostak
            $(".catbtn").click(function() {
                var id = $(this).find('.cid').html();
                console.log(id);
                $.ajax({
                        method: "GET",
                        url: "{{ url('catmenu') }}/" + (id ?? 1),


                        dataType: "json",
                        success: function(response) {
                            render_quiz_questions(response);
                        }
                    })
                    .done(function(data) {
                        if (data.length != 0) {
                           
                        } else {
                            console.log("no Data in the databaes");
                        }
                    });
            });
            $("#catbtn").trigger('click');

            // select product from card and input into menu
            $(document).on('click', '.select', function() {
                // $('.select').click(function() {
                var id = $(this).closest('.col').find('.id').text();
                var name = $(this).closest('.col').find('.name').text();
                var dis = $(this).closest('.col').find('.price').text();
                var price = $(this).closest('.col').find('.discount').text();

                // Check if an item with the same id already exists
                var existingItem = $('#orders').find(`.order-item[data-id="${id}"]`);



                if (existingItem.length > 0) {
                    var quantity = parseInt(existingItem.find('.quantity').val());
                    quantity++;
                    existingItem.find('.quantity').val(quantity);
                    var total = (parseFloat(dis) * quantity).toFixed(2);
                    existingItem.find('.total').text(total);
                } else if (dis == price) {
                    var orderItem = `
                    <div class="order-item mb-2" data-id="${id}">
                        <div class="row">
                                        <div class="col-3">
                                            <div class="order-info d-inline">
                                                <span class="order-name">${name}</span>
                                                <span class="order-price d-none">${dis}</span>
                                            </div>
                                        </div>
                                                <div class="col-2">
                                                    <input type="number" class="quantity pnone" style="width:50px"  value="1" min="1">
                                                    <span class="order-q d-none d-print-block"></span>
                       
                                        </div>
                                        <div class="col-3 ">
                                           
                                            <span class="">${dis}</span>
                                            <span >TK</span>
                                            
                                        </div>
                                        <div class="col-2">
                                            
                                            <span class="total">${dis}</span>
                                            <span >TK</span>
                                        </div>
                                        <div class="col-2">
                                            <button class="pnone btn btn-outline-danger remove-item"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                        </div>
                    
                   
                    </div> `;


                    $('#orders').append(orderItem);
                } else {
                    var orderItem = `
                    <div class="order-item mb-2" data-id="${id}">
                        <div class="row">
                                        <div class="col-3">
                                            <div class="order-info d-inline">
                                                <span class="order-name">${name}</span>
                                                <span class="order-price d-none">${dis}</span>
                                                </div>
                                                </div>
                                                <div class="col-2">
                                                    <input type="number" class="quantity pnone" style="width:50px"  value="1" min="1">
                                                    <span class="order-q d-none d-print-block"></span>
                       
                                        </div>
                                        <div class="col-3 ">
                                            <div class="text-decoration-line-through">
                                                
                                                <span class="">${price}</span>
                                                <span >TK</span>
                                                </div>
                                            <span class="">${dis}</span>
                                            <span >TK</span>
                                            
                                        </div>
                                        <div class="col-2">
                                            
                                            <span class="total">${dis}</span>
                                            <span >TK</span>
                                        </div>
                                        <div class="col-2">
                                            <button class="pnone btn btn-outline-danger remove-item"><i class="fa-solid fa-xmark"></i></button>
                                        </div>
                        </div>
                    </div> `;
                    $('#orders').append(orderItem);
                }

                updateSubtotal();
                payAmount();
            });
            $(document).on('click', '.staff', function() {
                // $('.select').click(function() {
                var id = $(this).closest('.col').find('.id').text();
                var name = $(this).closest('.col').find('.name').text();
                var dis = $(this).closest('.col').find('.sprice').text();
                var price = $(this).closest('.col').find('.discount').text();

                // Check if an item with the same id already exists
                var existingItem = $('#orders').find(`.order-item[data-id="${id}"]`);



                if (existingItem.length > 0) {
                    var quantity = parseInt(existingItem.find('.quantity').val());
                    quantity++;
                    existingItem.find('.quantity').val(quantity);
                    var total = (parseFloat(dis) * quantity).toFixed(2);
                    existingItem.find('.total').text(total);
                } else if (dis == price) {
                    var orderItem = `
                    <div class="order-item mb-2" data-id="${id}">
                        <div class="row">
                                        <div class="col-3">
                                            <div class="order-info d-inline">
                                                <span class="order-name">${name}</span>
                                                <span class="order-price d-none">${dis}</span>
                                                </div>
                                                </div>
                                                <div class="col-2">
                                                    <input type="number" class="quantity pnone" style="width:50px"  value="1" min="1">
                                                    <span class="order-q d-none d-print-block"></span>
                       
                                        </div>
                                        <div class="col-3 ">
                                           
                                            <span class="">${dis}</span>
                                            <span >TK</span>
                                            
                                        </div>
                                        <div class="col-2">
                                            
                                            <span class="total">${dis}</span>
                                            <span >TK</span>
                                        </div>
                                        <div class="col-2">
                                            <button class="pnone btn btn-outline-danger remove-item"><i class="fa-solid fa-xmark"></i></button>
                                        </div>
                        </div>
                    
                   
                    </div> `;


                    $('#orders').append(orderItem);
                } else {
                    var orderItem = `
                    <div class="order-item mb-2" data-id="${id}">
                        <div class="row">
                                        <div class="col-3">
                                            <div class="order-info d-inline">
                                                <span class="order-name">${name}</span>
                                                <span class="order-price d-none">${dis}</span>
                                                </div>
                                                </div>
                                                <div class="col-2">
                                                    <input type="number" class="quantity pnone" style="width:50px"  value="1" min="1">
                                                    <span class="order-q d-none d-print-block"></span>
                       
                                        </div>
                                        <div class="col-3 ">
                                            <div class="text-decoration-line-through">
                                                
                                                <span class="">${price}</span>
                                                <span >TK</span>
                                                </div>
                                            <span class="">${dis}</span>
                                            <span >TK</span>
                                            
                                        </div>
                                        <div class="col-2">
                                            
                                            <span class="total">${dis}</span>
                                            <span >TK</span>
                                        </div>
                                        <div class="col-2">
                                            <button class="pnone btn btn-outline-danger remove-item"><i class="fa-solid fa-xmark"></i></button>
                                        </div>
                        </div>
                    </div> `;
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
            $(document).on('click', '.staff', function() {
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

            $('#apply_dis').click(function() {
                // var disc = parseInt($('#dis_input').val());
                // $('#discount').text(disc);
                var tbill = parseFloat($('#total-order').text());
                var tax = parseFloat($('#tax').text());
                // var dis = parseFloat($('#discount').text());

                var num = tbill ;
                $('#total-order2').text(num);
            })

            function payAmount() {

                var tbill = parseFloat($('#total-order').text());
                var tax = parseFloat($('#tax').text());
                // var dis = parseFloat($('#discount').text());

                var num = tbill;
                $('#total-order2').text(num);
            }
            // order Submitted

            $('#submitp').click(function() {
                var items = [];
                var totalbill = $('#total-order').text();
                // var discount = $('#discount').text();
                var reason = $('#reason').val();
                var staff = parseFloat($('#staffs').val());
                var sInvoice = $('#invoiceStaff').text();
                let selectedOption = $('#staffs').find(':selected');

                // Get the values of the 'data-sname' attribute and the text content
                let sNameAttribute = selectedOption.data('sname');
                let sNameText = selectedOption.text();
                if (sInvoice === "Staff-Invoice" && staff === 0) {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Input Staff Name',
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });

                    return;
                }
                // payment method selection
                var selectedMethod = $("#paymentMethod").val();

                if (selectedMethod === "cash") {
                    Swal.fire("Processing cash payment");
                } else if (selectedMethod === "bkash") {
                    var transactionId = $("#transactionId").val();
                    if (transactionId.trim() === "") {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Please enter transaction ID for Bkash",
                        });
                        return;
                    } else {
                        Swal.fire("Processing Bkash payment with Transaction ID: " + transactionId);
                    }
                } else if (selectedMethod === "card") {
                    var cardLastDigits = $("#cardLastDigits").val();
                    if (cardLastDigits.trim() === "" || isNaN(cardLastDigits) || cardLastDigits.length !==
                        4) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Please enter valid last 4 digits of the card",
                        });
                        return;
                    } else {
                        Swal.fire("Processing Card payment with Last 4 Digits: " + cardLastDigits);
                    }
                }
                // if (discount == 0 && reason !== "") {

                //     Swal.fire({
                //         icon: 'warning',
                //         title: 'Apply Discount Or Remove Reason',
                //         showCancelButton: false,
                //         showConfirmButton: true,
                //         confirmButtonText: 'OK',
                //         customClass: {
                //             confirmButton: 'btn btn-primary'
                //         }
                //     });

                //     return;
                // }
                $('#orders .order-item').each(function() {
                    var id = $(this).data('id');
                    var quantity = $(this).find('.order-q').html();
                    var total = $(this).find('.total').html();

                    items.push({
                        id: id,
                        quantity: quantity,
                        total: total
                    });
                });

                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                $.ajax({
                    url: '{{ url('offorder') }}',
                    type: 'POST',
                    data: {
                        items: items,
                        totalbill: totalbill,
                        discount: 0,
                        reason: sNameText,
                        staff: staff,
                        paymentMethod: selectedMethod,
                        transactionId: transactionId || cardLastDigits || 'Cash',
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

                // print section

                var printContents = $('#print').html();
                $(".order-q").removeClass("d-none");
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;


                $("#orders").empty();
                location.reload();

            });
            // Printn
            // $('#submitp').click(function() {
            //     var printContents = $('#print').html();
            //     $(".order-q").removeClass("d-none");
            //     var originalContents = document.body.innerHTML;
            //     document.body.innerHTML = printContents;
            //     window.print();
            //     document.body.innerHTML = originalContents;


            //     $("#orders").empty();
            //     location.reload();
            // });


        });
    </script>
@endsection
