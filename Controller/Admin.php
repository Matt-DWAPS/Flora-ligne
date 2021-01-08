<?php
namespace App\Controller;

//require_once 'Framework/Controller.php';
//require_once 'Model/User.php';

use App\Framework\Controller;
use App\Model\Product;
use App\Model\User;
use Exception;


class Admin extends Controller
{
    /**
     * @throws Exception
     */
    public function index()
    {
        if (!isset($_SESSION['auth'])) {
            header('Location: /home');
            exit();
        }elseif (isset($_SESSION['auth']) && $_SESSION['auth']['role'] == '99') {

            $this->generateView([

            ]);
        } else{
            header('Location: /home');
            exit();
        }
    }

    /**
     * @throws Exception
     */
    public function productList()
    {
        $product = new Product();

        $products = $product->getAllProducts();

        $this->generateView([
            'products' => $products,

        ]);
    }

    /**
     * @throws Exception
     */
    public function checkoutList()
    {


        $this->generateView([


        ]);
    }

    /**
     * @throws Exception
     */
    public function customerList()
    {
        $user = new User();
        $usersBdd = $user->getAllUserDashboard();
        $users = array();
        foreach ($usersBdd as $userBdd) {
            $user = new User;
            $user->hydrate($userBdd);
            $users[] = $user;
        }

        $this->generateView([
            'users' => $users,
        ]);
    }

    /**
     * @throws Exception
     */
    public function updateCustomer(){
        $roles = self::ROLES;
        $user_active = self::ACTIVE;
        $userId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $user = new User();
        $post = isset($_POST) ? $_POST : false;

        $users = $user->getUser($userId);
        $user->hydrateUser($users);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($post['userForm'] == 'updateUser') {
                $user->setEmail($post['email']);
                $user->setFirstname($post['firstname']);
                $user->setLastname($post['lastname']);
                $user->setRole($post['role']);
                $user->setActive($post['active']);
                $user->setPhone($post['phone']);
                $user->setAddress($post['address']);
                $user->setZipCode($post['zipcode']);
                if ($user->userFormValidate()) {

                    $emailInBdd = $user->getEmailInBdd();

                    if (!$emailInBdd) {
                        $user->updateUser();
                        $_SESSION['flash']['alert'] = "Success";
                        $_SESSION['flash']['messages'] = "Modification effectué avec succès !";
                    } else {
                        $_SESSION['flash']['alert'] = "danger";
                        $_SESSION['flash']['messages'] = "Le nom d'utilisateur ou l'adresse email existe déjà";
                    }
                }
            }
        }
        $this->generateView([
            'user' => $user,
            'roles' => $roles,
            'user_active' => $user_active,
        ]);
    }

    /**
     * @throws Exception
     */
    public function infoStore()
    {

        $this->generateView([

        ]);
    }
}