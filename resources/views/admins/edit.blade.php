@extends('layouts.main')

@section('title')
    Admin Edit - Admin Panel
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
@endsection

@section('content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Admin Edit</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admins.index') }}">All Admins</a></li>
                        <li><span>Edit Admin - {{ $admin->name }}</span></li>
                    </ul>
                </div>
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Edit Admin - {{ $admin->name }}</h4>

                        <form action="{{ route('admins.update', $admin->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="name">Admin Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Name" value="{{ $admin->name }}">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="email">Admin Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Enter Email" value="{{ $admin->email }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter Password">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="form-check">
                                {{-- <input type="checkbox" class="form-check-input" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox',
                                 '{{ $i }}Management', {{ count($permissions) }})" name="permissions[]" 
                                 {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label> --}}
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="password">Assign Roles</label>
                                        @foreach ($roles as $role)
                                          
                                            <input type="checkbox" class="form-check-input" name="roles[]" {{ $admin->hasRole($role->name) ? 'checked' : '' }}
                                                id="checkPermission{{ $role->id }}" value="{{ $role->name }}">
                                            <label class="form-check-label"
                                                for="checkPermission{{ $role->id }}">{{ $role->name }}</label>
                                        @endforeach
                                    
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="username">Admin Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Enter Username" required value="{{ $admin->username }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Admin</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->

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
@endsection
