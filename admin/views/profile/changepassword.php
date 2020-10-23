<?php
?>
<div class="">
    <div class="custom-tab tab-profile">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
            <li class="nav-item">
                <a class="nav-link pb-3 pt-0"  href="index.php?controller=profile&action=index" role="tab"><i class="fas fa-cog mr-2"></i>Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active pb-3 pt-0"  href="index.php?controller=profile&action=changepassword" role="tab"><i class="fas fa-unlock mr-2"></i>Change password</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content pt-4">
            <div class="tab-pane active" id="changepassword" >
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="">
                                <form class="form-horizontal form-material mb-0" method="post" enctype="multipart/form-data">

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="password">Mật khẩu hiện tại</label>
                                            <input type="password" placeholder="Mật khẩu hiện tại" class="form-control" name="password" id="password" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="new_password">Mật khẩu mới</label>
                                            <input type="password" placeholder="Mật khẩu mới" id="new_password" name="new_password" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="password_confirm">Xác nhận mật khẩu mới</label>
                                            <input type="password" placeholder="Xác nhận mật khẩu" id="password_confirm" name="password_confirm" class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input class="btn btn-primary btn-sm text-light px-4 mt-3 float-right mb-0" name="submit" type="submit" value="Change password"></input>
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


