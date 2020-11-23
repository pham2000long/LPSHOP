<?php
require_once 'Helpers/Helper.php';
?>
    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <?php if (!empty($news)): ?>
            <div class="row">
                <?php foreach ($news AS $new):
                    $slug = Helper::getSlug($new['title']);
                    $url_detail = "index.php?controller=new&action=detail&id=" . $new['id'];
                    ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="../admin/assets/uploads/<?php echo $new['avatar'] ?>"></div>
                        <div class="blog__item__text">
                            <h6><a href="<?php echo $url_detail; ?>"><?php echo $new['title'] ?>"/></a></h6>
                            <ul>
                                <li><?php echo $new['summary'] ?>"/></li>
                                <li><?php echo $new['created_at'] ?>"/></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <!-- Blog Section End -->