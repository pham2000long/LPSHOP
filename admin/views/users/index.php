<?php
require_once 'helpers/Helper.php';
?>
    <!--form search-->
    <form action="" method="GET">
        <div class="form-group">
            <label for="username">Nhập Username</label>
            <input type="text" name="username" value="<?php echo isset($_GET['username']) ? $_GET['username'] : '' ?>" id="username"
                   class="form-control"/>
        </div>
        <input type="hidden" name="controller" value="user"/>
        <input type="hidden" name="action" value="index"/>
        <input type="submit" name="search" value="Tìm kiếm" class="btn btn-primary"/>
        <a href="index.php?controller=user" class="btn btn-default">Xóa filter</a>
    </form>

<h2>Danh sách user</h2>
<a href="index.php?controller=user&action=create" class="btn btn-success">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Avatar</th>
        <th>Status</th>
        <th>Permission</th>
        <th>created_at</th>
        <th></th>
    </tr>
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id'] ?></td>
                <td><?php echo $user['username'] ?></td>
                <td><?php echo $user['first_name'];
                            echo " ";
                            echo $user['last_name'] ?></td>
                <td><?php echo $user['phone'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td>
                    <?php if (!empty($user['avatar'])): ?>
                        <img height="80" src="assets/uploads/<?php echo $user['avatar'] ?>"/>
                    <?php endif; ?>
                </td>
                <td><?php
                    if($user['status'] == 0)
                        echo 'Disabled';
                    else if($user['status'] == 1)
                        echo 'Active';
                    ?></td>
                <td><?php
                        if($user['roles'] == 1)
                            echo 'Admin';
                        else if($user['roles'] == 2)
                            echo 'Editor';
                        else if($user['roles'] == 3)
                            echo 'Sale';
                        else
                            echo 'User';
                    ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($user['created_at'])) ?></td>
                <td>
                    <?php
                    $url_detail = "index.php?controller=user&action=detail&id=" . $user['id'];
                    $url_update = "index.php?controller=user&action=update&id=" . $user['id'];
                    $url_delete = "index.php?controller=user&action=delete&id=" . $user['id'];
                    ?>
                    <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                    <a title="Update" href="<?php echo $url_update ?>"><i class="fa fa-pencil-alt"></i></a> &nbsp;&nbsp;
                    <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Are you sure delete?')"><i
                                class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>

    <?php else: ?>
        <tr>
            <td colspan="11">No data found</td>
        </tr>
    <?php endif; ?>
</table>
<?php echo $pages; ?>