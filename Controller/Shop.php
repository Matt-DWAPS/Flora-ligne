<?php
namespace App\Controller;

//require_once 'Framework/Controller.php';

use App\Framework\Controller;
use App\Model\Product;

class Shop extends Controller
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
     * @throws \Exception
     */
    public function productDetails()
    {
        $productId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $product = new Product();
        $productDetails = $product->getOneProduct($productId);


        $this->generateView([
            'productDetails' => $productDetails,

        ]);
    }

}