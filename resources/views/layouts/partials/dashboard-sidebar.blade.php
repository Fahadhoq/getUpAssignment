        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="waves-effect">
                                <i class="icon-accelerator"></i><span class="badge badge-success badge-pill float-right">9+</span> <span> Dashboard </span>
                            </a>
                        </li>

                        
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> ROLE <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('roles.index') }}"> {{ __('Show All Roles') }}</a></li>
                                <li><a href="{{ route('role.assign') }}"> {{ __('Assign Role') }}</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> USER <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('users.index') }}"> {{ __('Show All Users') }}</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> PRODUCT <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('products.index') }}"> {{ __('Show All Products') }}</a></li>
                    
                                  <li><a href="{{ route('product.create') }}"> {{ __('Create') }}</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> CUSTOMER <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('customers.index') }}"> {{ __('Show All Sustomers') }}</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> ORDER <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('orders.index') }}"> {{ __('Show All Orders') }}</a></li>
                            </ul>
                        </li>

                        
                        <!-- <li class="menu-title">Components</li> -->

                        <!-- <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-pencil-ruler"></i> <span> UI Elements <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="ui-alerts.html">Alerts</a></li>
                                <li><a href="ui-badge.html">Badge</a></li>
                                <li><a href="ui-buttons.html">Buttons</a></li>
                                <li><a href="ui-grid.html">Grid</a></li>
                            </ul>
                        </li> -->

                        
                        <!-- <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-share"></i><span> Multi Level <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="javascript:void(0);"> Menu 1</a></li>
                                <li>
                                    <a href="javascript:void(0);">Menu 2  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                                    <ul class="submenu">
                                        <li><a href="javascript:void(0);">Menu 2.1</a></li>
                                        <li><a href="javascript:void(0);">Menu 2.1</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li> -->

                    </ul>

                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->