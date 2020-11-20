<div class="">
    <div class="custom-tab tab-profile">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
            <li class="nav-item">
                <a class="nav-link active pb-3 pt-0"  href="index.php?controller=profile&action=index" role="tab"><i class="fas fa-cog mr-2"></i>Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  pb-3 pt-0" href="index.php?controller=profile&action=changePassword" role="tab"><i class="fas fa-unlock mr-2"></i>Change password</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content pt-4">
            <div class="tab-pane  active" id="profile" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="">
                                <form class="form-horizontal form-material mb-0" method="post" enctype="multipart/form-data" action="">
                                    <div class="form-group col-md-3">
                                        <input type="file" id="input-file-now-custom-1" class="dropify" data-default-file="assets/uploads/<?php echo $user['avatar'] ?>" name="avatar"/>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="first_name">First Name</label>
                                            <input type="text" placeholder="First Name" class="form-control" name="first_name" id="first_name"
                                                   value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : $user['first_name'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" placeholder="Last Name" class="form-control" name="last_name" id="last_name"
                                                   value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : $user['last_name'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" placeholder="Email" name="email" class="form-control" id="email"
                                                   value="<?php echo isset($_POST['email']) ? $_POST['email'] : $user['email'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" placeholder="Phone Number" class="form-control" id="phone" name="phone"
                                                   value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $user['phone'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="address">Address</label>
                                            <input type="text" placeholder="Address" id="address" name="address" class="form-control"
                                                   value="<?php echo isset($_POST['address']) ? $_POST['address'] : $user['address'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="jobs">Jobs</label>
                                            <input type="text" name="jobs" id="jobs"
                                                   value="<?php echo isset($_POST['jobs']) ? $_POST['jobs'] : $user['jobs'] ?>"
                                                   class="form-control"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input class="btn btn-primary btn-sm text-light px-4 mt-3 float-right mb-0" name="submit" type="submit" value="Update profile"></input>
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


