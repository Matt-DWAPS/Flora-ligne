<?php

namespace App\Controller;

//require_once 'Framework/Controller.php';
use App\Framework\Controller;
use App\Model\CartUser;
use App\Model\Product;
use \App\Model\Checkout;
use App\Model\ProductName;
use App\Model\User;
use DateTime;
use Exception;

class Cart extends Controller
{

    /**
     * @throws Exception
     */
    public function index()
    {
        if (!isset($_SESSION['auth']['id'])) {
            $_SESSION['flash']['alert'] = "success";
            $_SESSION['flash']['message'] = "Veuillez vous connecter pour acceder au panier";
            header('Location: /home/login');
            exit();
        } else {
            $userId = $_SESSION['auth']['id'];

            $user = new User();
            $customer = $user->getUser($userId);
            $user->hydrate($customer);

            $cartUser = new CartUser();
            $productsUser = $cartUser->getProductsCustomerForCartView($userId);

            $userProduct = array();
            if ($productsUser) {
                foreach ($productsUser as $productUser) {
                    $cartUser = new CartUser();
                    $cartUser->hydrateProduct($productUser);
                    $userProduct[] = $cartUser;
                }
            } else {
                $userProduct = false;
            }

            $productName = new ProductName();
            $names = $productName->getAllNames();

            $productsNames = array();
            foreach ($names as $name) {
                $productName = new ProductName();
                $productName->hydrate($name);
                $productsNames[] = $productName;
            }

            $this->generateView([
                'userProduct' => $userProduct,
                'user' => $user,
                'productsNames' => $productsNames,
            ]);
        }

    }

    public function deleteProduct()
    {
        $userId = $_SESSION['auth']['id'];
        $post = isset($_POST) ? $_POST : false;
        $cart = new CartUser();
        //Récuperation de l'id via le window.location du js
        $productId = $_GET['id'];
        $cart->setProductId($productId);
        $cart->setCustomerId($userId);

        //Suppression en bdd du produit
        $cart->deleteProductInBdd($cart->getCustomerId(), $cart->getProductId());
        header("Location: /Cart");
        exit();
    }

    /**
     * @throws Exception
     */
    public function saveProductInOrder()
    {
        $userId =$_SESSION['auth']['id'];
        $cartUser = new CartUser();
        $cartUserBdd = $cartUser->getProductsCustomer($userId);

        //On initialise le tableau qui contiendra le total
        $totalPrice = array();
        //On itère sur chaque produit pour calculer le prix total de chaque produit
        foreach ($cartUserBdd as $products){
            $price= $products->quantity * $products->price;
            $totalPrice [] = $price;
        }
        //On additionne les deux prix totaux des produits
        $finalPrice = array_sum($totalPrice);

        $orderProduct = new Checkout();
        $orderProduct->setTotalHt($finalPrice);
        $orderProduct->setStatus(self::CONFIRMED);
        $orderProduct->setCutomerId($userId);
        $dateNow = new DateTime();
        $orderProduct->setCreatedAt($dateNow->format('Y-m-d H:i:s'));
        
        $orderProduct->saveOrder();

        $totalProduct = array();
        foreach ($cartUserBdd as $products){
            $totalProduct [] = $products;
        }
        //On additionne les deux prix totaux des produits
        $allProduct = $totalProduct;


        $user = new User();
        $customer = $user->getUser($userId);
        $user->hydrate($customer);
        //Tableau de données à mettre dans le mail
        $data = [
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'products' => $allProduct,
            'finalPrice' => $finalPrice,
        ];

        $this->sendEmail('validationOrder', 'Validation de votre commande', $user->getEmail(), $data);

        $cartUser->deleteCartInBdd($userId);
        header('Location: /Checkout');

    }


}