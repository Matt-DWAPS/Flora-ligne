<?php $this->title = "Commande"; ?>

<!-- ##### Main Content Wrapper Start ##### -->
    <div class="cart-table-area section-padding-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-title">
                            <h2>Commande</h2>
                        </div>

                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" id="first_name" value="" placeholder="Prénom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" id="last_name" value="" placeholder="Nom" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control" id="company" placeholder="Société" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="Email" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control mb-3" id="street_address" placeholder="Adresse" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control" id="city" placeholder="Ville" value="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" id="zipCode" placeholder="Code postal" value="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" class="form-control" id="phone_number" min="0" placeholder="Téléphone" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea name="comment" class="form-control w-100" id="comment" cols="30" rows="10" placeholder="Vous pouvez laissez un commentaire sur votre commande si vous le souhaiter"></textarea>
                                </div>

                                <div class="col-12">
                                    <div class="custom-control custom-checkbox d-block mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">Créer un compte</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-summary">
                        <h5>Total panier</h5>
                        <ul class="summary-table">
                            <li><span>Sous-total:</span> <span>$140.00</span></li>
                            <li><span>Frais de préparation:</span> <span>Gratuit</span></li>
                            <li><span>Total:</span> <span>$140.00</span></li>
                        </ul>

                        <div class="payment-method">
                            <!-- Cash on delivery -->
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="radio" class="custom-control-input" id="cod" checked>
                                <label class="custom-control-label" for="cod">Paiement à la livraison</label>
                            </div>
                        </div>

                        <div class="cart-btn mt-100">
                            <a href="#" class="btn amado-btn w-100">Reserver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



