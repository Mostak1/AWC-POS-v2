@extends('layouts.main')

@section('title')
    Role Edit - Admin Panel
@endsection

@section('css')
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
                    <h4 class="page-title pull-left">Role Edit - {{ $role->name }}</h4>

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
                        <h4 class="header-title">Edit Role</h4>

                        <form action="{{ route('roles.update', $role->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input type="text" class="form-control" id="name" value="{{ $role->name }}"
                                    name="name" placeholder="Enter a Role Name">
                            </div>

                            <div class="form-group">
                                <label for="name">Permissions</label>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1"
                                        {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="checkPermissionAll">All</label>
                                </div>
                                <hr>
                                @php $i = 1; @endphp
                                @foreach ($permission_groups as $group)
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $i }}"
                                                aria-expanded="false" aria-controls="flush-collapse{{ $i }}">
                                                {{ $group->name }}
                                            </button>
                                        </h2>
                                        <div id="flush-collapse{{ $i }}" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    @php
                                                        $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                                        $j = 1;
                                                    @endphp
            
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="{{ $i }}Management" value="{{ $group->name }}"
                                                                onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)"
                                                                {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="checkPermission">{{ $group->name }}</label>
                                                        </div>
                                                    </div>
            
                                                    <div class="col-9 role-{{ $i }}-management-checkbox">
            
                                                        @foreach ($permissions as $permission)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})"
                                                                    name="permissions[]"
                                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                                    id="checkPermission{{ $permission->id }}"
                                                                    value="{{ $permission->name }}">
                                                                <label class="form-check-label"
                                                                    for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                            </div>
                                                            @php  $j++; @endphp
                                                        @endforeach
                                                        <br>
                                                    </div>
            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                               
                                    
                                    @php  $i++; @endphp
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Role</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection


@section('script')
    @include('roles.partials.scripts')
@endsection
