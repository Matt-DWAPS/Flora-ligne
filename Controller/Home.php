<?php
namespace App\Controller;

//require_once 'Framework/Controller.php';
//require_once 'Model/Article.php';

use App\Framework\Controller;
use App\Model\Product;

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


        $this->generateView([


        ]);
    }


    /**
     * @throws \Exception
     */
    public function login()
    {


        $this->generateView([


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