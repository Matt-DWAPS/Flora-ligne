<?php
namespace App\Controller;

//require_once 'Framework/Controller.php';

use App\Framework\Controller;
use App\Model\Product;
use App\Model\ProductName;
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
        $name =$productName->getNameInBdd($productNameId);

        $this->generateView([
            'productDetails' => $productDetails,
            'name' => $name
        ]);
    }


}