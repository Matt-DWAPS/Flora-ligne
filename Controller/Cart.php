<?php
namespace App\Controller;

//require_once 'Framework/Controller.php';
use App\Framework\Controller;
use App\Model\CartUser;
use App\Model\Product;
use App\Model\User;
use Exception;

class Cart extends Controller
{
    /**
     * @throws \Exception
     */
    public function index()
    {


        $this->generateView([


        ]);
    }

    /**
     * @param $productId
     * @param $productQty
     * @param $productPrice
     * @throws Exception
     */
    public function addProductCart($productId,$productQty,$productPrice){

        $productId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        var_dump($_SESSION['auth']);
        die();
        if ($_SESSION['auth']['']) {
            //Récupération de l'Id user
            $customer = new User();
            $customer->getUser($customerId);
            //Création du panier
            $cart = new CartUser();
            $createCart = $cart->createCartUser();
            // On récupère le produit via l'Id
            $productId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $product = new Product();
            $product->getOneProduct($productId);

            if ($createCart && $_SESSION['panier']['lock'] = false) {
                //Si le produit existe déjà on ajoute seulement la quantité
                $positionProduct = array_search($productId,  $_SESSION['panier']['labelProduct']);
                if ($positionProduct !== false) {
                    $_SESSION['panier']['qteProduit'][$positionProduct] += $productQty ;
                } else {
                    //Sinon on ajoute le produit
                    array_push( $_SESSION['panier']['labelProduct'],$productId);
                    array_push( $_SESSION['panier']['qtyProduct'],$productQty);
                    array_push( $_SESSION['panier']['priceProduct'],$productPrice);
                }
            } else{
                echo "Un problème est survenu veuillez contacter l'administrateur du site.";
            }
        }







        $this->generateView([

        ]);
    }

}