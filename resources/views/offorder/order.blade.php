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

        .r-text {
            font-size: 10pt;

            font-family: "Oswald", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
        }

        @media print {
            @import url('https://fonts.googleapis.com/css2?family=DotGothic16&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap');

            * {
                font-family: "Oswald", sans-serif;
                /* font-family: 'Fira Mono', monospace; */
            }

            .aw-ul {
                display: block;
            }

            .pnone {
                display: none;
            }

            .r-text {
                font-size: 8pt;
                margin-bottom: 1px;
                font-weight: 900;
                font-family: "Oswald", sans-serif;
                font-optical-sizing: auto;
                font-style: normal;
            }

            @page {

                margin: .2cm;
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
                            <div class="row  g-2">

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
                            <div class="row r-text row-cols-1 d-none d-print-block">
                                <div class="col">Payment Methode: <span id="paymentMethod1">Cash</span></div>
                                <div class="col"> <span id="transactionId1"></span></div>
                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <div class="fs-2 font-weight-bold">Paid</div>
                                <div class="r-text">Invoice ID: 000{{ $lastOrderId + 1 }}
                                </div>
                            </div>
                        </div>
                        <div class=" d-print-none staffname text-center">
                            <div class="form-group">
                                <div class="input-group text-danger my-2">
                                    <select name="saleCategory" id="saleCategory" class="form-control select2">
                                        <option data-category="1" data-active="1" value="0">Dine In</option>
                                        <option data-category="1" data-active="1" value="0">Take Out</option>
                                        <option data-category="1" data-active="7" value="0">Delivery</option>
                                        <option data-category="2" data-mobile="0" data-active="3" data-sname="Pathao"
                                            value="26.25">Pathao
                                        </option>
                                        <option data-category="2" data-mobile="0" data-active="4" data-sname="Food Panda"
                                            value="32.5">Food
                                            Panda</option>
                                        <option data-category="2" data-mobile="0" data-active="6" data-sname="IPD"
                                            value="0">IPD</option>
                                        <option data-category="2" data-mobile="0" data-active="5" data-sname="IPD"
                                            value="100">Chairman
                                            Sir/Guest</option>
                                    </select>
                                </div>
                                <div id="customerSection" class="input-group text-info">
                                    {{-- <label for="staffs">Staff Name</label> 
                                    <option data-mobile="0" data-active="1" data-name="0" value="0">Walk In
                                            Customer</option>
                                        <option data-mobile="0" data-active="3" data-sname="Pathao" value="26.25">Pathao
                                        </option>
                                        <option data-mobile="0" data-active="4" data-sname="Food Panda" value="32.5">Food
                                            Panda</option>
                                        <option data-mobile="0" data-active="6" data-sname="IPD" value="0">IPD</option>
                                        <option data-mobile="0" data-active="5" data-sname="IPD" value="100">Chairman
                                            Sir/Guest</option>

                                        @foreach ($customers as $customer)
                                            <option data-mobile="{{ $customer->mobile }}" class="customer"
                                                value="{{ $customer->discount }}" data-discount="{{ $customer->discount }}"
                                                data-active="{{ $customer->card_status }}"
                                                data-sname="{{ $customer->user->name }}">
                                                {{ $customer->user->name }} -
                                                {{ $customer->mobile }} -
                                                {{ $customer->discount }}
                                            </option>
                                        @endforeach
                                    --}}
                                    <select name="staffs" id="staffs" class="form-control select2">

                                    </select>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="input-group-text" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                    <button type="button" class="input-group-text" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal1">
                                        <i class="fa-solid fa-edit"></i>
                                    </button>


                                </div>
                            </div>
                        </div>

                        <div id="invoiceStaff" class="text-center text-danger fs-4">

                        </div>


                        <div class="row  r-text mb-2">
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
                        <div class="mt-2 r-text">
                            <span>GROSS Total: </span>
                            <span id="total-order"></span>
                            <span>TK</span>
                            <div class="d-print-none">
                                <div class="row g-2">
                                    <button type="button" class="col-4 my-2 btn btn-outline-success" id="allowDiscount">
                                        Discount
                                    </button>
                                    <div class="col-8">
                                        <input type="text" id="reason" class="form-control border border-danger"
                                            placeholder="Input Comment">
                                    </div>
                                </div>
                                <div class="row row-cols-2 dis-apply d-none g-2">
                                    <div class="col">
                                        {{-- <input type="text" id="number" class="form-control" placeholder="01752243665"> --}}
                                        <select class="form-control" name="oneTimeDiscount" id="oneTimeDiscount">
                                            <option value="0">Percent </option>
                                            <option value="5">5%</option>
                                            <option value="10">10%</option>
                                            <option value="15">15%</option>
                                            <option value="20">20%</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row saleCategory d-none row-cols-4 g-2">
                                    <div class="col">
                                        <label class="form-label" for="deliveryDis">Discount Delivery Charge:</label>
                                    </div>
                                    <div class="col">
                                        <select name="" id="deliveryDis" class="form-control">
                                            <option value="100">Free</option>
                                            <option value="40">40Tk</option>
                                            <option value="50">50Tk</option>
                                            <option value="60">60Tk</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="deliveryCharge">Actual Delivery Charge:</label>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" value="0" type="number" id="deliveryCharge">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="r-text" id="discountComment">

                        </div>
                        <div class="r-text">
                            <span>Ammount to Pay: </span>
                            <span id="total-order2"></span>
                            <span>TK</span>
                        </div>

                        <div class="aw-ul text-center">----------------</div>
                        <div class="d-none r-text d-print-block">
                            THANK YOU, COME AGAIN <br> Print By:
                            @if (Auth::Check())
                                {{ Auth::user()->name }}
                            @endif

                        </div>
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
                    <div class="d-flex justify-content-between">

                        <button class="btn btn-outline-danger pnone mt-5" id="submitp">Submit Order</button>
                        <!-- Button trigger modal -->
                        {{-- <button type="button" class="btn btn-outline-info pnone mt-5" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" id="staffView">
                            Go TO Staff View
                        </button>
                        <button type="button" class="btn btn-outline-info mt-5 d-none" id="customerView">
                            <i class="fa-solid fa-backward fa-fade"></i> Back
                        </button> --}}

                    </div>
                </div>


            </div>

        </div>

    </div>



    <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Card Customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label class="form-label">Manager Password</label>
                        <input type="password" class="form-control" id="managerPass" name="managerPass">
                    </div>
                    <button type="button" class="btn btn-outline-info" id="managerAuth"
                        data-bs-dismiss="modal">Submit</button>
                  
                </div>
               
            </div>
        </div>
    </div> --}}
    @include('customer.modal')
    @include('customer.editmodal')
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
            // customer data add
            $('#customerSubmitBtn').click(function(e) {
                e.preventDefault(); // Prevent default form submission

                var formData = $('#customerForm').serialize(); // Serialize form data
                console.log(formData);
                $.ajax({
                    url: "{{ route('customer.store') }}", // URL to submit the form data
                    type: "POST",
                    data: formData, // Form data
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Include CSRF token
                    },
                    success: function(response) {
                        customerCreate();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Customer information added successfully.',
                        }, )
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Customer information added Fail.',
                        }, )
                        console.error(xhr.responseText);
                    }
                });
            });
            //customer data show

            function customerCreate() {
                $.ajax({
                    url: '{{ route('get-customers') }}',
                    type: 'GET',
                    success: function(response) {
                        // Clear existing options
                        $('#staffs').empty();

                        // Add default option
                        $('#staffs').append(
                            `
                            <option data-mobile="0" data-active="1" data-name="0" value="0">Walk In
                                            Customer</option>
                                       
                            `
                            // <option data-mobile="0" data-active="3" data-sname="Pathao" value="26.25">Pathao
                            //             </option>
                            //             <option data-mobile="0" data-active="4" data-sname="Food Panda" value="32.5">Food
                            //                 Panda</option>
                            //             <option data-mobile="0" data-active="6" data-sname="IPD" value="0">IPD</option>
                            //             <option data-mobile="0" data-active="5" data-sname="IPD" value="100">Chairman
                            //                 Sir/Guest</option>
                        );

                        // Add options for each customer
                        $.each(response, function(index, customer) {
                            var discount = parseFloat(customer.discount);
                            console.log("Discount value:", discount);

                            $('#staffs').append(`<option data-mobile="${customer.mobile}" data-address="${customer.address}" data-id="${customer.id}" class="customer" value="${customer.discount}" data-discount="${customer.discount}" data-active="${customer.card_status}" data-sname="${customer.user.name}">
                ${customer.user.name} - ${customer.mobile} - ${customer.discount}-${customer.id}
                     </option>`);
                        });

                        // Initialize select2 after populating options
                        $('#staffs').select2();

                        // Set the value of #staffs after options have been populated

                    },
                    error: function(xhr) {
                        console.error(xhr);
                    }
                });

            };
            customerCreate();
            $('customerSubmitBtn').click(function() {
                customerCreate();
            });
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
                        $('#transactionId1').text('Transaction ID: ' + $(this).val());
                    });
                    $("#transactionId1").text(trid);
                } else if (selectedMethod === "card") {
                    $("#cardInput").show();
                    $('#cardInput').removeClass('d-none');
                    $("#bkashInput input").val(""); // Clear bkash input if visible
                    $('#cardLastDigits').on('input', function() {
                        $('#transactionId1').text('Card Last 4 Digit: ' + $(this).val());
                    });
                }
            });
            // Set the inactivity timeout in milliseconds (e.g., 5 minutes)
            var inactivityTimeout = 8000; // 

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
                                        <h5 class="card-title name ${menu.quantity < 5 ? 'text-danger' : ''}">${ menu.name }</h5>
                                        <div class="card-text ">
                                            <div class="d-none text-decoration-line-through">
                                                <span>Price: </span><span class="discount"> ${ menu.price }</span>TK
                                                </div>
                                           <div class="d-flex justify-content-between">
                                            <div>
                                                <span>Price:</span>
                                                <span  class="price customer"> ${menu.price }</span>
                                            </div>
                                            
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
                    // <div class="${menu.quantity < 5 ? 'text-danger' : ''}">
                    //                             <span>Stock: </span>
                    //                             <span> ${menu.quantity}</span>
                    //                         </div>
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
                $('.staffname').addClass('d-none');
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


                    $('.staffname').removeClass('d-none');
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

                $('#total-order').text(subtotal.toFixed(0));
            }

            $('#allowDiscount').click(function() {
                let selectedOption = $('#staffs').find(':selected');
                let sNameAttribute = selectedOption.data('name');
                if (sNameAttribute == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Add Customer For Discount',
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });
                    return false;
                } else {
                    $('.dis-apply').toggleClass('d-none');
                    //    payAmount();
                }
            });
            $('#oneTimeDiscount').on('change', function() {
                payAmount();
            });
            $('#deliveryCharge').on('change', function() {
                payAmount();
            });
            $('#deliveryDis').on('change', function() {
                payAmount();
            });
            // saleCategory dropdown change notification
            $('#saleCategory').on('change', function() {
                let selectedOption = $('#saleCategory').find(':selected');
                let active = parseFloat(selectedOption.data('active'));
                let category = parseFloat(selectedOption.data('category'));
                if (active == 7) {
                    $('.saleCategory').removeClass('d-none');
                } else {
                    $('.saleCategory').addClass('d-none');
                }

                if (category == 1) {
                    $('#customerSection').removeClass('d-none');
                } else if (category == 2) {
                    $('#customerSection').addClass('d-none');
                }
                payAmount();
            });
            // staff dropdown change
            $('#staffs').on('change', function() {
                let selectedOption = $(this).find(':selected');
                let id = selectedOption.data('id'); // No need to parse to float
                let address = selectedOption.data('address');
                let url =
                "{{ route('customer.update', ['customer' => ':id']) }}"; // Note the placeholder ':id'

                // Replace the placeholder with the actual id
                url = url.replace(':id', id);

                // Dynamically generate the form HTML
                let html = `
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="address" class="form-label">Address :</label>
                                <input class="form-control" type="text" id="customerAddress" name="address" value="${address}">
                            </div>
                            <button class="my-2 btn btn-outline-info" id="customerUpdate" type="submit">Update</button>
                        `;

                // Replace the existing form with the new one
                $('#editForm').html(html);


                payAmount();
            });
            // Submit form using AJAX
            $('#editForm').on('click', '#customerUpdate', function() {
                let selectedOption = $('#staffs').find(':selected');
                let id = selectedOption.data('id');
                let address = $('#customerAddress').val(); // Get the address from the form
// alert(id);
                // Make AJAX request
                $.ajax({
                    url: "{{ url('customer') }}/" + id,
                    type: 'PUT',
                    data: {
                        address: address,
                        _token: '{{ csrf_token() }}',
                    },
                   
                    success: function(data) {
                        customerCreate();
                        // Perform actions after successful update
                        // For example, show a success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Customer Updated'
                        });

                        console.log('Customer updated successfully');
                        // Optionally, you can perform additional actions such as refreshing the page or closing a modal
                        // For example:
                        // window.location.reload(); // Refresh the page
                        // $('.modal').modal('hide'); // Close the modal
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating customer:', error);
                        // Show error message
                        // Swal.fire({
                        //     icon: 'error',
                        //     title: 'Error',
                        //     text: 'An error occurred while updating the customer.'
                        // });
                    }
                    // location.reload(); 
                });
            });


            function payAmount() {
                var tbill = parseFloat($('#total-order').text());
                var tax = parseFloat($('#tax').text());
                // alert('Pay amount');
                var deliveryCharge = parseFloat($('#deliveryCharge').val());
                var deliveryDis = parseFloat($('#deliveryDis').val());
                var staffDis = parseFloat($('#staffs').val());
                var oneDis = parseFloat($('#oneTimeDiscount').val());
                var categoryDis = parseFloat($('#saleCategory').val());
                console.log(staffDis + oneDis);
                if (oneDis > staffDis) {
                    var prediscount = tbill * oneDis * 0.01;
                } else if (oneDis < staffDis) {
                    var prediscount = tbill * staffDis * 0.01;
              
                } else if (categoryDis > 0) {
                    var prediscount = tbill * categoryDis * 0.01;
                } else {
                    var prediscount = 0;
                };
                console.log(prediscount);
                var discount = prediscount.toFixed(0);

              
                if (deliveryCharge >0) {
                    
                    $('#discountComment').text(deliveryDis+' TK Delivery Discount and '+discount + ' Tk Special Discount');
                    var num = tbill + deliveryCharge - discount-deliveryDis; // Assuming you want to apply a 20% discount
                } else {
                    
                    var num = tbill + deliveryCharge - discount; // Assuming you want to apply a 20% discount
                    $('#discountComment').text(discount + ' Tk Discount Apply');
                }
                $('#total-order2').text(num); // Update the total order amount
                $('#discountPer').text(staffDis);
            }

            $('#submitp').click(function() {

                let selectedOption = $('#staffs').find(':selected');
                let selectedOption2 = $('#saleCategory').find(':selected');

                let activeAttr2 = selectedOption2.data('active');
                if (activeAttr2 == 1) {
                    var activeAttr = selectedOption.data('active');
                } else {
                    var activeAttr = selectedOption2.data('active');

                }

                console.log(activeAttr2, activeAttr);
                var totalbill = $('#total-order').text();
                var paybill = $('#total-order2').text();
                var reason = $('#reason').val();
                if (totalbill > paybill && (activeAttr === 1 || activeAttr === 5) && reason == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Input Reason First',
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });
                    return false;
                }

                var items = [];

                // var discount = $('#discount').text();
                var reason = $('#reason').val();
                var staff = parseFloat($('#staffs').val());
                var sInvoice = $('#invoiceStaff').text();
                var deliveryDis = parseFloat($('#deliveryDis').val());

                // Get the values of the 'data-sname' attribute and the text content
                let sNameAttribute = selectedOption.data('sname');
                let address = selectedOption.data('address');
                let idAttr = selectedOption.data('id');
                let mobileAttr = selectedOption.data('mobile');

                let sNameText = selectedOption.text();
                let deliveryCharge = $('#deliveryCharge').val();
                if (activeAttr == 7 && mobileAttr == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'First Select Customer',
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });
                    // continue
                    return false;
                } else if (activeAttr == 7 && address == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Input Customer Address',
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });
                    return false;
                } else if (activeAttr == 7 && deliveryCharge == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'First Input Delivery Charge ' + address,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });
                    return false;
                }
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
                    true
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
                        discount: totalbill - paybill,
                        reason: sNameAttribute + '-' + mobileAttr + '-' + reason,
                        active: activeAttr,
                        cid: idAttr,
                        delivery_charge: deliveryCharge,
                        delivery_discount: deliveryDis,
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
