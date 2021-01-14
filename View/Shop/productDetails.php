<?php $this->title = "Details du produit"; ?>
<script> let price = "<?= $productDetails->price_ht; ?>";
    let id = "<?= $productDetails->id; ?>";
    let name = "<?= $name->name; ?>";
</script>
<!-- Product Details Area Start -->
<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-50">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Furniture</a></li>
                        <li class="breadcrumb-item"><a href="#">Chairs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">white modern chair</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a class="gallery_img" href="<?= $productDetails->picture_url_1 ?>">
                                    <img class="d-block w-100" src="<?= $productDetails->picture_url_1 ?>" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="single_product_desc">
                    <!-- Product Meta Data -->
                    <div class="product-meta-data">
                        <div class="line"></div>
                        <p class="product-price"><?= $productDetails->price_ht . " €" ?></p>
                        <a href="<?= "Shop/productDetails/" . $productDetails->id ?>" >
                            <h6><?= $name->name; ?></h6>
                        </a>
                        <!-- Ratings & Review -->
                        <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                        </div>
                        <!-- Avaiable -->
                        <p class="avaibility"><i class="fa fa-circle"></i> En Stock</p>
                    </div>

                    <div class="short_overview my-5">
                        <p><?= $productDetails->description ?></p>
                    </div>

                    <!-- Add to Cart Form -->
                    <form class="cart clearfix" method="post">
                        <div class="cart-btn d-flex mb-50 col-7">
                            <p>Quantité</p>
                            <div class="quantity">
                                <span class="qty-minus" id="qty-minus">
                                    <i class="fa fa-caret-down"  aria-hidden="true"></i>
                                </span>
                                <input type="number" class="qty-text" id="qty" step="1" min="1" max="10" name="quantity">
                                <span class="qty-plus" id="qty-plus">
                                    <i class="fa fa-caret-up" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                            <button type="button" id="add-product-to-cart" class="btn amado-btn">Ajouter au panier</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Details Area End -->

<!-- Code js panier -->
<script src="js/cart/CustomerCart.js" defer></script>
<script src="js/cart/main.js" defer></script>