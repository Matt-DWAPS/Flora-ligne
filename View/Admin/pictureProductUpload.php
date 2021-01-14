<?php $this->title = "Uploader une image"; ?>
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">
                    <div class="cart-title">
                        <h2>Ajouter une image</h2>
                    </div>
                    <?php if (isset($_SESSION['flash'])) : ?>
                    <div class="text-center mb-3">
                            <div class="alert alert-<?= $_SESSION['flash']['alert']; ?>">
                                <p><?= $_SESSION['flash']['infos']; ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php unset($_SESSION['flash']); ?>
                    <form method="post" enctype="multipart/form-data">
                        <?php if (!empty($product->getPictureUrl1())) : ?>
                        <div class="col border rounded p-3 d-flex justify-content-center">
                            <img style="max-width: 420px;max-height: 367px;" src="<?= $product->getPictureUrl1(); ?>" alt="<?= $product->getPictureUrl1(); ?>">
                        </div>
                        <?php endif; ?>
                        <div class="border rounded p-3 col-12">
                            <label for="picture">Ajouter/modifier une image</label><br/>
                            <div class="row p-3">
                                <input type="file" class="btn btn-primary mr-3" id="picture" name="picture"
                                >
                                <input type="hidden" name="pictureUpload" value="upload"/>
                                <input
                                        class="btn btn-primary" type="submit"
                                        name="submit"
                                        value="Télécharger"></div>
                            <p class="text-danger"><?= isset($errorsMsg['picture']) ? $errorsMsg['picture'] : ''; ?></p>
                            <p><strong>Note:</strong> Seuls les formats .jpg, .jpeg, .png sont autorisés jusqu'à une taille
                                maximale de 5 Mo.</p>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>