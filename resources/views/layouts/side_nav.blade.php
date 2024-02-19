<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav text-primary-emphasis aw-bg sidebar text-success-emphasis " id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav mt-2 side-nav">
                @php
                    $user = Auth::guard('web')->user();
                @endphp
                <!-- Navbar Brand-->
                <a class="navbar-brand ps-3 fs-1 text-warning" target="" href="{{ url('/') }}"><img width="150px"
                        src="{{ asset(config('app.logo_path')) }}" alt="Logo">
                </a>
                <div class="sb-sidenav-menu-heading clr">Core</div>
                <a class="nav-link" href="{{ url('/') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading clr">Interface</div>


                @if ($user->can('category.index') || $user->can('subcategory.index') || $user->can('tab.index'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Manage Tables
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested  nav">
                            @if ($user->can('category.index'))
                                <a href="{{ url('category') }}" class="nav-link" rel="noopener noreferrer">
                                    <div class="sb-nav-link-icon"><i class="fa-brands fa-mendeley fa-beat-fade"></i>
                                    </div>
                                    Category
                                </a>
                            @endif
                            @if ($user->can('subcategory.index'))
                                <a href="{{ url('subcategory') }}" class="nav-link" rel="noopener noreferrer">
                                    <div class="sb-nav-link-icon"><i class="fa-brands fa-mendeley fa-beat-fade"></i>
                                    </div>
                                    Sub
                                    Category
                                </a>
                            @endif
                            @if ($user->can('tab.index'))
                                <a href="{{ url('tab') }}" class="nav-link" rel="noopener noreferrer">
                                    <div class="sb-nav-link-icon"><i class="fa-brands fa-mendeley fa-beat-fade"></i>
                                    </div>
                                    Table
                                    Set
                                </a>
                            @endif
                        </nav>
                    </div>
                @endif


                @if ($user->can('menus.index'))
                    <a class="nav-link" href="{{ url('menus') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-utensils"></i></div>
                        Food Menu
                    </a>
                @endif
               
                @if ($user->can('customer.index'))
                    <a class="nav-link" href="{{ url('customer') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-martini-glass-citrus"></i></div>
                        Customer Card
                    </a>
                @endif
                @if ($user->can('order'))
                    <a class="nav-link" href="{{ url('order') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-martini-glass-citrus"></i></div>
                        Place Order
                    </a>
                @endif
                @if ($user->can('supplier.index'))
                    <a class="nav-link" href="{{ url('supplier') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-field"></i></div>
                        Supplier
                    </a>
                @endif
                @if ($user->can('material.index'))
                    <a class="nav-link" href="{{ url('material') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Food Material
                    </a>
                @endif


                @if ($user->can('purchase.index'))
                    <a class="nav-link" href="{{ route('purchase.index') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-store"></i></div>
                        Purchase Material
                    </a>
                @endif

                {{-- @endhasanyrole --}}

                <div class="sb-sidenav-menu-heading clr">Report</div>
                {{-- @dd($roles) --}}
                @if ($user->can('users.index'))
                    <a class="nav-link" href="{{ url('users') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Users
                    </a>
                @endif

                @if ($user->can('roles.index'))
                    <a class="nav-link" href="{{ url('admins') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        User Role Set
                    </a>
                @endif
               
                @if ($user->can('roles.index'))
                    <a class="nav-link" href="{{ url('roles') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Permissions Set On Role
                    </a>
                @endif
                @if ($user->can('permissions.index'))
                    <a class="nav-link" href="{{ url('permissions') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Permissions
                    </a>
                @endif
                @if ($user->can('setting.index'))
                    <a class="nav-link" href="{{ url('setting') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Settings
                    </a>
                @endif


                {{-- report --}}
                @if (
                    $user->can('offorder.index') ||
                        $user->can('offorderlog') ||
                        $user->can('menulog') ||
                        $user->can('offorderdaily') ||
                        $user->can('offorderdetails.index') ||
                        $user->can('dailyreport'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Report Manage
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested  nav">
                            @if ($user->can('offorder.index'))
                                <a href="{{ url('offorder') }}" class="nav-link" rel="noopener noreferrer">
                                    <div class="sb-nav-link-icon"><i class="fa-regular fa-flag"></i></div>
                                    Order
                                    History Report
                                </a>
                            @endif
                            @if ($user->can('offorderlog'))
                                <a href="{{ url('offorderlog') }}" class="nav-link" rel="noopener noreferrer">
                                    <div class="sb-nav-link-icon"><i class="fa-regular fa-flag"></i></div>
                                    Order Log
                                    History Report
                                </a>
                            @endif
                            @if ($user->can('menulog'))
                                <a href="{{ url('menulog') }}" class="nav-link" rel="noopener noreferrer">
                                    <div class="sb-nav-link-icon"><i class="fa-regular fa-flag"></i></div>
                                    Menu Log
                                    History Report
                                </a>
                            @endif
                            @if ($user->can('offorderdaily'))
                                <a href="{{ url('offorderdaily') }}" class="nav-link" rel="noopener noreferrer">
                                    <div class="sb-nav-link-icon"><i class="fa-regular fa-flag"></i></div>
                                    Daily Sale Report of Order
                                </a>
                            @endif
                            @if ($user->can('offorderdetails.index'))
                                <a href="{{ url('offorderdetails') }}" class="nav-link" rel="noopener noreferrer">
                                    <div class="sb-nav-link-icon"><i class="fa-regular fa-flag"></i></div>
                                    Order
                                    Details Table
                                </a>
                            @endif
                            @if ($user->can('dailyreport'))
                                <a href="{{ url('dailyreport') }}" class="nav-link" rel="noopener noreferrer">
                                    <div class="sb-nav-link-icon"><i class="fa-regular fa-flag"></i></div>
                                    Daily Sale Report Order Details
                                </a>
                            @endif
                        </nav>
                    </div>
                @endif
                {{-- @endif --}}
            </div>
        </div>
        <div class="sb-sidenav-footer clr">
            <div class="small">Logged in as:</div>

            @if (Auth::check())
                {{ Auth::user()->name }}
            @endif
        </div>
        <div class=" clr">Copyright &copy; <a href="https://mostaksarker.com/" class="nav-link" target="_blank" rel="noopener noreferrer"> Green Kitchen 2023</a></div>
    </nav>
</div>
