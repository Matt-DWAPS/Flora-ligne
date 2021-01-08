<?php
namespace App\Model;

//require_once "Framework/Model.php";

use App\Framework\Model;
use Exception;

class Product extends Model
{

    private $id;
    private $created_at;
    private $product_name_id;
    private $description;
    private $picture_url_1;
    private $picture_url_2;
    private $picture_url_3;
    private $publish;
    private $price_ht;
    private $growth;
    private $location;
    private $maintain;
    private $size_min;
    private $country_id;


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
    public function getProductNameId()
    {
        return $this->product_name_id;
    }

    /**
     * @param mixed $product_name_id
     */
    public function setProductNameId($product_name_id)
    {
        $this->product_name_id = $product_name_id;
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
     * @return mixed
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * @param mixed $country_id
     */
    public function setCountryId($country_id)
    {
        $this->country_id = $country_id;
    }

    /**
     * @return array
     */
    public function getErrorsMsg()
    {
        return $this->errorsMsg;
    }

    public function getPublishProducts($publish = null)
    {
        $sql = 'SELECT product.id, product.price_ht, product.picture_url_1, product.publish, product_name.name as name from product INNER JOIN product_name ON product.product_name_id = product_name.id  WHERE publish=:publish';


        $req = $this->executeRequest($sql, array(
            'publish' => $publish,
        ));
        return $req->fetchAll();
    }


    public function getAllProducts()
    {
        $sql = 'SELECT * FROM product INNER JOIN product_name ON product.product_name_id = product_name.id INNER JOIN country ON product.country_id = country.id';


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
        $sql = 'SELECT product.id , product.created_at , product.price_ht , product.description , product.location , product.growth , product.maintain , product.size_min, product.size_max, product.picture_url_1, product.picture_url_2, product.picture_url_3, country.country_name, product.publish, product_name.name  from product INNER JOIN product_name ON product.product_name_id = product_name.id INNER JOIN country ON product.country_id = country.id WHERE product.id=:id';
        $product = $this->executeRequest($sql, array(
            'id' => $productId,
        ));
        if ($product->rowCount() == 1)
            return $product->fetch();

        else
            throw new Exception("Aucun article ne correspond à l'identifiant '$productId'");
    }
}