@extends('layouts.main')

@section('title')
    Admins - Admin Panel
@endsection

@section('css')
@endsection

@section('content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="#">Admins</a></li> --}}
                        <li class="breadcrumb-item nav-link"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Admins</li>
                    </ol>
                </nav>

            </div>
            <div class="col-sm-6 clearfix">
            </div>
        </div>
    </div>
    <!-- page title area end -->

    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="bg-white rounded-4 p-4 shadow-lg">
                    <div class="card-body">
                        <h4 class="header-title float-start">Admins List</h4>
                        <p class="float-end mb-2">
                            @if (Auth::guard('web')->user()->can('admins.edit'))
                                <a class="btn btn-primary" href="{{ route('admins.create') }}">Create New Admin</a>
                            @endif
                        </p>
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            <table id="dataTable" class="table text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="5%">Sl</th>
                                        <th width="10%">Name</th>
                                        <th width="10%">Email</th>
                                        <th width="40%">Roles</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>
                                                @foreach ($admin->roles as $role)
                                                    <span class="badge bg-primary me-1">
                                                        {{ $role->name }}
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a class="btn btn-success"
                                                    href="{{ route('admins.edit', $admin->id) }}">Edit</a>
                                                @if (Auth::guard('web')->user()->can('admins.edit'))
                                                @endif

                                                @if (Auth::guard('web')->user()->can('admins.destroy'))
                                                    <a class="btn btn-danger"
                                                        href="{{ route('admins.destroy', $admin->id) }}"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $admin->id }}').submit();">
                                                        Delete
                                                    </a>
                                                    <form id="delete-form-{{ $admin->id }}"
                                                        action="{{ route('admins.destroy', $admin->id) }}" method="POST"
                                                        style="display: none;">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                @endif
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
@endsection
