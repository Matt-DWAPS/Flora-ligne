<?php $this->title = "Gestion des produits"; ?>

<div class="products-catagories-area clearfix">
    <div class="cart-title mt-50">
        <h2>Gestion des produits</h2>
    </div>
    <div class="text-center mb-3">
        <a class="btn amado-btn border rounded" style="background-color: #096A09" role="button" href="Admin/createProduct">Ajouter un nouveau produit</a>
    </div>
    <div class="text-center mb-3">
        <?php if (isset($_SESSION['flash'])) : ?>
            <div class="alert alert-<?= $_SESSION['flash']['alert']; ?>">
                <p><?= $_SESSION['flash']['infos']; ?></p>
            </div>
        <?php endif; ?>
        <?php unset($_SESSION['flash']); ?>
    </div>
    <div class="amado-pro-catagory clearfix mb-4">
        <?php foreach ($products as $product) : ?>
            <div  class="single-products-catagory clearfix mt-4 border mr-4">
                <?php if (empty($product->picture_url_1)) : ?>
                <a id="admin_product_custom" href="<?= "Admin/updateProduct/" . $product->id ?>" style="width: 418px; height: 251px;">
                    <div class="hover-content text-center  icon_product_custom" style="top: 25%; right: 10%"><i id="icon_fa_custom" class="fas fa-10x fa-pencil-alt" style="width: 100%;"></i></div>
                    <img style="max-width: 420px ;max-height: 367px;" src="img/core-img/logo.jpg" alt="logo">
                    <!-- Hover Content -->
                    <div class="hover-content text-center m-2">
                        <div class="line"></div>
                        <h4><?= $product->name ?></h4>
                        <p><?= $product->price_ht .' €'?></p>
                    </div>
                </a>
                <?php else: ?>
                    <a id="admin_product_custom" href="<?= "Admin/updateProduct/" . $product->id ?>">
                        <div class="hover-content text-center  icon_product_custom" style="top: 25%; right: 10%">
                            <i id="icon_fa_custom" class="fas fa-10x fa-pencil-alt" style="width: 100%;"></i>
                        </div>
                        <img style="max-width: 420px;max-height: 367px;" src="<?= $product->picture_url_1 ?>" alt="<?= $product->picture_url_1 ?>">
                        <!-- Hover Content -->
                        <div class="hover-content text-center m-2">
                            <div class="line"></div>
                            <h4><?= $product->name ?></h4>
                            <p><?= $product->price_ht .' €'?></p>
                        </div>
                    </a>
                <?php endif; ?>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <a class="btn btn-danger" type="submit" role="button" href="<?= "Admin/deleteProduct/" . $product->id ?>">Supprimer le produit</a>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

</div>



