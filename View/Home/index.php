<?php $this->title = "Flora-ligne"; ?>


<!-- Product Catagories Area Start -->
<div class="products-catagories-area clearfix">
    <div class="amado-pro-catagory clearfix">
        <?php if (isset($_SESSION['flash'])) : ?>
            <div class="alert alert-<?= $_SESSION['flash']['alert']; ?>">
                <p><?= $_SESSION['flash']['message']; ?></p>
            </div>
        <?php endif; ?>
        <?php unset($_SESSION['flash']); ?>
        <!-- Single Catagory -->
        <?php foreach ($products as $product) : ?>

        <div class="single-products-catagory clearfix">
            <?php
            echo "<pre>";
            print_r($product);
            echo "</pre>";
            ?>
            <a href="<?= "/shop/productDetails/" . $product->id ?>">
                <img class="img-fluid img-thumbnail" src="<?= $product->picture_url_1 ?>" alt="">
                <!-- Hover Content -->
                <div class="hover-content">
                    <div class="line"></div>
                    <h4><?= $product->name ?></h4>
                    <p><?= $product->price_ht . " €" ?></p>
                </div>
            </a>
        </div>

        <?php endforeach; ?>

    </div>
</div>
<!-- Product Catagories Area End -->


