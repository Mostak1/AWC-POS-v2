@extends('layouts.main')

@section('title')
Role Page - Admin Panel
@endsection

@section('css')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@endsection

@section('content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-start">Roles</h4>
                    <ul class="breadcrumbs pull-start">
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><span>All Roles</span></li>
                    </ul>
                </div>
            </div>
          
        </div>
    </div>
    <!-- page title area end -->

    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title float-start">Roles List</h4>
                        <p class="float-end mb-2">
                            @if (Auth::guard('web')->user()->can('roles.create'))
                                <a class="btn btn-primary text-white" href="{{ route('roles.create') }}">Create New Role</a>
                            @endif
                        </p>
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            {{-- @include('backend.layouts.partials.messages') --}}
                            <table id="dataTable3" class="table">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="5%">Sl</th>
                                        <th width="10%">Name</th>
                                        <th width="60%">Permissions</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @foreach ($role->permissions as $perm)
                                                    <span class="badge text-bg-info">
                                                        {{ $perm->name }}
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="skip d-flex justify-content-center">

                                                    @if (Auth::guard('web')->user()->can('roles.edit'))
                                                        <a class="btn btn-success" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                                    @endif
    
                                                    @if (Auth::guard('web')->user()->can('roles.destroy'))
                                                        <a class="btn btn-danger " href="{{ route('roles.destroy', $role->id) }}"
                                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();">
                                                            Delete
                                                        </a>
    
                                                        <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
                                                            @method('DELETE')
                                                            @csrf
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->
        </div>
    </div>
@endsection

@section('script')
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

    <script>
        /*================================
        datatable active
        ==================================*/
        if ($('#dataTable3').length) {
            $('#dataTable3').DataTable({
                responsive: true
            });
        }
    </script>
@endsection
