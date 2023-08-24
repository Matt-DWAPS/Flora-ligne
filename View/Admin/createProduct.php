<?php $this->title = "Nouveau produit"; ?>
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">
                    <div class="cart-title">
                        <h2>Créer un nouveau produit</h2>
                    </div>
                    <form method="post">
                        <div class="col">
                            <div class="form-group row">
                                <div class="col d-flex justify-content-center">
                                <select name="name" id="name">
                                    <?php foreach ($productsNames as $productName) : ?>
                                        <option value="<?= $productName->getId(); ?>">
                                            <?= $productName->getName() ; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                    <p class="text-danger"><?= isset($errorsMsg['name']) ? $errorsMsg['name'] : ''; ?></p>
                                </div>
                                <div class="col d-flex justify-content-center">
                                    <select name="countries" id="state-choice">
                                        <?php foreach ($productsCountries as $country) : ?>
                                            <option value="<?= $country->getId(); ?>">
                                                <?= $country->getCountryName() ; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div >
                        </div>
                        <div class="col">
                            <div class="form-group row justify-content-center">
                                <div class="col-2 pr-0">
                                        <input class="form-control input-lg" type="text" id="price_ht" name="price_ht" placeholder="Prix HT"
                                               value="<?= isset($post['price_ht']) ? $post['price_ht'] : ''; ?>"/>
                                    <p class="text-danger"><?= isset($errorsMsg['price_ht']) ? $errorsMsg['price_ht'] : ''; ?></p>
                                </div>
                                <div class="form-control input-lg col-1 d-flex justify-content-center align-items-center font-bold" style="font-size: 2em">€</div>
                                <div class="col-4">
                                        <input class="form-control input-lg" type="text" id="growth" name="growth"
                                               value="<?= isset($post['growth']) ? $post['growth'] : ''; ?>" placeholder="Vitesse de croissance"/>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <textarea placeholder="Description du produit" aria-label="content" class="form-control input-lg" rows="5" id="description"
                                          name="description"><?= isset($post['description']) ? $post['description'] : ''; ?></textarea>
                                <p class="text-danger"><?= isset($errorsMsg['description']) ? $errorsMsg['description'] : ''; ?></p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <div class="col">
                                    <input class="form-control input-lg" type="text" id="location" name="location"
                                           value="<?= isset($post['location']) ? $post['location'] : ''; ?>" placeholder="Localisation (Lumière, intérieur, exterieur...)"/>
                                </div>
                                <div class="col">
                                    <input class="form-control input-lg" type="text" id="maintain" name="maintain"
                                           value="<?= isset($post['maintain']) ? $post['maintain'] : ''; ?>" placeholder="Difficultées de l'entretien"/>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <div class="col">
                                    <input class="form-control input-lg" type="text" id="size_min" name="size_min"
                                           value="<?= isset($post['size_min']) ? $post['size_min'] : ''; ?>" placeholder="Taille minimum"/>
                                    <p class="text-danger"><?= isset($errorsMsg['size_min']) ? $errorsMsg['size_min'] : ''; ?></p>
                                </div>
                                <div class="col">
                                    <input class="form-control input-lg" type="text" id="size_max" name="size_max"
                                           value="<?= isset($post['size_max']) ? $post['size_max'] : ''; ?>" placeholder="Taille maximum"/>
                                    <p class="text-danger"><?= isset($errorsMsg['size_max']) ? $errorsMsg['size_max'] : ''; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class=" mt-3 d-flex justify-content-around">
                            <div class="col">
                                <button class=" btn" style="background-color: #096A09; color: white" role="button" href="Admin/productList"><i class="fas fa-arrow-left"></i> Retour</button>
                            </div>
                            <div class="col">
                                <input type="hidden" name="articleForm" value="addArticle"/>
                                <input class="btn" style="background-color: #096A09; color: white" type="submit" value="Enregistrer en tant que brouillon"/>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <input class="btn" style="background-color: #096A09; color: white" type="submit" name="publish" value="Mettre en ligne">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>