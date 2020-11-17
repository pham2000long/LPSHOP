    <div class="card mb-0 shadow-none">
        <div class="card-body">

            <h3 class="text-center m-0">
                <a href="#" class="logo logo-admin"><img src="assets/images/logo-sm.png" height="60" alt="logo" class="my-3"></a>
            </h3>

            <div class="px-2 mt-2">
                <h4 class="text-muted font-size-18 mb-2 text-center">Welcome Back !</h4>
                <p class="text-muted text-center">Sign in to Admin to LPShop.</p>

                <form class="form-horizontal my-4" action="" method="post">

                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="userpassword">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password">
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="index.php?controller=login&action=forgotpw" class="text-muted font-13"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                        </div>
                    </div>

                    <div class="form-group mb-0 row">
                        <div class="col-12 mt-2">
                            <button class="btn btn-primary btn-block waves-effect waves-light" name="submit" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="m-2 text-center bg-light p-4 text-primary">
                <h4 class="">Don't have an account ? </h4>
                <p class="font-size-13">Join <span>LP Shop</span> Now</p>
                <a href="index.php?controller=login&action=register" class="btn btn-primary waves-effect waves-light">Free Register</a>
            </div>
            <div class="mt-4 text-center">
                <p class="mb-0">© 2018-2020 LP Shop</p>
            </div>
        </div>
    </div>