<?php
require_once 'Helpers/Helper.php';
?>
<!--Timeline items start -->
<div class="timeline-items container">
    <h2>Your cart</h2>
    <?php if (isset($_SESSION['cart'])): ?>
        <form action="" method="post">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th width="40%">Product name</th>
                    <th width="12%">Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
                <?php
                    //Khai báo biến chứa tổng giá trị đơn hàng
                    $total_cart = 0;
                    foreach ($_SESSION['cart'] AS $product_id => $cart):
                ?>
                    <tr>
                        <td>
                            <!--  Do cấu trúc mvc hiên tại đang tách làm 2 thư
                             mục frontend và backend nên cần lên 1 cấp để có
                             thể vào backend lấy ảnh ra-->
                            <img class="product-avatar img-responsive"
                                 src="admin/assets/uploads/<?php echo $cart['avatar']?>"
                                 width="80">
                            <div class="content-product">
                                <?php
                                //Khai báo link rewrite cho trang chi tiết sản phẩm
                                $slug = Helper::getSlug($cart['name']);
                                $url_detail = "index.php?controller=product&action=detail&id=" . $product_id;
                                ?>
                                <a href="<?php echo $url_detail; ?>"
                                   class="content-product-a">
                                    <?php echo $cart['name']; ?>
                                </a>
                            </div>
                        </td>
                        <td>
                            <!-- cần khéo léo đặt name cho input số lượng,
                            để khi xử lý submit form update lại giỏ hàng sẽ đơn giản hơn
                               , với cấu trúc giỏ hàng hiện tại, thì sẽ đặt name chính là id
                               của sản phẩm, để khi update giỏ hàng xử lý rất đơn giản-->
                            <input type="number" min="0"
                                   name="<?php echo $product_id; ?>"
                                   class="product-amount form-control"
                                   value="<?php echo $cart['quantity']; ?>">
                        </td>
                        <td>
                            $ <?php echo number_format($cart['price']); ?>
                        </td>
                        <td>
                            $ <?php
                            $total_item = $cart['quantity'] * $cart['price'];
                            //Cộng tích lũy thành tiền này cho tổng giá trị
                            //đơn hàng
                            $total_cart += $total_item;
                            echo number_format($total_item);
                            ?>
                        </td>
                        <td>
                            <a class="content-product-a"
                               href="index.php?controller=cart&action=delete&id=<?php echo $product_id; ?>">
                                Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <!-- xóa <tr> thứ 3  -->


                <tr>
                    <td colspan="5" style="text-align: right">
                        Current total: $
                        <span class="product-price">
                           <?php echo number_format($total_cart); ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="product-payment">
                        <input type="submit" name="submit" value="Cập nhật lại giá" class="btn btn-primary">
                        <a href="thanh-toan.html" class="btn btn-success">Checkout</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    <?php else: ?>
        <h2>Your cart is empty</h2>
        <a href="index.php" class="btn btn-primary">
            Back to Homepage
        </a>
    <?php endif; ?>
</div>
<!--Timeline items end -->