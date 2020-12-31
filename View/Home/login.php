<?php $this->title = "Espace connexion"; ?>
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>Espace connexion</h2>
                    </div>

                    <form method="post">
                        <div class="d-flex justify-content-center">
                            <div class="border rounded p-3 col-8">
                                <div class="form-group">
                                    <label for="email">Adresse Email</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                           value="<?= isset($post['email']) ? $post['email'] : ''; ?>"/>
                                    <p class="text-danger"><?= isset($errorsMsg['email']) ? $errorsMsg['email'] : ''; ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="password">Mot de passe</label>
                                    <input class="form-control" type="password" id="password" name="password"/>
                                    <p class="text-danger"><?= isset($errorsMsg['password']) ? $errorsMsg['password'] : ''; ?></p>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <input type="hidden" name="loginForm" value="login">
                                    <input class="btn btn-primary" type="submit" id="submit" value="Connexion">
                                    <a class="text-danger" href="home/forgotYourPassword">Mot de passe oublier ?</a>
                                </div>


                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
