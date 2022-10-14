<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{asset ('img/logo.jpg')}}" alt="Library Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SHOPPING PORTAL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{--<div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
            {{--<div class="image">--}}
                {{--<img src="{{asset ('img/avatar2.png')}}" class="img-circle elevation-2" alt="User Image">--}}
            {{--</div>--}}
            {{--<div class="info">--}}
                {{--<a href="#" class="d-block">{{ Auth::user()->name }}</a>--}}
            {{--</div>--}}
        {{--</div>--}}



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-cog"></i>
                        <p>
                            Account Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/api/users')}}" class="nav-link {{ Request::is('users') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Admin Users</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/api/getAllRoles')}}" class="nav-link {{ Request::is('getAllRoles') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                        </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-fw fa-user"></i>
                        <p>
                            Customers
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/api/customers')}}" class="nav-link {{ Request::is('/api/customers') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>profile</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cart-arrow-down"></i>
                        <p>
                            Stores
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/api/getStores')}}" class="nav-link {{ Request::is('/api/getStores') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stores Profile</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-fw fa-home"></i>
                        <p>
                            Warehouses
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/api/getWarehouses')}}" class="nav-link {{ Request::is('/api/getWarehouses') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Warehouses Profile</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/api/getWarehouseCategories')}}" class="nav-link {{ Request::is('/api/getWarehouseCategories') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Warehouses Categories</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!--<li class="nav-header">LABELS</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Important</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p>Warning</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Informational</p>
                    </a>
                </li>-->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>