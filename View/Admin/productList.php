<?php $this->title = "Gestion des produits"; ?>
<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">
        <div class="tableau border mb-3">
            <h2 class="text-center">Gestion des produits</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col">Provenance</th>
                    <th scope="col">Taille min</th>
                    <th scope="col">Taille max</th>
                    <th scope="col">Entretien</th>
                    <th scope="col">Croissance</th>
                    <th scope="col">Image1</th>
                    <th scope="col">Prix HT</th>
                    <th scope="col">État</th>
                    <th scope="col">Date de création</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                </tr>
                </thead>
                <tbody>
                <tr><?php foreach ($products as $product) : $createAt = new DateTime($product->created_at);?>
                    <td><?= $product->name ?></td>
                    <td><?= $product->description ?></td>

                    <td>
                        <?php if ($product->publish == 1) {
                            echo "publié";
                        } else {
                            echo "Non publié";
                        } ?>
                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <?php if (empty($product->picture_url_1)) : ?>
                        <td>
                            <a href="<?= "dashboard/pictureArticleUpload/" . $product->id ?>"
                               class="btn btn-primary text-center">Ajouter image</a>
                        </td>
                    <?php else: ?>
                        <td><img class="img-fluid w-50" src="<?= $product->picture_url_1 ?>"><img class="img-fluid w-50" src="<?= $product->picture_url_2 ?>"><img class="img-fluid w-50" src="<?= $product->picture_url_3 ?>"></td>
                    <?php endif; ?>
                    <td></td>
                    <td></td>
                    <td><?= $createAt->format('d-m-Y'); ?></td>
                    <td class="text-center"><a class="btn btn-outline-success btn-floating"
                        data-mdb-ripple-color="dark" role="button" href="<?= "dashboard/updateArticle/" . $product->id ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                    <td class="text-center"><a class=" btn btn-outline-danger btn-floating" role="button" href="<?= "dashboard/deleteArticle/" . $product->id ?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                </tr><?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-center mb-3">
                <a class=" btn btn-primary" role="button" href="dashboard/createArticle">Ajouter un nouveau produit</a>
            </div>
        </div>
    </div>
</div>