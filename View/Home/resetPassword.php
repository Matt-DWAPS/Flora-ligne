<?php $this->title = "Redéfinition du mot de passe"; ?>

<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">
                    <h2 class="post-title" id="contenu">Redéfinition du mot de passe</h2>

                    <form method="post">
                        <div class="border rounded p-3">
                            <div class="row">
                                <div class="col form-group">
                                    <input class="form-control" type="password" id="password" name="password" placeholder="Nouveau mot de passe"/>
                                    <p class="text-danger"><?= isset($errorsMsg['password']) ? $errorsMsg['password'] : ''; ?></p>
                                </div>
                                <div class="col form-group">
                                    <input class="form-control" type="password" id="cPassword" name="cPassword" placeholder="Retapez votre mot de passe"/>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                            <input type="hidden" name="passwordForm" value="newPassword">
                            <input style="background-color: #096A09; color: white" class="btn" type="submit" id="submit" value="Valider">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>