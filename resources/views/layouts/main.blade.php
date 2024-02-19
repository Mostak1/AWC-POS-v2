<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title', 'Green Kitchen Admin')</title>
    <link rel="icon" href="{{ asset(config('app.logo_path')) }}" type="image/png">
    {{-- CSRF --}}
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>" id="token">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <!-- DataTable CSS -->
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.5/b-2.4.0/b-html5-2.4.0/b-print-2.4.0/r-2.5.0/datatables.min.css"
        rel="stylesheet" />
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    {{-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- wao js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"
        integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- animate c --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    {{-- select2 cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    

    <link rel="stylesheet" href="{{ asset('assets/css/admin_style.css') }}">
    {{-- @vite(['resources/scss/home.scss']) --}}
    @yield('css')
</head>

<body>
    <div id="preloader"></div>
    <div id="layoutSidenav">
        @include('layouts.side_nav')
        <div id="layoutSidenav_content">
            @include('layouts.top_nav')
            <main>
                <div class="container-fluid mt-5 px-4">
                    @include('layouts.flash')
                    <!-- dynamic content start -->
                    @yield('content')
                    <!-- dynamic content end -->
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        {{-- <div class="text-muted">Copyright &copy; Test BD 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div> --}}
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <!-- DataTable JS -->
    <script src="{{ asset('DataTables/datatables.js')}}"></script>
    <!-- DataTable JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- select2 cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="X-CSRF-TOKEN"]').attr('content')
            }
        });
    </script>

    <script>
        // category , subcategory, topic auto complete code 
        $(document).ready(function() {

            //   alert('Please enter');
            // =========
            // for subcats as cats
            function selectscat(ob) {
                $("#subcategory_id").empty().append('<option value = "0">All');

                let html = "<option value='0'>All</option>";
                for (const key in ob) {
                    if (Object.hasOwnProperty.call(ob, key)) {
                        html += "<option value='" + key + "'>" + ob[key] + "</option>";
                    }
                }
                $("#subcategory_id").html(html);
            }
            $("#category_id").change(function() {
                console.log($(this).val())
                let URL = "{{ url('subcats') }}";
                $.ajax({
                    type: "get",
                    url: URL + '/' + $(this).val(),
                    data: "data",
                    dataType: "json",
                    success: function(response) {
                        selectscat(response);
                    }
                });
            });

            // for topics as subcats

        });

        // datatable for all tables common coad with ID
        $(document).ready(function() {
            
            var table = $('#dataTable').DataTable();
            
            new $.fn.dataTable.Buttons(table, {
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });
            table.buttons().container().appendTo($('.tablebtn', table.table().container()));
            $('.tablebtn .dt-buttons').removeClass('flex-wrap');
            $('.tablebtn .btn').removeClass('btn-secondary').addClass('btn-outline-info mx-auto');
            
        });
            // datatable for all tables common coad with Class

        $(document).ready(function() {

            var table = $('.dataTable').DataTable();

            new $.fn.dataTable.Buttons(table, {
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });
            table.buttons().container().appendTo($('.tablebtn', table.table().container()));
            $('.tablebtn .dt-buttons').removeClass('flex-wrap');
            $('.tablebtn .btn').removeClass('btn-secondary').addClass('btn-outline-info mx-auto');

        });
    </script>
    <!-- dynamic content start-->
    @yield('script')
    <!--dynamic content end -->
</body>

</html>
