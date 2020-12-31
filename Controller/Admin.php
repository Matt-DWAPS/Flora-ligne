<?php
namespace App\Controller;

//require_once 'Framework/Controller.php';
//require_once 'Model/User.php';

use App\Framework\Controller;
use App\Model\Product;
use App\Model\User;


class Admin extends Controller
{
    /**
     * @throws \Exception
     */
    public function index()
    {
        $user = new User();
        $post = isset($_POST) ? $_POST : false;

        $this->generateView([
            'errorsMsg' => $user->getErrorsMsg(),
            'post' => $post
        ]);
    }

    /**
     * @throws \Exception
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
     * @throws \Exception
     */
    public function checkoutList()
    {


        $this->generateView([


        ]);
    }

    /**
     * @throws \Exception
     */
    public function customerList()
    {

        $this->generateView([

        ]);
    }

    /**
     * @throws \Exception
     */
    public function infoStore()
    {

        $this->generateView([

        ]);
    }
}