<?php $this->title = "Inscription validée"; ?>

<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>Bienvenue</h2>
                    </div>
                    <?php if (isset($_SESSION['flash'])) : ?>
                        <div class="alert alert-<?= $_SESSION['flash']['alert']; ?>">
                            <p><?= $_SESSION['flash']['message']; ?></p>
                        </div>
                    <?php endif; ?>
                    <?php unset($_SESSION['flash']); ?>
<p>Votre inscription à bien était validée.</p>
<p>Vous pouvez dès a présent vous <a href="Home/login">connecter</a> en utilisant votre email : <?= $userBdd->email; ?> et votre mot de passe.</p>
                </div>
            </div>
        </div>
    </div>
</div>


