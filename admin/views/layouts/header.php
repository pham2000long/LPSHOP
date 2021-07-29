<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.png" alt="" height="22">
                                </span>
                    <span class="logo-lg">
                                    <img src="assets/images/logo.png" alt="" height="17">
                                </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?php
                    if (isset($_SESSION['user']['avatar'])){
                        echo "../admin/assets/uploads/". $_SESSION['user']['avatar'];
                    }else {
                        echo "../admin/assets/images/user.jpg";
                    }
                    ?>"
                         alt="Header Avatar" >
                    <span class="d-none d-xl-inline-block ml-1"><?php echo $_SESSION['user']['first_name']. " " .$_SESSION['user']['last_name'];?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="index.php?controller=profile&action=index"><i class="dripicons-user d-inlne-block text-muted mr-2"></i> Profile</a>
                    <a class="dropdown-item" href="index.php?controller=profile&action=changePassword"><i class="dripicons-lock d-inlne-block text-muted mr-2"></i> Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?controller=profile&action=logout"><i class="dripicons-exit d-inlne-block text-muted mr-2"></i>Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>

<!-- ==========Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!--  Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Dashboard</li>
                <li>
                    <a href="index.php?controller=category&action=index">
                        <i class="fa fa-th-large"></i>
                        <span class="nav-label">Quản lý danh mục</span> </a>
                </li>
                <li>
                    <a href="index.php?controller=product&action=index">
                        <i class="fa fa-code"></i> <span class="nav-label">Quản lý sản phẩm</span> </a>
                </li>
                <li>
                    <a href="index.php?controller=news&action=index">
                        <i class="fa fa-book"></i> <span class="nav-label">Quản lý tin tức</span> </a>
                </li>
                <li>

                    <a href="index.php?controller=order&action=index">
                        <i class="fa fa-shopping-cart"></i> <span class="nav-label">Orders</span> </a>
                </li>
                <li>
                    <a href="index.php?controller=user&action=index">
                        <i class="fa fa-users"></i> <span class="nav-label">Users</span> </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!--Sidebar End -->

