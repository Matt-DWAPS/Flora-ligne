    <?php $this->title = "Espace connexion"; ?>

    <div class="cart-table-area section-padding-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-title">
                            <h2>Espace connexion</h2>
                        </div>
                        <?php if (isset($_SESSION['flash'])) : ?>
                            <div class="alert alert-<?= $_SESSION['flash']['alert']; ?>">
                                <p><?= $_SESSION['flash']['message']; ?></p>
                            </div>
                        <?php endif; ?>
                        <?php unset($_SESSION['flash']); ?>
                        <form method="post">
                            <div class="border rounded p-3">
                                <div class="row">
                                    <div class="col form-group">
                                        <input class="form-control" type="text" id="email" name="email" placeholder="Email"
                                               value="<?= isset($post['email']) ? $post['email'] : ''; ?>"/>
                                        <p class="text-danger"><?= isset($errorsMsg['email']) ? $errorsMsg['email'] : ''; ?></p>
                                    </div>
                                    <div class="col form-group">
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Mot de passe"/>
                                        <p class="text-danger"><?= isset($errorsMsg['password']) ? $errorsMsg['password'] : ''; ?></p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center m-2">
                                    <input type="hidden" name="loginForm" value="login">
                                    <input class="btn" style="background-color: #096A09; color: white" type="submit" id="submit" value="Connexion">
                                </div>
                                <div class="d-flex justify-content-around align-items-center">
                                    <a class="" style="color: #096A09" href="home/registration">Je créer mon compte</a>
                                    <a class="" style="color: #096A09" href="home/forgotYourPassword">J'ai oublier mon mot de passe</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

