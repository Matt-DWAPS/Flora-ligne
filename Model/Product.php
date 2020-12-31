<?php
namespace App\Model;

//require_once "Framework/Model.php";

use App\Framework\Model;
use Exception;

class Product extends Model
{

    private $id;
    private $created_at;
    private $description;
    private $name;
    private $picture_url_1;
    private $picture_url_2;
    private $picture_url_3;
    private $publish;
    private $price_ht;
    private $growth;
    private $location;
    private $maintain;
    private $size_min;

    private $errors = 0;
    private $errorsMsg = [];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setContent($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPictureUrl1()
    {
        return $this->picture_url_1;
    }

    /**
     * @param mixed $picture_url_1
     */
    public function setPictureUrl1($picture_url_1)
    {
        $this->picture_url_1 = $picture_url_1;
    }

    /**
     * @return mixed
     */
    public function getPictureUrl2()
    {
        return $this->picture_url_2;
    }

    /**
     * @param mixed $picture_url_2
     */
    public function setPictureUrl2($picture_url_2)
    {
        $this->picture_url_2 = $picture_url_2;
    }

    /**
     * @return mixed
     */
    public function getPictureUrl3()
    {
        return $this->picture_url_3;
    }

    /**
     * @param mixed $picture_url_3
     */
    public function setPictureUrl3($picture_url_3)
    {
        $this->picture_url_3 = $picture_url_3;
    }

    /**
     * @return mixed
     */
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * @param mixed $publish
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
    }

    /**
     * @return mixed
     */
    public function getGrowth()
    {
        return $this->growth;
    }

    /**
     * @param mixed $growth
     */
    public function setGrowth($growth)
    {
        $this->growth = $growth;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getMaintain()
    {
        return $this->maintain;
    }

    /**
     * @param mixed $maintain
     */
    public function setMaintain($maintain)
    {
        $this->maintain = $maintain;
    }

    /**
     * @return mixed
     */
    public function getSizeMin()
    {
        return $this->size_min;
    }

    /**
     * @param mixed $size_min
     */
    public function setSizeMin($size_min)
    {
        $this->size_min = $size_min;
    }

    /**
     * @return mixed
     */
    public function getSizeMax()
    {
        return $this->size_max;
    }

    /**
     * @param mixed $size_max
     */
    public function setSizeMax($size_max)
    {
        $this->size_max = $size_max;
    }
    private $size_max;

    /**
     * @return mixed
     */
    public function getPriceHt()
    {
        return $this->price_ht;
    }

    /**
     * @param mixed $price_ht
     */
    public function setPriceHt($price_ht)
    {
        $this->price_ht = $price_ht;
    }


    /**
     * @return array
     */
    public function getErrorsMsg()
    {
        return $this->errorsMsg;
    }

    public function getAllProducts()
    {
        $sql = 'SELECT * FROM product ';

        $req = $this->executeRequest($sql);
        return $req->fetchAll();
    }


    public function geAllProducts($publish = null, $nbStart = null, $nbEnd = null)
    {
        $sql = 'SELECT * FROM product ';

        if ($publish != null && $nbStart !== null or $nbEnd !== null) {
            $sql .= "WHERE publish =:publish ORDER BY ID DESC LIMIT " . $nbStart . "," . $nbEnd;

            $req = $this->executeRequest($sql, array(
                'publish' => $publish,
            ));

            return $req->fetchAll();
        } elseif ($publish != null) {
            $sql .= "WHERE publish =:publish ORDER BY ID DESC";
            $req = $this->executeRequest($sql, array(
                'publish' => $publish,
            ));
            return $req->fetchAll();
        }


        $req = $this->executeRequest($sql);
        return $req->fetchAll();
    }

    /**
     * @param $productId
     * @return mixed
     * @throws \Exception
     */
    public function getOneProduct($productId)
    {
        $sql = 'SELECT id as id,created_at as created_at, name as name, price_ht as price_ht, description as description, location as location, growth as growth, maintain as maintain, size_min as size_min, size_max as size_max, picture_url_1 as picture_url_1, picture_url_2 as picture_url_2, picture_url_3 as picture_url_3, country_id as country_id, publish as publish, race_id as race_id from product WHERE id=:id';
        $product = $this->executeRequest($sql, array(
            'id' => $productId,
        ));
        if ($product->rowCount() == 1)
            return $product->fetch();

        else
            throw new Exception("Aucun article ne correspond à l'identifiant '$productId'");
    }
}