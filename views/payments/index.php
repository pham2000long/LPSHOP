<?php
require_once 'Helpers/Helper.php';
?>
<div class="container">
    <h2>Thanh toán</h2>
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h5 class="center-align">Thông tin khách hàng</h5>
                <div class="form-group">
                    <label>Customer's name</label>
                    <input type="text" name="fullname" value="<?php
                     if (isset($_SESSION['user'])) {
                        echo $_SESSION['user']['first_name']. " " .$_SESSION['user']['last_name'];
                    }
                    ?>" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="<?php
                    if (isset($_SESSION['user'])) {
                        echo $_SESSION['user']['address'];
                    }
                    ?>" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="number" min="0" name="mobile" value="<?php
                    if (isset($_SESSION['user'])) {
                        echo $_SESSION['user']['phone'];
                    }
                    ?>" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" min="0" name="email" value="<?php
                    if (isset($_SESSION['user'])) {
                        echo $_SESSION['user']['email'];
                    }
                    ?>" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Note</label>
                    <textarea name="note" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Select a payment method</label> <br />
                    <input type="radio" name="method" value="0" /> Online payment <br />
                    <input type="radio" name="method" checked value="1" /> COD (based on your address) <br />
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <h5 class="center-align">Your order information</h5>
              <?php
              //biến lưu tổng giá trị đơn hàng
              $total = 0;
              if (isset($_SESSION['cart'])):
                ?>
                  <table class="table table-bordered">
                      <tbody>
                      <tr>
                          <th width="40%">Product name</th>
                          <th width="12%">Quantity</th>
                          <th>Price</th>
                          <th>Subtotal</th>
                      </tr>
                      <?php foreach ($_SESSION['cart'] AS $product_id => $cart):
                        $product_link = 'san-pham/' . Helper::getSlug($cart['name']) . "/$product_id";
                        ?>
                          <tr>
                              <td>
                                <?php if (!empty($cart['avatar'])): ?>
                                    <img class="product-avatar img-responsive"
                                         src="admin/assets/uploads/<?php echo $cart['avatar']; ?>" width="60"/>
                                <?php endif; ?>
                                  <div class="content-product">
                                      <a href="<?php echo $product_link; ?>" class="content-product-a">
                                        <?php echo $cart['name']; ?>
                                      </a>
                                  </div>
                              </td>
                              <td>
                              <span class="product-amount">
                                  <?php echo $cart['quantity']; ?>
                              </span>
                              </td>
                              <td>
                              <span class="product-price-payment">
                                 $<?php echo number_format($cart['price'], 0, '.', '.') ?>
                              </span>
                              </td>
                              <td>
                              <span class="product-price-payment">
                                  $<?php
                                  $price_total = $cart['price'] * $cart['quantity'];
                                  $total += $price_total;
                                  ?>
                                <?php echo number_format($price_total, 0, '.', '.') ?>
                              </span>
                              </td>
                          </tr>
                      <?php endforeach; ?>
                      <tr>
                          <td colspan="5" class="product-total">
                              Total:
                              <span class="product-price">
                                $<?php echo number_format($total, 0, '.', '.') ?>
                            </span>
                          </td>
                      </tr>
                      </tbody>
                  </table>
              <?php endif; ?>

            </div>
        </div>
        <input type="submit" name="submit" value="Thanh toán" class="btn btn-primary">
        <a href="gio-hang-cua-ban.html" class="btn btn-secondary">Back to cart page</a>
    </form>
</div>