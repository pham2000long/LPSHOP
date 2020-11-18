<h2>Cập nhật trạng thái đơn hàng</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="statuss">Trạng thái</label>
        <select name="status" class="form-control" id="statuss">
            <?php
            $selected_disabled = '';
            $selected_active = '';
            if ($orders['status'] == 0) {
                $selected_disabled = 'selected';
            } else {
                $selected_active = 'selected';
            }
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
            <option value="0" <?php echo $selected_disabled; ?>>Chưa thanh toán</option>
            <option value="1" <?php echo $selected_active ?>>Đã thanh toán</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-primary"/>
        <a href="index.php?controller=order&action=index" class="btn btn-secondary">Back</a>
    </div>
</form>