<?php

namespace App\Controller;

//require_once 'Framework/Controller.php';

use App\Framework\Controller;
use App\Model\CartUser;
use App\Model\Product;
use App\Model\ProductName;
use App\Model\User;
use Exception;

class Shop extends Controller
{
    /**
     * @throws Exception
     */
    public function index()
    {
        $product = new Product();
        $products = $product->getPublishProducts(self::PUBLISH['PUBLIÉ']);
        $this->generateView([
            'products' => $products,

        ]);
    }

    /**
     * @throws Exception
     */
    public function productDetails()
    {
        $productId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $product = new Product();
        $productDetails = $product->getOneProduct($productId);
        $product->hydrate($productDetails);
        $productNameId = $product->getProductNameId();

        $productName = new ProductName();
        $name = $productName->getNameInBdd($productNameId);

        $this->generateView([
            'productDetails' => $productDetails,
            'name' => $name
        ]);
    }


    public function updateProductsBdd()
    {
        if (isset($_SESSION['auth']['id'])) {
            $customerId = $_SESSION['auth']['id'];
            $cart = new CartUser();
            // delete panier dans la bdd
            $cart->deleteCartInBdd($customerId);

            //Récuperation du panier localStorage
            $dataObject = $_POST['data'];
            $cartObject = json_decode($dataObject, true);
            //Itération sur le premier tableau

            //Itération sur le tableau des lignes produits
            foreach ($cartObject as $keys => $key) {
                //Si le tableau produit n'est pas vide
                if (!empty($key)) {
                    $cart->setProductId($key['id']);
                    $cart->setCustomerId($customerId);
                    $cart->setQuantity($key['quantity']);
                    //J'enregistre la totalité des produits en bdd
                    $cart->saveCart();
                }
            }

        }
    }


}