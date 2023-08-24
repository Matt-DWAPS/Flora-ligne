<?php $this->title = "Mot de passe oublier"; ?>
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">
                    <div class="cart-title">
                    <h2 class="post-title" id="contenu">Mot de passe oublier</h2>
                    </div>
                    <p class="text-center">Saisissez l'adresse mail associée à votre compte.<br/> Nous vous enverrons à cette adresse un lien vous permettant de réinitialiser<br/> facilement votre mot de passe.</p>

                    <form method="post">
                        <div class="border rounded p-3">
                            <div class="row">
                                <div class="col form-group">
                                    <input class="form-control" type="text" id="email" name="email" placeholder="Adresse Email"
                                           value="<?= isset($post['email']) ? $post['email'] : ''; ?>"/>
                                    <p class="text-danger"><?= isset($errorsMsg['email']) ? $errorsMsg['email'] : ''; ?></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="hidden" name="forgotYourPasswordForm" value="forgotPassword">
                                <input style="background-color: #096A09; color: white" class="btn" type="submit" id="submit" value="Valider">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
