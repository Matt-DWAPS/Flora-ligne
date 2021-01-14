<?php
namespace App\Controller;

//require_once 'Framework/Controller.php';

use App\Framework\Controller;
use App\Model\CartUser;
use App\Model\Product;
use App\Model\User;
use Exception;

class Home extends Controller
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
    public function registration()
    {
        $user = new User();
        $post = isset($_POST) ? $_POST : false;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($post['registerForm'] == 'register') {
                $user->setDataPost();
                if ($user->formRegisterValidate()) {
                    if ($user->registerValidate()) {
                        $user->setDataNewUser();
                        $data = [
                            'firstname' => $user->getFirstname(),
                            'lastname' => $user->getLastname(),
                            'email' => $user->getEmail(),
                            'token' => $user->getToken()
                        ];
                        if ($user->save()){
                            $this->sendEmail('registration', 'Inscription sur le site Flora-ligne', $user->getEmail(), $data);
                            $_SESSION['flash']['alert'] = "success";
                            $_SESSION['flash']['message'] = "Veuillez consulté votre messagerie afin de valider la création de votre compte";
                            header('Location: login');
                            exit();
                        }
                    } else {
                        $_SESSION['flash']['alert'] = "danger";
                        $_SESSION['flash']['message'] = "Identifiant indisponible";
                    }
                }
            }
        }
        $this->generateView([
            'errorsMsg' => $user->getErrorsMsg(),
            'post' => $post,
        ]);
    }

    /**
     * @throws Exception
     */
    public function userValidationRegistered()
    {
        $user = new User();
        $get = isset($_GET) ? $_GET : false;

        $user->setEmail($get['email']);
        $user->setToken($get['token']);

        $userEmail = $user->getEmail();
        if ($user->emailAndTokenValidation()) {
            $userBdd = $user->getEmailAndTokenUserInBdd($userEmail);
            if ($userBdd) {
                $user->hydrateUser($userBdd);
                $user->setActive(self::ACTIVE ['ACTIVE']);
                $user->setRole(self::ROLES ['CUSTOMER']);
                $user->updateUser();
                $_SESSION['flash']['alert'] = "success";
                $_SESSION['flash']['message'] = "Votre compte est désormais activé, vous pouvez dès à présent vous connecter à l'aide de vos identifiants";
                header('Location: Home/login');
                exit();
            }
        }
        $this->generateView([
            'userBdd' => $userBdd
        ]);
    }

    /**
     * @throws Exception
     */
    public function login()
    {
        $user = new User();
        $post = isset($_POST) ? $_POST : false;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($post['loginForm'] == 'login') {
                $user->setEmail($post['email']);
                $user->setPassword($post['password']);
                if ($user->formLoginValidate()) {
                    $userBdd = $user->getUserInBdd(self::ACTIVE['ACTIVE']);
                    if ($userBdd) {
                        $user->hydrate($userBdd);
                        $userRole = $user->getRole();
                        $user->roleBlocked($userRole);

                        if ($user->login()) {
                            $user->sessionAuthUser();
                            $user->checkRoleRedirect($userRole);
                        } else {
                            $_SESSION['flash']['alert'] = "danger";
                            $_SESSION['flash']['message'] = "Mauvais identifiants";
                        }
                    } else {
                        $_SESSION['flash']['alert'] = "danger";
                        $_SESSION['flash']['message'] = "Mauvais identifiants";
                    }
                }
            }
        }
        $this->generateView([
            'errorsMsg' => $user->getErrorsMsg(),
            'post' => $post
        ]);
    }

    /**
     * @throws Exception
     */
    public function forgotYourPassword()
    {
        $user = new User();
        $post = isset($_POST) ? $_POST : false;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($post['forgotYourPasswordForm'] == 'forgotPassword') {
                $user->setEmail($post['email']);
                if ($user->formForgotPasswordValidate()) {
                    $userBdd = $user->getUserInBdd(self::ACTIVE['ACTIVE']);
                    if ($userBdd) {
                        $user->hydrate($userBdd);
                        $user->generateToken();
                        $data = [
                            'firstname' => $user->getFirstname(),
                            'lastname' => $user->getLastname(),
                            'email' => $user->getEmail(),
                            'token' => $user->getToken()
                        ];
                        $user->updateToken();
                        $this->sendEmail('forgotYourPassword', 'Reinitialisation du mot de passe', $user->getEmail(), $data);
                        $_SESSION['flash']['alert'] = "success";
                        $_SESSION['flash']['message'] = "Veuillez consulté votre messagerie afin de reinitialiser de votre mot de passe";
                        header('Location: login');
                        exit();
                    }
                }
            }
        }
        $this->generateView([
            'errorsMsg' => $user->getErrorsMsg(),
            'post' => $post,
        ]);
    }

    /**
     * @throws Exception
     */
    public function disconnected()
    {
        unset($_SESSION['auth']);
        header('Location: /home');
        exit;
    }

    /**
     * @throws Exception
     */
    public function resetPassword()
    {
        $user = new User();
        $get = isset($_GET) ? $_GET : false;
        $post = isset($_POST) ? $_POST : false;

        $user->setEmail($get['email']);
        $user->setToken($get['token']);

        $userEmail = $user->getEmail();
        $userBdd = $user->getEmailAndTokenUserInBdd($userEmail);
        if ($userBdd) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($post['passwordForm'] == 'newPassword') {
                    $user->setpassword($post['password']);
                    $user->setCPassword($post['cPassword']);
                    if ($user->formNewPasswordValidate()) {
                        $user->generateToken();
                        $data = [
                            'firstname' => $user->getFirstname(),
                            'lastname' => $user->getLastname(),
                            'email' => $user->getEmail(),
                            'token' => $user->getToken()
                        ];
                        $user->updatePassword();
                        $this->sendEmail('newPasswordUser', 'Modification de votre compte sur le site Floraligne', $user->getEmail(), $data);
                        $_SESSION['flash']['alert'] = "success";
                        $_SESSION['flash']['message'] = "Vous pouvez dès à présent vous connecter avec votre nouveau mot de passe";
                        header('Location: /home/login');
                        exit();
                    }
                }
            }
        }
        $this->generateView([
            'errorsMsg' => $user->getErrorsMsg(),
            'post' => $post
        ]);
    }
}