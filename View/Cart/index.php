<?php
/**
 * @var $user
 * @var $userProduct
 */
$this->title = "Panier"; ?>

<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="cart-title mt-50">
                    <h2>Panier</h2>
                </div>

                <div class="cart-table clearfix">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Supprimé</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        if (!empty($userProduct)) :
                            foreach ($userProduct as $product) : ?>

                                <form method="post" action="/Cart/deleteProduct">
                                    <tr>
                                        <td class="cart_product_img flex-auto-table">
                                            <a href="<?= "/Shop/productDetails/" . $product->getProductId() ?>"><img class="w-25"
                                                         src="<?= $product->getPicture() ?>"
                                                        alt="<?= $product->getPicture() ?>"></a>
                                        </td>
                                        <td class="cart_product_desc">
                                            <input class=" form-control form-control-sm" type="text" name="name"
                                                   value="<?= $product->getName() ?><?= isset($post['name']) ? $post['name'] : ''; ?>"
                                                   readonly>
                                        </td>
                                        <td class="price">
                                            <span>$130</span>
                                        </td>
                                        <td class="qty">
                                            <div class="qty-btn d-flex">
                                                <div class="quantity">
                                                    <input class="form-control" type="text"
                                                           name="quantity"
                                                           value="<?= $product->getQuantity() ?> <?= isset($post['quantity']) ? $post['quantity'] : ''; ?>"
                                                           readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="deleteProduct" value="delete"/>
                                            <input class="btn amado-btn border rounded"
                                                   style="background-color: #096A09" type="button" name="delete"
                                                   value="Supprimé" onclick="deleteThisProduct(<?= $product->getProductId() ?>)">

                                        </td>
                                    </tr>
                                </form>
                            <?php endforeach;
                        else : ?>
                        <tr>
                            <td colspan="5">
                                (votre panier est vide)</td>
                        </tr>
                        <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-7">

                <div class="border rounded p-3 pb-5 col-12">
                    <div class="row p-2 m-2">
                        <div class="col">
                            <div class="row p-3">
                                <div class="col">
                                    <p>Nom : <?= $user->getLastname() ?></p>
                                </div>
                                <div class="col">
                                    <p>Prénom : <?= $user->getFirstname() ?></p>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col">
                                    <p>Adresse email : <?= $user->getEmail(); ?></p>
                                </div>
                                <div class="col">
                                    <p>Adresse : <?= $user->getAddress() ?></p>
                                </div>

                            </div>
                            <div class="row p-3">
                                <div class="col">
                                    <p>Code postal : <?= $user->getZipCode() ?></p>
                                </div>
                                <div class="col">
                                    <p>Téléphone : <?= isset($post['phone']) ? $post['phone'] : $user->getPhone() ?></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="cart-summary mt-0">
                    <h5>Panier Total</h5>
                    <ul class="summary-table">
                        <li><span>Frais de préparation :</span> <span>Gratuit</span></li>
                        <li><span>Total :</span> <span id="totalCartProduct"></span></li>
                        <li><span>Paiement :</span> <span>En magasin</span></li>
                    </ul>
                    <div class="cart-btn mt-100">
                        <a href="/Cart/saveProductInOrder" class="btn amado-btn w-100">Réservation</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Code js panier -->
<script src="js/cart/viewLocalStorageCart.js" defer></script>
<script src="js/cart/deleteProductCart.js" defer></script>