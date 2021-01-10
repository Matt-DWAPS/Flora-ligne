<?php
namespace App\Controller;

//require_once 'Framework/Controller.php';
//require_once 'Model/User.php';

use App\Framework\Controller;
use App\Model\Country;
use App\Model\Product;
use App\Model\ProductName;
use App\Model\User;
use DateTime;
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
    public function createProduct()
    {
        $post = isset($_POST) ? $_POST : false;
        $product = new Product();

        $productName = new ProductName();
        $names =$productName->getAllNames();

        $productsNames = array();
        foreach ($names as $name) {
            $productName = new ProductName();
            $productName->hydrate($name);
            $productsNames[] = $productName;
        }

        $productCountry = new Country();
        $countries = $productCountry->getAllCountry();

        $productsCountries = array();
        foreach ($countries as $country) {
            $productCountry = new Country();
            $productCountry->hydrate($country);
            $productsCountries[] = $productCountry;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($post['articleForm'] == 'addArticle') {
                $product->setProductNameId($post['name']);
                $product->setContent($post['description']);
                $product->setCountryId($post['countries']);
                $product->setGrowth($post['growth']);
                $product->setLocation($post['location']);
                $product->setMaintain($post['maintain']);
                $product->setPriceHt($post['price_ht']);
                $product->setSizeMin($post['size_min']);
                $product->setSizeMax($post['size_max']);

                if ($product->formProductValidate()) {
                        $dateNow = new DateTime();
                        $product->setCreatedAt($dateNow->format('Y-m-d H:i:s'));
                        if (isset($post['publish'])) {
                            $product->setPublish(self::PUBLISH['PUBLIÉ']);
                        } else {
                            $product->setPublish(self::PUBLISH['BROUILLON']);
                        }
                        $product->save();
                        header('Location: /Admin/productList');
                        exit;
                } else {
                    $_SESSION['flash']['alert'] = "danger";
                    $_SESSION['flash']['message'] = "Veuillez verifier les champs obligatoires";
                }
            }
        }
        $this->generateView([
            'errorsMsg' => $product->getErrorsMsg(),
            'post' => $post,
            'productsNames' => $productsNames,
            'productsCountries' => $productsCountries
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