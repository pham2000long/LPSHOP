<?php if (empty($category)): ?>
    <h2>Không tồn tại category</h2>
<?php else: ?>
    <h2>Chỉnh sửa danh mục #<?php echo $category['id'] ?></h2>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tên danh mục</label>
            <input type="text" name="name"
                   value="<?php echo isset($_POST['name']) ? $_POST['name'] : $category['name']; ?>"
                   class="form-control"/>
        </div>
        <div class="form-group">
            <?php
            $selected_product = '';
            $selected_new = '';
            if (isset($_POST['type'])) {
                switch ($_POST['type']) {
                    case 0:
                        $selected_product = 'selected';
                        break;
                    case 1:
                        $selected_new = 'selected';
                        break;
                }
            }
            ?>
            <label>Type</label>
            <select name="type" class="form-control">
                <option value="0" <?php echo $selected_product; ?> >Product</option>
                <option value="1" <?php echo $selected_new; ?> >New</option>
            </select>
        </div>

        <div class="form-group">
            <label>Ảnh đại diện</label>
            <input type="file" id="avatar" class="dropify" data-default-file="assets/uploads/<?php echo $category['avatar'] ?>" name="avatar"/>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea class="form-control" id="elm1"
                      name="description"><?php echo isset($_POST['description']) ? $_POST['description'] : $category['description']; ?></textarea>
        </div>
        <div class="form-group">
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
            <label for="statuss">Trạng thái</label>
            <select name="status" class="form-control" id="statuss">
                <option value="0" <?php echo $selected_active ?> >Disabled</option>
                <option value="1" <?php echo $selected_disabled ?> >Active</option>
            </select>
        </div>

        <input type="submit" class="btn btn-primary" name="submit" value="Save"/>
        <a href="index.php?controller=category&action=index" class="btn btn-secondary">Back</a>
    </form>
<?php endif; ?>