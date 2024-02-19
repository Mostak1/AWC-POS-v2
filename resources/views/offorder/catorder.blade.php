@extends('layouts.main')
@section('style')
@endsection
@section('content')
    <div class="container">


        <div id="layoutSidenav_content">
            <main>
                <!-- changed content -->
                <div class="px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    {{-- @dd(Auth::user()->remember_token) --}}
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="p-4  h-100 rounded-4 Larger shadow bg-white text-info mb-4">

                                <div class="card-body">
                                    <i class="fa-solid fa-calendar"></i>
                                    Daily Order {{ $orderCountD ?? 00 }}

                                    <div class="card-body">
                                        <i class="fa-solid fa-weight-scale"></i>
                                        Daily Sell = {{ $totalSalesD ?? 00 }}TK From {{ $salesCountD ?? 00 }} Orders
                                        <br> <span><i class="fa-solid fa-tags"></i> Daily Discount =
                                            {{ $totalDisD ?? 00 }}TK
                                        </span>
                                        <br><span><i class="fa-solid fa-cart-arrow-down"></i> Net Sales =
                                            {{ $totalSalesD - $totalDisD ?? 00 }}TK</span>
                                    </div>
                                </div>

                                <a class="nav-link" href="{{ url('offorder') }}">View Details</a>


                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="p-4  h-100 rounded-4 Larger shadow  bg-white text-warning mb-4">

                                <div class="p-4-body">
                                    <i class="fa-regular fa-calendar-check"></i>
                                    Weekly Order {{ $orderCountW ?? 00 }}
                                    <div class="card-body">
                                        <i class="fa-solid fa-weight-scale"></i>
                                        Weekly Sell = {{ $totalSalesW ?? 00 }}TK From {{ $salesCountW ?? 00 }} Orders
                                        <br> <span><i class="fa-solid fa-tags"></i> Weekly Discount =
                                            {{ $totalDisW ?? 00 }}TK
                                        </span>
                                        <br><span><i class="fa-solid fa-cart-arrow-down"></i> Net Sales =
                                            {{ $totalSalesW - $totalDisW ?? 00 }}TK</span>
                                    </div>
                                </div>

                                <div class=" d-flex align-items-center justify-content-between p-4">
                                    <a class=" nav-link " href="{{ url('offorder') }}">View Details</a>
                                    <div class="small "><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="p-4  h-100 rounded-4 Larger shadow bg-white text-success mb-4">

                                <div class="card-body">
                                    <i class="fa-regular fa-calendar-days"></i>
                                    Monthly Order {{ $orderCountM ?? 00 }}

                                    <div class="card-body">
                                        <i class="fa-solid fa-weight-scale"></i>
                                        Monthly Sell = {{ $totalSalesM ?? 00 }}TK From {{ $salesCountM ?? 00 }} Orders
                                        <br> <span><i class="fa-solid fa-tags"></i> Monthly Discount =
                                            {{ $totalDisM ?? 00 }}TK
                                        </span>
                                        <br><span><i class="fa-solid fa-cart-arrow-down"></i> Monthly Sales =
                                            {{ $totalSalesM - $totalDisM ?? 00 }}TK</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="p-4  h-100 rounded-4 shadow bg-white text-danger mb-4">
                                <div class="card-body">Danger Card</div>

                            </div>
                        </div>
                    </div>
                    <div class="p-4 rounded-4 Larger shadow  bg-white card-hover  my-5">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-info">Daily Order</h4>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body mt-4">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="tablebtn text-end">
                                                <span>@php
                                                    $currentDate = date('d M Y');

                                                    echo $currentDate; // 5 OCT 2023

                                                @endphp</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Order ({{ $orderCountD }})</th>
                                            <th>Food Name</th>
                                            <th>Total Amount ({{ $totalSalesD }} TK)</th>
                                            <th>Discount ({{ $totalDisD }} TK)</th>
                                            <th>Reason</th>
                                            <th>Net Sale: {{ $totalSalesD - $totalDisD }} TK</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($items as $offorder)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    @foreach ($offorder->offorderdetails as $detail)
                                                        <div class="">
                                                            <span class="fs-6 me-3">{{ $detail->menu->name }} -</span>
                                                            <span class="fs-6"> Q: {{ $detail->quantity }} </span>
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td>{{ $offorder->total }}</td>
                                                <td>{{ $offorder->discount }}</td>
                                                <td>{{ $offorder->reason }}</td>
                                                <td>{{ $offorder->total - $offorder->discount }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 rounded-4 Larger shadow  bg-white card-hover  my-5">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-info">Order Report Table</h4>
                            <div class="m-0 font-weight-bold btn btn-outline-info" id="submitp"><i class="fa-solid fa-print"></i></div>

                        </div>
                        <div class="card-body mt-4">
                           
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                                            aria-controls="flush-collapseOne">
                                            Apply Filter
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">


                                            <div class="row row-cols-4 g-4 mb-2">
                                                <div class="col">
                                                    <label class="form-label" for="filterDate">Filter by Date:</label>
                                                    <input class="form-control" type="date" id="filterDate">
                                                </div>
 @if (Auth::check() && Auth::user()->role == 2)
                                                <div class="col">
                                                    <label class="form-label" for="filterCategory">Filter by
                                                        Category:</label>
                                                    <select class="form-select" id="filterCategory">
                                                        <option value="">All Categories</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label class="form-label" for="filterDateRange">Filter by Date
                                                        Range:</label>
                                                    <input class="form-control mb-1" type="date" id="filterStartDate">
                                                    <input class="form-control" type="date" id="filterEndDate">
                                                </div>
                                                <div class="col">
                                                    <label class="form-label" for="filterTimeRange">Filter by Time
                                                        Range:</label>
                                                    <input class="form-control mb-1" type="time" id="filterStartTime">
                                                    <input class="form-control" type="time" id="filterEndTime">
                                                </div>
                                                 @endif
                                                <div class="col">
                                                    <button class="btn btn-outline-info" type="button"
                                                        id="applyFilters">Apply Filters</button>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="table-responsive" id="printTable">
                                 <div class="text-center fs-2 d-none d-print-block">Green-Kitchen Daily Report</div>
                               
                                <table class="table table-bordered" id="orderDetails" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Menu Name</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                            <!-- Add more table headers based on your new filters -->
                                        </tr>
                                    </thead>
                                    {{-- <tbody id="tableBody">

                                    </tbody> --}}

                                </table>
                                <div id="totalsale">
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="p-4 rounded-4 Larger shadow  bg-white card-hover  my-5">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-info">Order Report Chart Product Vs Sale Quantity</h4>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body mt-4">
                             @if (Auth::check() && Auth::user()->role == 2)
                            <div class="accordion accordion-flush" id="accordionFlushExample1">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne1"
                                            aria-expanded="false" aria-controls="flush-collapseOne1">
                                            Apply Filter
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne1" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample1">
                                        <div class="accordion-body">


                                            <div class="row row-cols-4 g-4 mb-2">
                                                <div class="col">
                                                    <label class="form-label" for="filterDate1">Filter by Date:</label>
                                                    <input class="form-control" value="{{ $currentDate }}"
                                                        type="date" id="filterDate1">
                                                </div>

                                                <div class="col">
                                                    <label class="form-label" for="filterCategory1">Filter by
                                                        Category:</label>
                                                    <select class="form-select" id="filterCategory1">
                                                        <option value="">All Categories</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label class="form-label" for="filterDateRange1">Filter by Date
                                                        Range:</label>
                                                    <input class="form-control mb-1" type="date"
                                                        id="filterStartDate1">
                                                    <input class="form-control" type="date" id="filterEndDate1">
                                                </div>
                                                <div class="col">
                                                    <label class="form-label" for="filterTimeRange1">Filter by Time
                                                        Range:</label>
                                                    <input class="form-control mb-1" type="time"
                                                        id="filterStartTime1">
                                                    <input class="form-control" type="time" id="filterEndTime1">
                                                </div>
                                                <div class="col">
                                                    <button class="btn btn-outline-info" type="button"
                                                        id="applyFilters1">Apply Filters</button>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                             @endif
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- changed content  ends-->
            </main>
            <!-- footer -->
        </div>
        <h3>Dashboaard Home</h3>
    </div>
@endsection

@section('script')
    <!-- DataTables JavaScript -->
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.9/js/buttons.print.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            var filterDateInput = $('#filterDate');
            var filterCategoryInput = $('#filterCategory');
            var filterStartDateInput = $('#filterStartDate');
            var filterEndDateInput = $('#filterEndDate');
            var filterStartTimeInput = $('#filterStartTime');
            var filterEndTimeInput = $('#filterEndTime');
            var tbody = $('#orderDetails tbody');

            var tfoot = $('#totalsale');
            // Initial load
            fetchData();

            // Apply filters button click event
            $('#applyFilters').on('click', function() {
                fetchData(); // Reload data when the Apply Filters button is clicked


            });

            // Function to make an AJAX request and process the data
            function fetchData() {
                // Destroy existing DataTable instance (if it exists)
                if ($.fn.DataTable.isDataTable('#orderDetails')) {
                    $('#orderDetails').DataTable().destroy();
                }
                $.ajax({
                    url: '{{ url('orderdetailsapi') }}',
                    method: 'GET',
                    data: {
                        date: filterDateInput.val(),
                        category: filterCategoryInput.val(),
                        startDate: filterStartDateInput.val(),
                        endDate: filterEndDateInput.val(),
                        startTime: filterStartTimeInput.val(),
                        endTime: filterEndTimeInput.val(),
                    },
                    success: function(data) {
                        // console.log(data);
                        processData(data);

                        // Reset filter input values after processing the data
                        filterDateInput.val('');
                        filterCategoryInput.val('');
                        filterStartDateInput.val('');
                        filterEndDateInput.val('');
                        filterStartTimeInput.val('');
                        filterEndTimeInput.val('');
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });

            }


            // Function to process and display the data
            function processData(data) {
                function getCurrentDate() {
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
                    var yyyy = today.getFullYear();

                    return yyyy + '-' + mm + '-' + dd;
                }
                console.log(getCurrentDate());
                if (
                    filterDateInput.val() == '' &&
                    filterCategoryInput.val() == '' &&
                    filterStartDateInput.val() == '' &&
                    filterEndDateInput.val() == '' &&
                    filterStartTimeInput.val() == '' &&
                    filterEndTimeInput.val() == ''
                ) {
                    var selectedDate = getCurrentDate();
                } else {
                    var selectedDate = filterDateInput.val();
                }


                // Populate the category filter dropdown dynamically
                var uniqueCategories = [...new Set(data.map(order => order.menu.category.name))];
                var categorySelect = $('#filterCategory');




                // categorySelect.empty();
                categorySelect.append('<option value="">All Categories</option>');
                // Add options based on unique categories
                uniqueCategories.forEach(category => {
                    
                    categorySelect.append('<option value="' + category + '">' + category + '</option>');
                });

                // Filter data based on the selected date and additional criteria
                var filteredData = data.filter(function(order) {
                    var orderDate = order.created_at.split('T')[0];

                    // Assuming date format from the API is in 'YYYY-MM-DD'
                    if (selectedDate && orderDate !== selectedDate) {
                        return false;
                    }

                    // Add more conditions for other filters (category, date range, time range)
                    if (filterCategoryInput.val() && order.menu.category.name !== filterCategoryInput
                        .val()) {
                        return false;
                    }

                    // Date range filter
                    if (filterStartDateInput.val() && filterEndDateInput.val()) {
                        var orderDateTime = new Date(order.created_at);
                        var filterStartDate = new Date(filterStartDateInput.val());
                        var filterEndDate = new Date(filterEndDateInput.val());

                        if (orderDateTime < filterStartDate || orderDateTime > filterEndDate) {
                            return false;
                        }
                    }

                    // Time range filter
                    if (filterStartTimeInput.val() && filterEndTimeInput.val()) {
                        var orderTime = order.created_at.split('T')[1].substring(0, 5);
                        var filterStartTime = filterStartTimeInput.val();
                        var filterEndTime = filterEndTimeInput.val();

                        if (orderTime < filterStartTime || orderTime > filterEndTime) {
                            return false;
                        }
                    }

                    return true;

                });

                // Clear existing rows
                tbody.empty();
                tfoot.empty();
                filterCategoryInput.val('');
                // Clear existing options

                // Create an object to store aggregated data based on menu id
                var aggregatedData = {};

                // Iterate through each order in the filtered data
                filteredData.forEach(function(order) {
                    var menuId = order.menu_id;

                    // If menu id is not in aggregatedData, add it; otherwise, update quantity and total
                    if (!aggregatedData[menuId]) {
                        aggregatedData[menuId] = {
                            menuName: order.menu.name,
                            category: order.menu.category.name,
                            date: order.created_at,
                            quantity: order.quantity,
                            total: order.total
                        };
                    } else {
                        aggregatedData[menuId].quantity += order.quantity;
                        aggregatedData[menuId].total += order.total;
                    }
                });

                // ...
                console.log(aggregatedData);
                console.log(data);

                var filterdataArray = $.map(aggregatedData, function(value) {
                    return value;
                });

                console.log(filterdataArray);

                $('#orderDetails').DataTable({
                    data: filterdataArray,
                    columns: [{
                            data: 'menuName'
                        },
                        {
                            data: 'category'
                        },
                        {
                            data: 'quantity'
                        },
                        {
                            data: 'total'
                        },
                        {
                            data: 'date'
                        }
                    ],
                    buttons: [
                        'copy',
                        'excel',
                        'pdf',
                        'print' // Add the 'print' button for printing
                    ]

                });
                var subTotalQuantity = 0;
                var subTotalTotal = 0;

                for (var menuId in aggregatedData) {
                    subTotalQuantity += aggregatedData[menuId].quantity;
                    subTotalTotal += aggregatedData[menuId].total;
                }

                // Append a new row at the bottom with the sub-total
                var subTotalRow = '<div class="sub-total"><span >Total Quantity: </span><span class="me-2">' +
                    subTotalQuantity + 'Pices </span><span>Total Sale: </span><span>' + subTotalTotal +
                    'TK </span></div>';
                tfoot.append(subTotalRow);


            }
        });
        $(document).ready(function() {
            var filterDateInput1 = $('#filterDate1');
            var filterCategoryInput1 = $('#filterCategory1');
            var filterStartDateInput1 = $('#filterStartDate1');
            var filterEndDateInput1 = $('#filterEndDate1');
            var filterStartTimeInput1 = $('#filterStartTime1');
            var filterEndTimeInput1 = $('#filterEndTime1');

            var myChart; // Declare myChart outside the fetchData function

            // Initial load
            fetchData1();

            // Apply filters button click event
            $('#applyFilters1').on('click', function() {
                fetchData1(); // Reload data when the Apply Filters button is clicked


            });

            // Function to make an AJAX request and process the data
            function fetchData1() {

                $.ajax({
                    url: '{{ url('orderdetailsapi') }}',
                    method: 'GET',
                    data: {
                        date: filterDateInput1.val(),
                        category: filterCategoryInput1.val(),
                        startDate: filterStartDateInput1.val(),
                        endDate: filterEndDateInput1.val(),
                        startTime: filterStartTimeInput1.val(),
                        endTime: filterEndTimeInput1.val(),
                    },
                    success: function(data) {
                        // console.log(data);
                        processData1(data);

                        // Reset filter input values after processing the data
                        // filterDateInput1.val('');
                        // filterCategoryInput1.val('');
                        // filterStartDateInput1.val('');
                        // filterEndDateInput1.val('');
                        // filterStartTimeInput1.val('');
                        // filterEndTimeInput1.val('');
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });

            }


            // Function to process and display the data
            function processData1(data) {
                var selectedDate1 = filterDateInput1.val();


                // Populate the category filter dropdown dynamically
                var uniqueCategories1 = [...new Set(data.map(order => order.menu.category.name))];
                var categorySelect1 = $('#filterCategory1');





                // Add options based on unique categories
                uniqueCategories1.forEach(category => {
                    categorySelect1.append('<option value="' + category + '">' + category + '</option>');
                });

                // Filter data based on the selected date and additional criteria
                var filteredData1 = data.filter(function(order) {
                    var orderDate1 = order.created_at.split('T')[0];

                    // Assuming date format from the API is in 'YYYY-MM-DD'
                    if (selectedDate1 && orderDate1 !== selectedDate1) {
                        return false;
                    }

                    // Add more conditions for other filters (category, date range, time range)
                    if (filterCategoryInput1.val() && order.menu.category.name !== filterCategoryInput1
                        .val()) {
                        return false;
                    }

                    // Date range filter
                    if (filterStartDateInput1.val() && filterEndDateInput1.val()) {
                        var orderDateTime1 = new Date(order.created_at);
                        var filterStartDate1 = new Date(filterStartDateInput1.val());
                        var filterEndDate1 = new Date(filterEndDateInput1.val());

                        if (orderDateTime1 < filterStartDate1 || orderDateTime1 > filterEndDate1) {
                            return false;
                        }
                    }

                    // Time range filter
                    if (filterStartTimeInput1.val() && filterEndTimeInput1.val()) {
                        var orderTime1 = order.created_at.split('T')[1].substring(0, 5);
                        var filterStartTime1 = filterStartTimeInput1.val();
                        var filterEndTime1 = filterEndTimeInput1.val();

                        if (orderTime1 < filterStartTime1 || orderTime1 > filterEndTime1) {
                            return false;
                        }
                    }

                    return true;

                });



                // Create an object to store aggregated data based on menu id
                var aggregatedData1 = {};

                // Iterate through each order in the filtered data
                filteredData1.forEach(function(order) {
                    var menuId1 = order.menu_id;

                    // If menu id is not in aggregatedData, add it; otherwise, update quantity and total
                    if (!aggregatedData1[menuId1]) {
                        aggregatedData1[menuId1] = {
                            menuName1: order.menu.name,
                            category1: order.menu.category.name,
                            date1: order.created_at,
                            quantity1: order.quantity,
                            total1: order.total
                        };
                    } else {
                        aggregatedData1[menuId1].quantity1 += order.quantity;
                        aggregatedData1[menuId1].total1 += order.total;
                    }
                });

                // ...




                // Convert aggregated data to arrays for Chart.js
                var labels = [];
                var quantities = [];

                for (var menuId1 in aggregatedData1) {
                    labels.push(aggregatedData1[menuId1].menuName1);
                    quantities.push(aggregatedData1[menuId1].quantity1);
                }

                // Destroy the existing chart instance (if it exists)
                if (myChart) {
                    myChart.destroy();
                }

                // Create a bar chart using Chart.js
                var ctx = document.getElementById('myChart').getContext('2d');
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Quantity Sold',
                            data: quantities,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: .5
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            }


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
        });
    </script>
@endsection

