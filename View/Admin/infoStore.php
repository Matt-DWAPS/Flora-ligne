<?php $this->title = "Informations du magasin"; ?>

<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="cart-title mt-50">
                    <h2>Modifier les informations du magasin</h2>
                </div>
                <form method="post">
                    <div class="d-flex justify-content-center">
                        <div class="border rounded p-3 col-8">
                            <div class="form-group">
                                <label for="name_store">Nom du magasin</label>
                                <input class="form-control" type="text" id="name_store" name="name_store"
                                       value="<?= isset($post['name_store']) ? $post['name_store'] : ''; ?>"/>
                                <p class="text-danger"><?= isset($errorsMsg['name_store']) ? $errorsMsg['name_store'] : ''; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="address_store">Adresse du magasin</label>
                                <input class="form-control" type="text" id="address_store" name="address_store"/>
                                <p class="text-danger"><?= isset($errorsMsg['address_store']) ? $errorsMsg['address_store'] : ''; ?></p>
                            </div>
                            <p>Ouverture du magasin</p>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <div class="form-check">
                                        <input class="form-check-input position-static" type="checkbox" id="mondayGridCheck">
                                        <label class="form-check-label" for="mondayGridCheck">
                                            Lundi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input position-static" type="checkbox" id="tuesdayGridCheck">
                                        <label class="form-check-label" for="tuesdayGridCheck">
                                            Mardi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="wednesdayGridCheck">
                                        <label class="form-check-label" for="
wednesdayGridCheck">
                                            Mercredi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="thursdayGridCheck">
                                        <label class="form-check-label" for="thursdayGridCheck">
                                            Jeudi
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="fridayGridCheck">
                                        <label class="form-check-label" for="fridayGridCheck">
                                            Vendredi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="saturdayGridCheck">
                                        <label class="form-check-label" for="saturdayGridCheck">
                                            Samedi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sundayGridCheck">
                                        <label class="form-check-label" for="sundayGridCheck">
                                            Dimanche
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <input class="btn btn-primary" type="submit" id="submit" value="Enregistrer les informations">
                            </div>


                        </div>
                    </div>

                </form>
            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-summary">
                    <h5>Informations du magasin</h5>
                    <ul class="summary-table">
                        <li><span>Nom :</span> <span>$140.00</span></li>
                        <li><span>Adresse :</span> <span>Gratuit</span></li>
                        <li><span>Ouvert les :</span> <span>Gratuit</span></li>
                        <li><span>Horaires :</span> <span>$140.00</span></li>
                        <li><span>Statut :</span> <span>$140.00</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>