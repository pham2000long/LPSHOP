<?php
require_once 'Helpers/Helper.php';
// Hiển thị danh mục sản phẩm kết hợp chức năng lọc theo danh mục và theo khoảng giá
/*
 * + Bên trai: phân lọc
 * + Bên phải: danh sách sản phẩm
 *
 * */
?>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-12">
<!--    Phần lọc-->
<!--            Nếu dùng Rewrite url tì nên để method post-->
            <form action="" method="post">
                <h3>Filter</h3>
                <div class="checkbox-category">
                    <h5>Lọc theo danh mục</h5>
                    <?php foreach ($categories AS $category):
                        // Xử lí dữ liệu checkbox đã tích cho danh mục khi filter
                        $checked = '';
                    if(isset($_POST['categories'])){
                        if(in_array($category['id'], $_POST['categories'])){
                            $checked = 'checked';
                        }
                    }
                        ?>
                        <input <?php echo $checked ?> type="checkbox" name="categories[]" value="<?php echo $category['id']; ?>">
                    <?php echo $category['name'];?>
                    <br/>
                    <?php endforeach;?>
                </div>
                <div class="checkbox-price">
                    <h5>Lọc theo giá</h5>
                    <?php
                        $checked_1 = '';
                        $checked_2 = '';
                        $checked_3 = '';
                        $checked_4 = '';
                        if(isset($_POST['prices'])){
                            if(in_array(0, $_POST['prices'])){
                                $checked_1 = 'checked';
                            }
                        }
                    if(isset($_POST['prices'])){
                        if(in_array(1, $_POST['prices'])){
                            $checked_2 = 'checked';
                        }
                    }
                    if(isset($_POST['prices'])){
                        if(in_array(2, $_POST['prices'])){
                            $checked_3 = 'checked';
                        }
                    }
                    if(isset($_POST['prices'])){
                        if(in_array(3, $_POST['prices'])){
                            $checked_4 = 'checked';
                        }
                    }
                    ?>
                    <input <?php echo $checked_1 ?> type="checkbox" name="prices[]" value="0"> Down to $50
                    <br>
                    <input <?php echo $checked_2 ?> type="checkbox" name="prices[]" value="1"> From $50 To $55
                    <br>
                    <input <?php echo $checked_3 ?> type="checkbox" name="prices[]" value="2"> From $55 To $60
                    <br>
                    <input <?php echo $checked_4 ?> type="checkbox" name="prices[]" value="3"> Up to $60
                    <br>
                </div>
                <input type="submit" name="filter" value="Tìm kiếm" class="btn btn-success">
                <a href="danh-sach-san-pham.html">
                    Cancel
                </a>
            </form>
        </div>
        <div class="col-md-9 col-sm-9 col-12">
            <?php if (!empty($products)): ?>
                <h1 class="post-list-title">

                </h1>
                <div class="link-secondary-wrap row">
                    <?php foreach ($products AS $product):
                        $slug = Helper::getSlug($product['title']);
                        $url_detail = "index.php?controller=product&action=detail&id=" . $product['id'];
                        $product_cart_add = "them-vao-gio-hang/" . $product['id'] . ".html";
                        ?>
                        <div class="service-link col-md-3 col-sm-6 col-xs-12">
                            <a href="<?php echo $url_detail; ?>">
                                <img class="secondary-img img-responsive" title="<?php echo $product['title'] ?>"
                                     src="../backend/assets/uploads/<?php echo $product['avatar'] ?>"
                                     alt="<?php echo $product['title'] ?>"/>
                                <span class="shop-title">
                        <?php echo $product['title'] ?>
                    </span>
                            </a>
                            <span class="shop-price">
                            <?php echo number_format($product['price']) ?>
                </span>

                            <span class="add-to-cart"
                                  data-id="<?php echo $product['id']; ?>">
                        <a href="#" style="color: inherit">Add to cart</a>
                    </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
