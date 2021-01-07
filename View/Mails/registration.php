<?php $this->title = 'Valider votre Inscription'; ?>
<div style="border: 10px solid #096A09; padding: 10px">
    <p>Nom : <?php echo $lastname; ?></p>
    <p>Prénom : <?php echo $firstname; ?></p>
    <p>Adresse mail : <?php echo $email; ?></p>
    <p>Coché : J'ai lu et j'accepte la politique de confidentialité.</p>
    <p>Veuillez valider votre inscription en cliquant sur le lien ci-dessous :</p><br/>
    <?php // echo "<a href='http://floraligne.webagency-matt.com/index.php?action=userValidationRegistered&email=$email&token=$token'>Valider mon
    //inscription</a>"; ?>
    <?php echo "<a href='floraligne/index.php?controller=home&action=userValidationRegistered&email=$email&token=$token'>Valider mon
    inscription</a>";?>
</div>

