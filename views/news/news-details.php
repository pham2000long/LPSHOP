    <!-- Blog Details Section Begin -->
    <br>
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="blog__details__content">
                        <div class="blog__details__item">
                            <img src="../admin/assets/uploads/<?php echo $new['avatar']; ?>" alt="" width="260">
                            <div class="blog__details__item__title">
                                <h4><?php echo $new['title']; ?></h4>
                                <ul>
                                    <li><?php echo $new['created_at'] ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog__details__desc">
                            <?php echo $new['content'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->