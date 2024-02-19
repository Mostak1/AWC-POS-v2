<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($message = Session::get('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ $message }}',
        });
    </script>
@endif
{{-- @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif --}}

@if ($message = Session::get('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Opps! !',
        text: '{{ $message }}',
    });
</script>
    {{-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> --}}
@endif
@if ($message = Session::get('warning'))
<script>
    Swal.fire({
        icon: 'warning',
        title: 'Warning!',
        text: '{{ $message }}',
    });
</script>
    {{-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> --}}
@endif
@if ($message = Session::get('info'))
<script>
    Swal.fire({
        icon: 'warning',
        title: 'Please Wait!',
        text: '{{ $message }}',
    });
</script>
    {{-- <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> --}}
@endif
{{-- For Laravel Controller Validation --}}
@if ($errors->any())
    <script>
        Swal.fire({
            title: 'Oops!',
            text: 'There were some errors with your form.',
            html: '@foreach ($errors->all() as $error) <div class="alert alert-danger">{{ $error }}</div>@endforeach',
        });
    </script>
@endif
@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-success" role="alert">
                <i class="fa fa-check"></i>
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert alert-success" role="alert">
            <i class="fa fa-check"></i>
            {{ $data }}
        </div>
    @endif
@endif
