<?php
/**
 * @var $user
 */
$this->title = "Panier"; ?>

<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-7">
                <form method="post">
                    <div class="border rounded p-3 pb-5 col-12">
                        <div class="row p-2 m-2">
                            <div class="col">
                                <div class="row p-3">
                                    <div class="col">
                                        <p>Nom : <?= $customer->lastname ?></p>
                                    </div>
                                    <div class="col">
                                        <p>Prénom : <?= $customer->firstname ?></p>
                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="col">
                                        <p>Adresse email : <?=  $customer->email; ?></p>
                                    </div>
                                    <div class="col">
                                        <p>Adresse : <?= $customer->address ?></p>
                                    </div>

                                </div>
                                <div class="row p-3">
                                    <div class="col">
                                        <p>Code postal : <?= $customer->zipcode ?></p>
                                    </div>
                                    <div class="col">
                                        <p>Téléphone : <?= $customer->phone ?></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-5">
                <div class="cart-summary mt-0">
                    <h5>Panier Total</h5>
                    <ul class="summary-table">
                        <li><span>Frais de préparation :</span> <span>Gratuit</span></li>
                        <li><span>Total :</span> <span id="totalCartProduct"></span></li>
                    </ul>
                    <div class="cart-btn mt-100">
                        <a href="/Cart/saveOrderInBdd" class="btn amado-btn w-100">Réservation</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Code js panier -->
<script src="js/cart/viewLocalStorageCart.js" defer></script>