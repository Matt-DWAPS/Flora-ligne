<?php
/**
 * @var $user
 */
$this->title = "Liste des clients"; ?>
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="cart-title mt-50">
                    <h2>Liste des clients</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex flex-wrap">
                <?php foreach ($users as $user) : ?>
                <div class="col-4">
                    <div class=" mt-4 border mr-4">
                        <a href="<?= "Admin/updateCustomer/" . $user->getId() ?>">
                            <!-- Hover Content -->
                            <div class=" text-center m-2">
                                <h4><?php
                                    switch ($user->getRole()) {
                                        case 0:
                                            $role = '<span style="color: darkred">Bloqué</span>';
                                            break;
                                        case 10:
                                            $role = '<span style="color: darkolivegreen">Visiteur</span>';
                                            break;
                                        case 20:
                                            $role = '<span style="color: darkgreen">Client</span>';
                                            break;
                                        case 99:
                                            $role = '<span style="color: #357321">Administrateur</span>';
                                            break;
                                        default:
                                            $role = 'Rôle non défini';
                                    } ?>
                                    <?= $role ?></h4>
                                <p><?= $user->getLastname() ?></p>
                                <p><?= $user->getFirstname() ?></p>
                                <p><?= $user->getAddress() ?></p>
                                <p><?= $user->getZipcode() ?></p>
                                <p><?= $user->getPhone() ?></p>

                            </div>
                        </a>
                    </div>
                </div>


                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>