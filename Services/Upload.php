<?php
namespace App\Services;

use App\Framework\Controller;

class Upload
{
    static public function uploadPicture($value, $path)
    {
        $valueId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);


        // Vérifie si le fichier a été uploadé sans erreur.
        if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
            $allowed = Controller::ALLOWED;
            $filename = $_FILES["picture"]["name"];
            $filetype = $_FILES["picture"]["type"];
            $filesize = $_FILES["picture"]["size"];

            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed)) {
                die("Erreur : Veuillez sélectionner un format de fichier valide.");
            }

            // Vérifie la taille du fichier - 5Mo maximum
            $maxsize = controller::MAX_SIZE;
            if ($filesize > $maxsize) {
                die("Error: La taille du fichier est supérieure à la limite autorisée.");
            }

            // Vérifie le type MIME du fichier
            if (in_array($filetype, $allowed)) {

                // Vérifie si le fichier existe avant de le télécharger.
                if (file_exists($path . $_FILES["picture"]["name"])) {
                    $_SESSION['flash']['alert'] = "danger";
                    $_SESSION['flash']['infos'] = $_FILES["picture"]["name"] . " existe déjà.";
                } else {
                    if (file_exists($value->getPictureUrl1())) {
                        unlink($value->getPictureUrl1());
                    }
                    move_uploaded_file($_FILES["picture"]["tmp_name"], $path . $valueId . "." . $ext);

                    $value->setPictureUrl1($path . $valueId . "." . $ext);
                    $value->updateProduct();
                    $_SESSION['flash']['alert'] = "Success";
                    $_SESSION['flash']['infos'] = "Votre image a été téléchargé avec succès.";
                    header('Location: /admin/productList/');
                    exit;
                }
            } else {
                $_SESSION['flash']['alert'] = "danger";
                $_SESSION['flash']['infos'] = "Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
            }
        } else {
            $_SESSION['flash']['alert'] = "danger";
            $_SESSION['flash']['infos'] = "Erreur " . $_FILES["picture"]["error"];
        }
    }
}