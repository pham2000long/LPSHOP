<?php require_once 'Helpers/Helper.php'; ?>
<!-- Categories Section Begin -->
<section class="categories">
    <div class="container-fluid">
        <div class="categories__item categories__large__item set-bg"
             data-setbg="assets/img/categories/category-1.jpg">
            <div class="categories__text">
                <h1>Women’s fashion</h1>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">

            </div>
            <div class="col-lg-8 col-md-8">

            </div>
        </div>
        <?php if (!empty($products)): ?>
        <div class="row property__gallery">
            <?php foreach ($products AS $product):
                $slug = Helper::getSlug($product['title']);
                $url_detail = "index.php?controller=product&action=detail&id=" . $product['id'];
                $product_cart_add = "them-vao-gio-hang/" . $product['id'] . ".html";
                ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mix ">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="../admin/assets/uploads/<?php echo $product['avatar'] ?>">

                        <ul class="product__hover">
                            <li><a href="../admin/assets/uploads/<?php echo $product['avatar'] ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a href="#" data-id="<?php echo $product['id']; ?>"><span class="icon_heart_alt" data-id="<?php echo $product['id']; ?>"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="<?php echo $url_detail ?>"><?php echo $product['title'] ?></a></h6>
                        <div class="product__price">$ <?php echo number_format($product['price']) ?></div>

                            <span class="add-to-cart"
                                  data-id="<?php echo $product['id']; ?>">
                                <a href="#" style="color: white">Add to cart</a>
                            </span>

                    </div>

                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<!-- Product Section End -->
<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-car"></i>
                    <h6>Free Shipping</h6>
                    <p>For all oder over $99</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-money"></i>
                    <h6>Money Back Guarantee</h6>
                    <p>If good have Problems</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-support"></i>
                    <h6>Online Support 24/7</h6>
                    <p>Dedicated support</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-headphones"></i>
                    <h6>Payment Secure</h6>
                    <p>100% secure payment</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

<!-- Instagram Begin -->
<div class="instagram">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="assets/img/instagram/insta-1.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="#">@ ashion_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="assets/img/instagram/insta-2.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="#">@ ashion_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="assets/img/instagram/insta-3.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="#">@ ashion_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="assets/img/instagram/insta-4.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="#">@ ashion_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="assets/img/instagram/insta-5.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="#">@ ashion_shop</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="assets/img/instagram/insta-6.jpg">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="#">@ ashion_shop</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Instagram End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->
<script src="assets/js/script.js"></script>