<?php
namespace App\Controller;


use App\Framework\Controller;
use App\Model\CartUser;
use App\Model\User;
use Exception;

class Dashboard extends Controller
{
    /**
     * @throws Exception
     */
    public function index()
    {
        if (!isset($_SESSION['auth'])) {
            header('Location: /home');
            exit();
        } else {
            $post = isset($_POST) ? $_POST : false;
            $roles = self::ROLES;
            $user = new User();
            $userId = $_SESSION['auth']['id'];
            $userBdd = $user->getUser($userId);
            $user->hydrate($userBdd);

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($post['userForm'] == 'updateUser') {
                    $user->setFirstname($post['firstname']);
                    $user->setLastname($post['lastname']);
                    $user->setAddress($post['address']);
                    $user->setPhone($post['phone']);
                    $user->setZipCode($post['zipcode']);
                    $user->setEmail($post['email']);
                    if ($user->userFormValidate()) {
                        $emailInBdd = $user->getEmailInBdd();
                        if (!$emailInBdd) {
                            $data = [
                                'firstname' => $user->getFirstname(),
                                'lastname' => $user->getLastname(),
                                'email' => $user->getEmail(),
                            ];
                            $user->updateUserProfile();
                            $this->sendEmail('updateAccountUser', 'Modification de votre compte sur Floraligne.fr', $user->getEmail(), $data);
                            $_SESSION['auth']['firstname'] = $user->getFirstname();
                            $_SESSION['auth']['lastname'] = $user->getLastname();
                            $_SESSION['auth']['email'] = $user->getEmail();
                            $_SESSION['flash']['alert'] = "Success";
                            $_SESSION['flash']['message'] = "Modification effectué avec succès !";
                        } else {
                            $_SESSION['flash']['alert'] = "danger";
                            $_SESSION['flash']['message'] = "L'adresse email existe déjà";
                        }
                    }
                }
            }
            $this->generateView([
                'user' => $user,
                'roles' => $roles,
                'errorsMsg' => $user->getErrorsMsg()
            ]);
        }
    }

    /**
     * @throws Exception
     */
    public function updatePasswordCustomer()
    {
        $post = isset($_POST) ? $_POST : false;
        $userId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $user = new User();
        $users = $user->getUser($userId);
        $user->hydrate($users);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($post['userForm'] == 'updateUserPassword') {
                $user->setpassword($post['password']);
                $user->setCPassword($post['cPassword']);
                if ($user->formNewPasswordValidate()) {
                    $data = [
                        'firstname' => $user->getFirstname(),
                        'lastname' => $user->getLastname(),
                        'email' => $user->getEmail()
                    ];
                    $user->updatePassword();
                    $this->sendEmail('newPasswordUser', 'Modification de votre compte sur le blog Jean ForteRoche', $user->getEmail(), $data);
                    $_SESSION['auth']['firstname'] = $user->getFirstname();
                    $_SESSION['auth']['lastname'] = $user->getLastname();
                    $_SESSION['auth']['email'] = $user->getEmail();
                    $_SESSION['flash']['alert'] = "Success";
                    $_SESSION['flash']['message'] = "Modification effectué avec succès !";
                    header('Location: /Dashboard');
                    exit;
                }
            }
        }
        $this->generateView([
            'user' => $user,
            'errorsMsg' => $user->getErrorsMsg()
        ]);
    }

    public function updateCart() {

        $this->generateView([]);

    }

    //Récupère le panier de l'utilisateur
    public function getProductsInCartInBdd() {
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

        //Récuperation du panier localStorage
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

    public function saveLocalStorageInBdd(){
        $cart = new CartUser();

        //Récup du localStorage
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


}