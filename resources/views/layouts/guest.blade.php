<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset(config('app.logo_path')) }}" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('build/assets/app-0a6881da.css') }}">
    <script src="{{ asset('build/assets/app-7c0572f8.js') }}"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                <x-application-logo class="h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="w-full  sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Information',
                text: '{{ session('success') }}',
                // icon: 'success',
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
            });
        </script>
    @endif
    @if (session('customer'))
        <script>
            Swal.fire({
                title: 'Customer Information',
                text: 'There were some errors with your form.',
                html: `
                <div class = "text-red-500" >
                    <p> Name: {{ session('customer.user.name') }}</p>
                    <p> Email: {{ session('customer.user.email') }}</p>
                    <p> Consumed Meal: {{ session('customer.consumed_meal') }}</p>
                    <p>Meal Validity: {{ session('customer.valid_date') }}</p>
                    </div>
                    `,
            });
        </script>
    @endif
    @if (session('staff'))
        <script>
            Swal.fire({
                title: 'Customer Information',
                text: 'There were some errors with your form.',
                html: `
                <div class = "text-red-500" >
                    <p> Name: {{ session('staff.name') }}</p>
                    <p> ID: {{ session('staff.employeeId') }}</p>
                    <p> Total Order: {{ session('staff.total_order') }}</p>
                    <p> Points: {{ session('staff.total_point') }}</p>
                    </div>
                    `,
            });
        </script>
    @endif
</body>

</html>
