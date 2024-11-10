<!-- Top Bar Start -->
<div class="topbar">

<!-- LOGO -->
<div class="topbar-left">
    <a href="index.html" class="logo">
        <span class="logo-light">
                <i class="mdi mdi-camera-control"></i> {{ config('app.name') }}
            </span>
        <span class="logo-sm">
                <i class="mdi mdi-camera-control"></i>
            </span>
    </a>
</div>

<nav class="navbar-custom">
    <ul class="navbar-right list-inline float-right mb-0">

        <!-- full screen -->
        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
            <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                <i class="mdi mdi-arrow-expand-all noti-icon"></i>
            </a>
        </li>
        <!-- full screen end-->
        
        <li class="dropdown notification-list list-inline-item">
            <div class="dropdown notification-list nav-pro-img">
                
                <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3  border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                {{ Auth::user()->name }}
                            </button>
                        </span>
                </a>
                
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="mdi mdi-account-circle"></i> Profile</a>
                    <div class="dropdown-divider"></div>

                 <!-- Authentication -->
                 <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();"><i class="mdi mdi-power text-danger"></i> Logout</a>

                 </form>
                 <div class="dropdown-divider"></div> 
                 
                </div>
            </div>
        </li>

    </ul>

    <ul class="list-inline menu-left mb-0">
        <li class="float-left">
            <button class="button-menu-mobile open-left waves-effect">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>
        <li class="d-none d-md-inline-block">
            <form role="search" class="app-search">
                <div class="form-group mb-0">
                    <input type="text" class="form-control" placeholder="Search..">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </li>
    </ul>

</nav>

</div>
<!-- Top Bar End -->