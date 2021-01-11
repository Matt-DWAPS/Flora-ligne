<?php $this->title = "Uploader une image"; ?>
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">
                    <div class="cart-title">
                        <h2>Ajouter une image</h2>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="col border rounded p-3 col-12">
                            <label for="picture">Ajouter/modifier une image</label><br/>
                            <div class="row p-3">
                                <input type="file" class="btn btn-primary mr-3" id="picture" name="picture"
                                                        value="<?= $product->picture, isset($post['picture']) ? $post['picture'] : ''; ?>">
                                <input type="hidden" name="pictureUpload" value="upload"/>
                                <input
                                        class="btn btn-primary" type="submit"
                                        name="submit"
                                        value="Télécharger"></div>
                            <p class="text-danger"><?= isset($errorsMsg['picture']) ? $errorsMsg['picture'] : ''; ?></p>
                            <p><strong>Note:</strong> Seuls les formats .jpg, .jpeg, .jpeg, .gif, .png sont autorisés jusqu'à une taille
                                maximale de 5 Mo.</p>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>