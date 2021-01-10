<?php
/**
 * @var $user
 */
$this->title = "Mon compte - Modifier mon mot de passe"; ?>
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="cart-title mt-50">
                    <h2>Mon compte - Modifier mon mot de passe</h2>
                </div>
                <div class="col-6 border p-3">
                    <form method="post">
                        <div class="form-group">
                            <label for="password">Modifier le mot de passe</label>
                            <input class="form-control" type="password" name="password" id="password"/>
                            <p class="text-danger"><?= isset($errorsMsg['password']) ? $errorsMsg['password'] : ''; ?></p>
                            <label for="cPassword">Retapez le mot de passe</label>
                            <input class="form-control" name="cPassword" type="password" id="cPassword"/>
                        </div>

                        <div class="d-flex">
                            <div class="col text-left">
                                <a class="btn amado-btn border rounded" style="background-color: red" role="button"
                                   href="Dashboard"><i class="fas fa-arrow-left"></i> Retour</a>
                            </div>
                            <div class="col text-right">
                                <input type="hidden" name="userForm" value="updateUserPassword"/>
                                <input class="btn amado-btn border rounded" style="background-color: #096A09" type="submit"
                                       value="Enregistrer les modifications">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

