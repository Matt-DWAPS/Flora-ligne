<?php
namespace App\Controller;

//require_once 'Framework/Controller.php';
use App\Framework\Controller;
use App\Model\CartUser;
use App\Model\Product;
use \App\Model\Checkout;
use App\Model\User;
use Exception;

class Cart extends Controller
{
    /**
     * @throws Exception
     */
    public function index()
    {
        if (!isset($_SESSION['auth'])) {
            $_SESSION['flash']['alert'] = "success";
            $_SESSION['flash']['message'] = "Veuillez vous connecter pour acceder au panier";
            header('Location: /home/login');
            exit();
        } else{
            $userId= $_SESSION['auth']['id'];
            $user = new User();
            $customer =$user->getUser($userId);
            $user->hydrate($customer);


            $cartUser = new CartUser();
            $cartUser->getProductsCustomer($userId);


            $this->generateView([
                'userCart' => $cartUser,
                'customer' => $customer
            ]);
        }
            $this->generateView([

            ]);
    }

    // Lancement de la requete ajax qui enregsitre en bdd la commande
    public function saveOrderInBdd(){

        $this->generateView([]);
    }

    public function saveOrderFinal(){
        $customerId = $_SESSION['auth']['id'];

        $cart = new CartUser();
        //Récuperation des produits
        $cartUser = $cart->getProductsCustomer($customerId);
        echo json_encode($cartUser);
    }

    public function updateProductsBdd() {
        $customerId = $_SESSION['auth']['id'];
        $cart = new CartUser();
        // delete panier dans la bdd
        $cart->deleteCartInBdd($customerId);

        $dataObject = $_POST['data'];
        $cartObject = json_decode($dataObject,true);
        //Itération sur le premier tableau
        foreach ($cartObject as $products){
            //Itération sur le 2ème tableau
            foreach ($products as $keys => $key){
                //Si le tableau produit n'est pas vide
                if (!empty($key)){
                    $cart->setProductId($key['id']);
                    $cart->setCustomerId($_SESSION['auth']['id']);
                    $cart->setQuantity($key['quantity']);
                    //J'enregistre la totalité des produits en bdd
                    $cart->saveCart();
                }
            }
        }
    }

    /**
     * @throws Exception
     */
    public function saveProductInOrder(){
        $user = new User();
        $user->getUser($_SESSION['auth']['id']);
        $checkout= new Checkout();
        $dataObject = $_POST['data'];
        $cartObject = json_decode($dataObject,true);
        //Itération sur le premier tableau
        $totalCart =0;
        foreach ($cartObject as $products){
            //Itération sur le 2ème tableau
            foreach ($products as $keys => $key){
                //Si le tableau produit n'est pas vide
                if (!empty($key)){

                    $totalProduct = $key['quantity'] * $key['price'];

                    $checkout->setStatus('Confirmee');
                    $checkout->setCutomerId($_SESSION['auth']['id']);
                    $totalCart= $totalCart + $totalProduct;
                    $checkout->setTotalHt($totalCart);

                }
            }
        }
        $dateNow = new \DateTime();
        $checkout->setCreatedAt($dateNow->format('Y-m-d H:i:s'));
        $checkout->saveOrder();
            $data = [
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
            ];

            $this->sendEmail('validationOrder', 'Validation de votre commande', $user->getEmail(), $data);

            header('Location: /home');
            exit();

    }



}