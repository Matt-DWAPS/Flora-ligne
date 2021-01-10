<?php $this->title = "Gestion des produits"; ?>

<div class="products-catagories-area clearfix">
    <div class="cart-title mt-50">
        <h2>Gestion des produits</h2>
    </div>
    <div class="text-center mb-3">
        <a class="btn amado-btn border rounded" style="background-color: #096A09" role="button" href="Admin/createProduct">Ajouter un nouveau produit</a>
    </div>
    <div class="amado-pro-catagory clearfix">
        <?php foreach ($products as $product) : ?>
            <div id="admin_product_custom" class="single-products-catagory clearfix mt-4 border mr-4">
                <?php if (empty($product->picture_url_1)) : ?>
                <a  href="<?= "Admin/updateProduct/" . $product->id ?>" style="width: 418px; height: 251px;">
                    <div class="hover-content text-center  icon_product_custom" style="top: 25%; right: 10%"><i id="icon_fa_custom" class="fas fa-10x fa-pencil-alt" style="width: 100%;"></i></div>
                    <img src="<?= $product->picture_url_1 ?>" alt="">
                    <!-- Hover Content -->
                    <div class="hover-content text-center m-2">
                        <div class="line"></div>

                        <h4><?= $product->name ?></h4>
                        <p><?= $product->price_ht .' €'?></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>

                    </div>
                </a>
                    <?php else: ?>
                        <a  href="<?= "Admin/updateProduct/" . $product->id ?>">

                            <div class="hover-content text-center  icon_product_custom" style="top: 25%; right: 10%"><i id="icon_fa_custom" class="fas fa-10x fa-pencil-alt" style="width: 100%;"></i></div>
                            <img src="<?= $product->picture_url_1 ?>" alt="">
                            <!-- Hover Content -->
                            <div class="hover-content text-center m-2">
                                <div class="line"></div>

                                <h4><?= $product->name ?></h4>
                                <p><?= $product->price_ht .' €'?></p>
                                <p></p>
                                <p></p>
                                <p></p>
                                <p></p>

                            </div>
                        </a>
                    <?php endif; ?>
            </div>

        <?php endforeach; ?>
    </div>

</div>



