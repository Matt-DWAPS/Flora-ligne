<?php
/**
 * @var $user
 */
$this->title = "Client"; ?>

<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="cart-title mt-50">
                    <h2>Informations client</h2>
                </div>
                <?php if (isset($_SESSION['flash'])) : ?>
                    <p class="text-center font-weight-bold text-success alert alert-<?= $_SESSION['flash']['alert']; ?>">
                        <?= $_SESSION['flash']['messages']; ?>
                        <?php unset($_SESSION['flash']); ?>
                    </p>
                <?php endif; ?>
                <form method="post">
                    <div class="border rounded p-3 pb-5 col-12">
                        <div class="row p-2 m-2">
                            <div class="col">
                                <div class="row p-3">
                                    <div class="col text-right">
                                        <?php $created_at = new DateTime($user->getCreated_at()); ?>
                                        <p>Date d'inscription : <?= $created_at->format('d/m/Y H:i:s') ?></p>
                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="col">
                                        <p>Nom :</p>
                                        <input class="form-control" type="text" id="lastname" name="lastname"
                                               value="<?= $user->getLastname() ?>">
                                    </div>
                                    <div class="col">
                                        <p>Prénom :</p>
                                        <input class="form-control" type="text" id="firstname" name="firstname"
                                               value="<?= $user->getFirstname() ?>">
                                    </div>
                                    <div class="col">
                                        <p>Adresse email :</p>
                                        <input class="form-control" type="email" id="email" name="email"
                                               value="<?= isset($post['email']) ? $post['email
                                       '] : $user->getEmail(); ?>">

                                        <p class="text-danger"><?= isset($errorsMsg['email']) ? $errorsMsg['email'] : ''; ?></p>

                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="col">
                                        <p>Adresse :</p>
                                        <input class="form-control" type="text" id="address" name="address"
                                               value="<?= $user->getAddress() ?>">
                                    </div>
                                    <div class="col">
                                        <p>Code postal :</p>
                                        <input class="form-control" type="text" id="zipcode" name="zipcode"
                                               value="<?= $user->getZipcode() ?>">
                                        <p class="text-danger"><?= isset($errorsMsg['zipcode']) ? $errorsMsg['zipcode'] : ''; ?></p>
                                    </div>
                                    <div class="col">
                                        <p>Téléphone :</p>
                                        <input class="form-control" type="text" id="phone" name="phone"
                                               value="<?= isset($post['phone']) ? $post['phone
                                       '] : $user->getPhone() ?>">
                                        <p class="text-danger"><?= isset($errorsMsg['phone']) ? $errorsMsg['phone'] : ''; ?></p>

                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="col">
                                        <p>Statut :</p>
                                        <select class="form-control" name="active" id="active">
                                            <?php foreach ($user_active as $active => $level) : ?>
                                                <?php
                                                switch ($level) {
                                                    case 0:
                                                        $active = 'Non Activé';
                                                        break;
                                                    case 1:
                                                        $active = 'Activé';
                                                        break;
                                                    default:
                                                        $active = 'Non défini';
                                                } ?>
                                                <option value="<?= $level; ?>"<?= ($level === $user->getActive()) ? 'selected' : '' ?>>

                                                    <?= $active; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <p>Rôle :</p>
                                        <select class="form-control" name="role" id="role">
                                            <?php foreach ($roles as $role => $level) : ?>
                                                <?php
                                                switch ($level) {
                                                    case 0:
                                                        $role = 'Bloqué';
                                                        break;
                                                    case 10:
                                                        $role = 'Visiteur';
                                                        break;
                                                    case 20:
                                                        $role = 'Client';
                                                        break;
                                                    case 99:
                                                        $role = 'Administrateur';
                                                        break;
                                                    default:
                                                        $role = 'Rôle non défini';
                                                } ?>
                                                <option value="<?= $level; ?>"<?= ($level === $user->getRole()) ? 'selected' : '' ?>>
                                                    <?= $role; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col text-center">
                                <a class=" btn amado-btn border rounded" style="background-color: red" role="button" href="Admin/customerList"><i class="fas fa-arrow-left"></i> Retour</a>
                            </div>
                            <div class="col text-center">
                                <input type="hidden" name="userForm" value="updateUser"/>
                                <input class="btn amado-btn border rounded" style="background-color: #096A09" type="submit" name="saveUpdate" value="Enregistrer les modifications">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>