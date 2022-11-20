<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a href="">
                <img class="img-fluid" src="upload/admin/logo.png" alt="Theme-Logo" />
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu icon-toggle-right"></i>
            </a>
            <a class="mobile-options waves-effect waves-light">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <ul class="nav-right">
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        @if (Auth::check())
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="upload/admin/avatar.jpg" class="img-radius" alt="User-Profile-Image">
                            <span> {{ Auth::user()->name }}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu"
                            data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <a href="admin/logout">
                                    <i class="feather icon-log-out"></i> Logout
                                </a>
                            </li>
                        </ul> 
                        @else
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="upload/avatar/avatar.jpg" class="img-radius" alt="User-Profile-Image">
                            <span>USER</span>                        
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <a href="admin/logout">
                                    <i class="feather icon-log-out"></i> Logout
                                </a>
                            </li>
                        </ul>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>