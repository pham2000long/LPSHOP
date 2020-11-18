<h2>Cập nhật user</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username <span class="red">*</span></label>
        <input type="text" name="username" id="username"
               value="<?php echo isset($_POST['username']) ? $_POST['username'] : $user['username'] ?>" disabled
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="first_name">First_name</label>
        <input type="text" name="first_name" id="first_name"
               value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : $user['first_name'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="last_name">Last_name</label>
        <input type="text" name="last_name" id="last_name"
               value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : $user['last_name'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone"
               value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $user['phone'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email"
               value="<?php echo isset($_POST['email']) ? $_POST['email'] : $user['email'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="address" id="address"
               value="<?php echo isset($_POST['address']) ? $_POST['address'] : $user['address'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="avatar">Avatar</label>
        <input type="file" id="avatar" class="dropify" data-default-file="assets/uploads/<?php echo $user['avatar'] ?>" name="avatar"/>
    </div>
    <div class="form-group">
        <label for="jobs">Jobs</label>
        <input type="text" name="jobs" id="jobs"
               value="<?php echo isset($_POST['jobs']) ? $_POST['jobs'] : $user['jobs'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="facebook">Facebook</label>
        <input type="text" name="facebook" id="facebook"
               value="<?php echo isset($_POST['facebook']) ? $_POST['facebook'] : $user['facebook'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="status">Trạng thái</label>
        <select name="status" class="form-control">
            <?php
            $selected_active = '';
            $selected_disabled = '';
            if (isset($_POST['status'])) {
                switch ($_POST['status']) {
                    case 0:
                        $selected_disabled = 'selected';
                        break;
                    case 1:
                        $selected_active = 'selected';
                        break;
                }
            }
            ?>
            <option value="0" <?php echo $selected_disabled; ?>>Disabled</option>
            <option value="1" <?php echo $selected_active; ?>>Active</option>
        </select>
    </div>
    <div class="form-group">
        <label for="roles">Permission</label>
        <select name="roles" class="form-control">
            <?php
            $selected_user = '';
            $selected_admin = '';
            $selected_editor = '';
            $selected_sale = '';
            if (isset($_POST['roles'])) {
                switch ($_POST['roles']) {
                    case 0:
                        $selected_user = 'selected';
                        break;
                    case 1:
                        $selected_admin = 'selected';
                        break;
                    case 2:
                        $selected_editor = 'selected';
                        break;
                    case 3:
                        $selected_sale = 'selected';
                        break;
                }
            }
            ?>
            <option value="0" <?php echo $selected_user; ?>>User</option>
            <option value="1" <?php echo $selected_admin; ?>>Admin</option>
            <option value="2" <?php echo $selected_editor; ?>>Editor</option>
            <option value="3" <?php echo $selected_sale; ?>>Sale</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-primary"/>
        <buton class="btn btn-secondary"><a href="index.php?controller=user&action=index" >Back</a></buton>
    </div>
</form>