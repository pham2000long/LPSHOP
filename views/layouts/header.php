<?php
?>
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="index.php"><img src="assets/img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li ><a href="index.php">Home</a></li>
                        <li><a href="women.html">Women’s</a></li>
                        <li><a href="men.html">Men’s</a></li>
                        <li><a href="danh-sach-san-pham.html">Shop</a></li>
                        <li><a href="news.html">News</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-4">
                <div class="header__right">
                    <div class="header__right__auth">
                        <?php
                            $hidden = '';
                            $block = 'hidden';
                            if(isset($_SESSION['user'])){
                                $hidden = 'hidden';
                                $block = '';
                            }
                        ?>
                        <div class="dropdown d-inline-block " <?php echo $block?>>
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar" style="height: 25px; width: 25px;
                                                        border-radius: 30px;
                                                        max-width: 100%;
                                                        overflow: hidden; display: inline-block;
                                                         vertical-align: middle;">
                                    <img class="rounded-circle header-profile-user" src="<?php
                                    if (isset($_SESSION['user']['avatar'])){
                                        echo "admin/assets/uploads/" . $_SESSION['user']['avatar'];
                                    }else {
                                        echo "admin/assets/images/user.jpg";
                                    }
                                    ?>"
                                         alt="Header Avatar"">
                                </div>

                                <span class="d-none d-xl-inline-block ml-1"><?php echo $_SESSION['user']['first_name']. " " .$_SESSION['user']['last_name'];?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <li><a class="dropdown-item" href="index.php?controller=profile&action=index"><i class="dripicons-user d-inlne-block text-muted mr-2"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=profile&action=changePassword"><i class="dripicons-lock d-inlne-block text-muted mr-2"></i> Change Password</a></li>
                                <div class="divider"></div>
                                <li><a class="dropdown-item" href="index.php?controller=profile&action=logout"><i class="dripicons-exit d-inlne-block text-muted mr-2"></i>Logout</a></li>
                            </div>
                        </div>
                        <a href="login.html" <?php echo $hidden; ?>>Login</a>
                        <a href="register.html" <?php echo $hidden; ?>>Register</a>
                    </div>
                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        <li><a href="gio-hang-cua-ban.html"><span class="icon_bag_alt "></span>
                                <?php
                                $cart_total = 0;
                                if (isset($_SESSION['cart'])) {
                                    foreach ($_SESSION['cart'] AS $cart) {
                                        $cart_total += $cart['quantity'];
                                    }
                                }
                                ?>
                                <div class="cart-amount tip"><?php echo $cart_total; ?></div>
                            </a></li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<div class="ajax-message"></div>

