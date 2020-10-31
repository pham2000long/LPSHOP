<?php
require_once 'helpers/Helper.php';
?>
    <!--form search-->
    <form action="" method="GET">
        <div class="form-group">
            <label for="title">Nhập title</label>
            <input type="text" name="title" value="<?php echo isset($_GET['title']) ? $_GET['title'] : '' ?>" id="title"
                   class="form-control"/>
        </div>
        <div class="form-group">
            <label for="title">Chọn danh mục</label>
            <select name="category_id" class="form-control">
                <?php foreach ($categories as $category):
                    //giữ trạng thái selected của category sau khi chọn dựa vào
//                tham số category_id trên trình duyệt
                    $selected = '';
                    if (isset($_GET['category_id']) && $category['id'] == $_GET['category_id']) {
                        $selected = 'selected';
                    }
                    ?>
                    <?php if($category['type'] == 1) :?>
                        <option value="<?php echo $category['id'] ?>" <?php echo $selected; ?>>
                            <?php echo $category['name'] ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="hidden" name="controller" value="news"/>
        <input type="hidden" name="action" value="index"/>
        <input type="submit" name="search" value="Tìm kiếm" class="btn btn-primary"/>
        <a href="index.php?controller=news&action=index" class="btn btn-secondary">Xóa filter</a>
    </form>


    <h2>Danh sách sản phẩm</h2>
    <a href="index.php?controller=news&action=create" class="btn btn-success">
        <i class="fa fa-plus"></i> Thêm mới
    </a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Category name</th>
            <th>Title</th>
            <th>Avatar</th>
            <th>Status</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th></th>
        </tr>
        <?php if (!empty($news)): ?>
            <?php foreach ($news as $new): ?>
                <tr>
                    <td><?php echo $new['id'] ?></td>
                    <td><?php echo $new['category_name'] ?></td>
                    <td><?php echo $new['title'] ?></td>
                    <td>
                        <?php if (!empty($new['avatar'])): ?>
                            <img src="assets/uploads/<?php echo $new['avatar'] ?>"  height="80"/>
                        <?php endif; ?>
                    </td>
                    <td><?php echo Helper::getStatusText($new['status']) ?></td>
                    <td><?php echo date('d-m-Y H:i:s', strtotime($new['created_at'])) ?></td>
                    <td><?php echo !empty($new['updated_at']) ? date('d-m-Y H:i:s', strtotime($new['updated_at'])) : '--' ?></td>
                    <td>
                        <?php
                        $url_detail = "index.php?controller=news&action=detail&id=" . $new['id'];
                        $url_update = "index.php?controller=news&action=update&id=" . $new['id'];
                        $url_delete = "index.php?controller=news&action=delete&id=" . $new['id'];
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
                <td colspan="9">No data found</td>
            </tr>
        <?php endif; ?>
    </table>
<?php echo $pages; ?>