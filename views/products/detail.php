<?php
    require_once 'Helpers/Helper.php';
?>
<div class="container">
    <div class="row">
        <div class="detail-content-wrap con-md-8 col-sm-8 col-xs-12">
            <div class="product-info-wrap">
                <div class="product-image-info">
                    <img src="../admin/assets/uploads/<?php echo $product['avatar'] ?>" width="260"
                         title="<?php echo $product['title']; ?>">
                </div>
                <div class="product-info">
                    <h3 class="product-title">
                      <?php echo $product['title']; ?>
                    </h3>
                    <div class="product-price">
                      $<?php echo number_format($product['price'], 0, '.', ','); ?>
                    </div>
                    <div class="product-cart">
                        <span data-id="<?php echo $product['id']; ?>" class="add-to-cart">
                            <i class="fa fa-cart-plus"></i> Add to cart
                        </span>
                    </div>
                </div>
            </div>

            <!--Timeline items end -->
            <div class="detail-content-wrap">
                <div class="detail-summary">
                    <strong><?php echo $product['summary']; ?></strong>
                </div>
                <div class="detail-description">
                    <div class="description-productdetail">
                      <?php echo $product['content']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>