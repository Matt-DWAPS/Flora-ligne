<?php $this->title = 'Réinitialisation de votre mot de passe'; ?>
<div style="border: 10px solid #096A09; padding: 10px">
    <p>Une demande de modification de votre mot de passe vient d'être effectuée sur le site de <a
                href="http://floraligne.webagency-matt.com/">Floraligne</a>. Pour le réinitialiser, nous vous invitons à cliquer sur le lien ci-dessous : </p><br/>

    <?php echo "<a href='floraligne/index.php?action=resetPassword&email=$email&token=$token'>Réinitialiser mon mot de passe</a>"; ?>
    <br/>
    <p>Si vous n'êtes pas à l'origine de cette demande, merci de ne pas tenir compte de ce message, votre mot de passe
        restera inchangé.
        A très bientôt !
    </p>
</div>