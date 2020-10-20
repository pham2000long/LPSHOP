<?php
?>
<div class="">
    <div class="custom-tab tab-profile">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
            <li class="nav-item">
                <a class="nav-link active pb-3 pt-0" data-toggle="tab" href="#profile" role="tab"><i class="fas fa-cog mr-2"></i>Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pb-3 pt-0" data-toggle="tab" href="#changepassword" role="tab"><i class="fas fa-unlock mr-2"></i>Change password</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content pt-4">
            <div class="tab-pane  active" id="profile" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="">
                                <form class="form-horizontal form-material mb-0" method="post" enctype="multipart/form-data">
                                    <div class="form-group col-md-3">
                                        <input type="file" id="input-file-now-custom-1" class="dropify" data-default-file="assets/images/users/user-3.jpg"/>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="first_name">First Name</label>
                                            <input type="text" placeholder="First Name" class="form-control" name="first_name" id="first_name" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" placeholder="Last Name" class="form-control" name="last_name" id="last_name" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" placeholder="Email" name="email" class="form-control" id="email" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" placeholder="Phone Number" class="form-control" id="phone" name="phone" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="address">Address</label>
                                            <input type="text" placeholder="Address" id="address" name="address" class="form-control" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="job">Jobs</label>
                                            <input type="text" placeholder="Jobs" id="job" name="job" class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm text-light px-4 mt-3 float-right mb-0" name="submit">Update Profile</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="changepassword" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="">
                                <form class="form-horizontal form-material mb-0" method="post" enctype="multipart/form-data">

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="password">Mật khẩu hiện tại</label>
                                            <input type="text" placeholder="Mật khẩu hiện tại" class="form-control" name="first_name" id="first_name" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="new_password">Mật khẩu mới</label>
                                            <input type="text" placeholder="Mật khẩu mới" id="new_password" name="new_password" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="password_confirm">Xác nhận mật khẩu mới</label>
                                            <input type="text" placeholder="Xác nhận mật khẩu" id="password_confirm" name="password_confirm" class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm text-light px-4 mt-3 float-right mb-0" name="submit">Change password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


