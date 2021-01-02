<?php
namespace App\Controller;

//require_once 'Framework/Controller.php';
//require_once 'Model/Article.php';

use App\Framework\Controller;
use App\Model\Product;
use App\Model\User;

class Home extends Controller
{
    /**
     * @throws \Exception
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
     * @throws \Exception
     */
    public function registration()
    {
        $user = new User();
        $post = isset($_POST) ? $_POST : false;

        $this->generateView([
            'errorsMsg' => $user->getErrorsMsg(),
            'post' => $post,
        ]);
    }


    /**
     * @throws \Exception
     */
    public function login()
    {
        $user = new User();
        $post = isset($_POST) ? $_POST : false;

        $this->generateView([
            'errorsMsg' => $user->getErrorsMsg(),
            'post' => $post,
        ]);
    }

    /**
     * @throws \Exception
     */
    public function resetPassword()
    {
        $user = new User();
        $post = isset($_POST) ? $_POST : false;

        $this->generateView([
            'errorsMsg' => $user->getErrorsMsg(),
            'post' => $post,
        ]);
    }

    /**
     * @throws \Exception
     */
    public function forgotYourPassword()
    {
        $user = new User();
        $post = isset($_POST) ? $_POST : false;

        $this->generateView([
            'errorsMsg' => $user->getErrorsMsg(),
            'post' => $post,
        ]);
    }

    /**
     * @throws \Exception
     */
    public function disconnected()
    {


        $this->generateView([


        ]);
    }

    /**
     * @throws \Exception
     */
    public function account()
    {


        $this->generateView([


        ]);
    }

}