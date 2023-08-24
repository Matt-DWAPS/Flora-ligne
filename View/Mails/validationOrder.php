<?php $this->title = 'Commande validée!'; ?>
<div style="border: 10px solid #096A09; padding: 10px">
    <p>Nom : <?php echo $lastname; ?></p>
    <p>Prénom : <?php echo $firstname; ?></p>
    <?php foreach ($products as $product) : ?>
        <p>Produits : <?php echo $product->name ?> ;Quantité : <?php echo $product->quantity?> ;Prix unitaire: <?php echo $product->price ?> €</p>
    <?php endforeach; ?>
    <p>Prix total: <?php echo $finalPrice?> €</p>

    <p>Merci pour votre commande chez Flora Ligne, Votre commande à bien était validé, vous pouvez vous presenter en magasin dès demain muni de ce mail</p><br/>

    <p>Adresse de la boutique: 28 rue d'Orchie 56452 Toulon</p>
</div>

