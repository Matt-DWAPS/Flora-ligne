<?php $this->title = "Modifier le produit"; ?>
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">
                    <div class="cart-title">
                        <h2>Modifier un produit</h2>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="col">
                            <div class="form-group row">
                                <div class="col d-flex justify-content-center">
                                    <select name="name" id="name">
                                        <?php foreach ($productsNames as $productName) : ?>
                                            <option value="<?= $productName->getId(); ?>" <?php if($productName->getId() == $product->getProductNameId()) { echo 'selected autofocus'; } ?> >
                                                <?= $productName->getName() ; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <p class="text-danger"><?= isset($errorsMsg['name']) ? $errorsMsg['name'] : ''; ?></p>
                                </div>
                                <div class="col d-flex justify-content-center">
                                    <select name="countries" id="state-choice">

                                        <?php foreach ($productsCountries as $country) : ?>

                                            <option value="<?= $country->getId(); ?>" <?php if($country->getId() == $product->getCountryId()) { echo 'selected autofocus'; } ?>>
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
                                           value="<?= $product->getPriceHt(); ?>"/>
                                    <p class="text-danger"><?= isset($errorsMsg['price_ht']) ? $errorsMsg['price_ht'] : ''; ?></p>
                                </div>
                                <div class="form-control input-lg col-1 d-flex justify-content-center align-items-center font-bold" style="font-size: 2em">€</div>
                                <div class="col-4">
                                    <input class="form-control input-lg" type="text" id="growth" name="growth"
                                           value="<?= $product->getGrowth(); ?>" placeholder="Vitesse de croissance"/>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <textarea placeholder="Description du produit" aria-label="content" class="form-control input-lg" rows="5" id="description"
                                          name="description"><?= $product->getDescription(); ?></textarea>
                                <p class="text-danger"><?= isset($errorsMsg['description']) ? $errorsMsg['description'] : ''; ?></p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <div class="col">
                                    <input class="form-control input-lg" type="text" id="location" name="location"
                                           value="<?= $product->getLocation(); ?>" placeholder="Localisation (Lumière, intérieur, exterieur...)"/>
                                </div>
                                <div class="col">
                                    <input class="form-control input-lg" type="text" id="maintain" name="maintain"
                                           value="<?= $product->getMaintain(); ?>" placeholder="Difficultées de l'entretien"/>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <div class="col">
                                    <input class="form-control input-lg" type="text" id="size_min" name="size_min"
                                           value="<?= $product->getSizeMin(); ?>" placeholder="Taille minimum"/>
                                    <p class="text-danger"><?= isset($errorsMsg['size_min']) ? $errorsMsg['size_min'] : ''; ?></p>
                                </div>
                                <div class="col">
                                    <input class="form-control input-lg" type="text" id="size_max" name="size_max"
                                           value="<?= $product->getSizeMax(); ?>" placeholder="Taille maximum"/>
                                    <p class="text-danger"><?= isset($errorsMsg['size_max']) ? $errorsMsg['size_max'] : ''; ?></p>
                                </div>
                            </div>
                        </div>

                            <?php if (empty($product->getPictureUrl1())) : ?>
                                <div class="form-group p-2 col-12 text-center">
                                    <a class="btn align-items-center" role="button" style="background-color: #096A09; color: white"
                                       href="<?= "/admin/pictureProductUpload/" . $product->getId() ?>">
                                        Ajouter
                                        une image</a>
                                </div>
                            <?php else : ?>
                                <div class="col-12 d-flex justify-content-center">
                                    <div class="border rounded col-6">
                                        <div class="form-group  p-2  justify-content-center d-flex">
                                            <img class="img-fluid" src="<?= $product->getPictureUrl1() ?>">
                                        </div>
                                        <div class="row justify-content-center mb-3">
                                            <a class="btn d-flex align-items-center" style="background-color: #096A09; color: white" role="button"
                                               href="<?= "/admin/pictureProductUpload/" . $product->getId() ?>">
                                                Modifier/ajouter
                                                une image</a>
                                        </div>
                                    </div>

                                </div>
                            <?php endif; ?>

                        <div class=" mt-3 d-flex justify-content-around">
                            <div class="col">
                                <button class=" btn" role="button" style="background-color: #096A09; color: white" href="Admin/productList"><i class="fas fa-arrow-left"></i> Retour</button>
                            </div>
                            <div class="col">
                                <input type="hidden" name="articleForm" value="updateArticle"/>
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
