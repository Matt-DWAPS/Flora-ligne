<?php $this->title = "Espace inscription"; ?>
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>Espace inscription</h2>
                    </div>
                    <form method="post">
                        <div class="border rounded p-3">
                            <div class="row">
                                <div class="col form-group">
                                    <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Nom"
                                           value="<?= isset($post['lastname']) ? $post['lastname'] : ''; ?>"/>
                                    <p class="text-danger"><?= isset($errorsMsg['lastname']) ? $errorsMsg['lastname'] : ''; ?></p>
                                    <input class="form-control" type="text" id="email" name="email" placeholder="Email"
                                           value="<?= isset($post['email']) ? $post['email'] : ''; ?>"/>
                                    <p class="text-danger"><?= isset($errorsMsg['email']) ? $errorsMsg['email'] : ''; ?></p>
                                </div>
                                <div class="col form-group">
                                    <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Prénom"
                                           value="<?= isset($post['firstname']) ? $post['firstname'] : ''; ?>"/>
                                    <p class="text-danger"><?= isset($errorsMsg['firstname']) ? $errorsMsg['firstname'] : ''; ?></p>
                                    <input class="form-control" type="number" id="phone" name="phone" placeholder="Téléphone"
                                           value="<?= isset($post['phone']) ? $post['phone'] : ''; ?>"/>
                                    <p class="text-danger"><?= isset($errorsMsg['phone']) ? $errorsMsg['phone'] : ''; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input class="form-control" type="password" id="password" name="password" placeholder="Mot de passe"/>
                                    <p class="text-danger"><?= isset($errorsMsg['password']) ? $errorsMsg['password'] : ''; ?></p>
                                </div>
                                <div class="col form-group">
                                    <input class="form-control" type="password" id="cPassword" name="cPassword" placeholder="Retapez votre mot de passe"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group p-3">
                                    <input type="checkbox" id="privacy-policy" name="privacy-policy">
                                    <label for="privacy-policy">J'ai lu et j'accepte la <a style="font-size: 16px; color: #096A09;" href="home/privacy-policy" target="_blank">politique de confidentialité</a>.</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center m-2">
                                <input type="hidden" name="registerForm" value="register">
                                <input class="btn" style="background-color: #096A09; color: white" type="submit" id="submit" value="Inscription">
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <a class="" style="color: #096A09" href="home/login">Je possède un compte</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
