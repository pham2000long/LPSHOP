<div class="wrap">
    <h2>Cảm ơn bạn đã đặt hàng, <b><?php echo $info_customer['fullname']; ?></b></h2>
    <p>
        Mã đơn hàng của bạn: <b>#<?php echo $order_id; ?></b>
    </p>
    <div>
        <p>
            - Để thanh toán đơn hàng, bạn hãy chuyển khoản theo thông tin sau:
            <br>
            <b>
                VCB Nguyen Van Khai <br>
                112121212121111111 <br>
                Chi nhành Hà Nội <br>
            </b>
            Nội dung chuyển khoản: Thanh toán đơn hàng #<?php echo $order_id; ?> </p>
        <p>
            - Hoặc bạn có thể liên hệ trực tiếp với chúng tôi qua số điện thoại:
            <a href="tel:0974469808">0974469808</a>
        </p>
    </div>
    <h4>Thông tin người mua hàng</h4>
    <table border="1" cellpadding="8" cellspacing="0">
        <tbody>
        <tr>
            <th>Họ tên</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
        </tr>
        <tr>
            <td><?php echo $info_customer['fullname']; ?></td>
            <td><?php echo $info_customer['mobile']; ?></td>
            <td><?php echo $info_customer['email']; ?></td>
            <td><?php echo $info_customer['address']; ?></td>
        </tr>
        </tbody>
    </table>
    <br>
<!--  Tự xử lý để hiển thị dựa vào session giỏ hàng  -->
    <h4>Thông tin đơn hàng</h4>
    <table border="1" cellpadding="8" cellspacing="0">
        <tbody>
        <tr>
            <th width="40%">Product name</th>
            <th width="12%">Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
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
                        $product_link = "chi-tiet-san-pham/$slug/$product_id";
                        ?>
                        <a href="<?php echo $product_link; ?>"
                           class="content-product-a">
                            <?php echo $cart['name']; ?>
                        </a>
                    </div>
                </td>
                <td>
                         <?php echo $cart['quantity']; ?>
                </td>
                <td>
                    $<?php echo number_format($cart['price']); ?>
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

            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="5" style="text-align: right">
                Total:
                <span class="product-price">
                           $ <?php echo number_format($total_cart); ?>
                        </span>
            </td>
        </tr>
        </tbody>
    </table>
</div>