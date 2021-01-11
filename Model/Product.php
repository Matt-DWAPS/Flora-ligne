<?php
namespace App\Model;

//require_once "Framework/Model.php";

use App\Framework\Model;
use App\Services\Validator;
use Exception;

class Product extends Model
{
    const MAX_LENGTH = 255;

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
    private $size_max;
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
    public function setDescription($description)
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

    /**
     * @param $product
     */
    public function hydrate($product)
    {
        $this->setId($product->id);
        $this->setCreatedAt($product->created_at);
        $this->setProductNameId($product->product_name_id);
        $this->setDescription($product->description);
        $this->setPictureUrl1($product->picture_url_1);
        $this->setPictureUrl2($product->picture_url_2);
        $this->setPictureUrl3($product->picture_url_3);
        $this->setPublish($product->publish);
        $this->setPriceHt($product->price_ht);
        $this->setGrowth($product->growth);
        $this->setLocation($product->location);
        $this->setMaintain($product->maintain);
        $this->setSizeMin($product->size_min);
        $this->setSizeMax($product->size_max);
        $this->setCountryId($product->country_id);
    }

    /**
     * @param $product
     */
    public function hydrateProduct($product){

        foreach ($product as $key => $value)
        {
            $method = 'set'.$key;
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }


    public function getPublishProducts($publish = null)
    {
        $sql = 'SELECT product.id, product.price_ht, product.picture_url_1, product.publish, product_name.name as name from product INNER JOIN product_name ON product.product_name_id = product_name.id  WHERE publish=:publish';


        $req = $this->executeRequest($sql, array(
            'publish' => $publish,
        ));
        return $req->fetchAll();
    }

    public function getNameProduct(){
        $sql= 'SELECT product_name.id FROM product_name INNER JOIN product ON product_name.id = product.product_name_id';
        $req = $this->executeRequest($sql);
        return $req->fetchAll();
    }

    public function getAllProducts()
    {
        $sql = 'SELECT product.id, product.price_ht, product.picture_url_1, product.publish,country.country_name, product_name.name as name, product.created_at FROM product INNER JOIN country ON product.country_id = country.id INNER JOIN product_name ON product.product_name_id = product_name.id';
        $req = $this->executeRequest($sql);
        return $req->fetchAll();
    }

    /**
     * @param $productId
     * @return mixed
     * @throws Exception
     */
    public function getOneProduct($productId)
    {
        $sql = 'SELECT product.id , product.created_at , product.price_ht , product.description , product.location , product.growth , product.maintain , product.size_min, product.size_max, product.picture_url_1, product.picture_url_2, product.picture_url_3, product.country_id, product.publish, product.product_name_id from product INNER JOIN product_name ON product.product_name_id = product_name.id INNER JOIN country ON product.country_id = country.id WHERE product.id=:id';
        $product = $this->executeRequest($sql, array(
            'id' => $productId,
        ));
        if ($product->rowCount() == 1)
            return $product->fetch();

        else
            throw new Exception("Aucun produit ne correspond à l'identifiant '$productId'");
    }

    public function formProductValidate()
    {
        $this->checkProductPrice();
        $this->checkProductDescription();
        $this->checkPictureUrl();
        $this->CheckSizeIsNotNull();
        $this->checkSizeProduct();
        $this->checkIdNameProduct();
        if ($this->errors !== 0) {
            return false;
        } else {
            return true;
        }
    }

    private function checkSizeIsNotNull(){
        if ($this->getSizeMin() === ''){
            $this->setSizeMin(null);
        }
        if ($this->getSizeMax() === ''){
            $this->setSizeMax(null);
        }
    }

    private function checkIdNameProduct(){
        if (Validator::isEmpty($this->getProductNameId())){
            $this->errors++;
            $this->errorsMsg['name'] = "Selectionner un nom de produit";
        }
    }

    private function checkSizeProduct(){
        if (Validator::isInteger($this->getSizeMin())){
            $this->errors++;
            $this->errorsMsg['size_min'] = "N'est pas une valeur numérique";
        }
        if (Validator::isInteger($this->getSizeMax())){
            $this->errors++;
            $this->errorsMsg['size_max'] = "N'est pas une valeur numérique";
        }
    }

    private function checkProductPrice()
    {
        if (Validator::isInteger($this->getPriceHt())) {
            $this->errors++;
            $this->errorsMsg['price_ht'] = "N'est pas une valeur numérique";
        }

        if (Validator::isEmpty($this->getPriceHt())) {
            $this->errors++;
            $this->errorsMsg['price_ht'] = "Insérer un prix";
        }
    }

    private function checkProductDescription()
    {
        if (Validator::isEmpty($this->getDescription())) {
            $this->errors++;
            $this->errorsMsg['content'] = "Insérer du contenu";
        }
    }

    private function checkPictureUrl()
    {
        if (Validator::isToUpper($this->getPictureUrl1(), self::MAX_LENGTH)) {
            $this->errors++;
            $this->errorsMsg['picture_url_1'] = "Titre de l'image trop long";
        }
        if (Validator::isToUpper($this->getPictureUrl2(), self::MAX_LENGTH)) {
            $this->errors++;
            $this->errorsMsg['picture_url_2'] = "Titre de l'image trop long";
        }
        if (Validator::isToUpper($this->getPictureUrl3(), self::MAX_LENGTH)) {
            $this->errors++;
            $this->errorsMsg['picture_url_3'] = "Titre de l'image trop long";
        }
    }

    /**
     * @param $productId
     */
    public function deleteProduct($productId){
        $sql = 'DELETE FROM product WHERE id =:id';
        $deleteProduct = $this->executeRequest($sql, array(
            'id' => $productId,
        ));
    }

    public function updateProduct()
    {
        $sql = 'UPDATE product SET price_ht=:price_ht, description=:description, location=:location, maintain=:maintain, size_min=:size_min, size_max=:size_max, growth=:growth, picture_url_1=:picture_url_1, picture_url_2=:picture_url_2, picture_url_3=:picture_url_3, publish=:publish, created_at=:createdAt, country_id=:country_id, product_name_id=:name WHERE id=:id';
        $updateArticle = $this->executeRequest($sql, array(
            'id' => $this->getId(),
            'price_ht' => $this->getPriceHt(),
            'description' => $this->getDescription(),
            'location' => $this->getLocation(),
            'maintain' => $this->getMaintain(),
            'size_min' => $this->getSizeMin(),
            'size_max' => $this->getSizeMax(),
            'growth' => $this->getGrowth(),
            'picture_url_1' => $this->getPictureUrl1(),
            'picture_url_2' => $this->getPictureUrl2(),
            'picture_url_3' => $this->getPictureUrl3(),
            'publish' => $this->getPublish(),
            'createdAt' => $this->getCreatedAt(),
            'country_id' => $this->getCountryId(),
            'name' => $this->getProductNameId(),
        ));
    }

    public function save()
    {
        $sql = "INSERT INTO product(price_ht, description, location, maintain, size_min, size_max, growth, picture_url_1, picture_url_2, picture_url_3, publish, created_at, country_id, product_name_id) VALUES(:price_ht, :description, :location, :maintain, :size_min, :size_max, :growth, :picture_url_1, :picture_url_2, :picture_url_3, :publish, :createdAt, :country_id, :name)";
        $req = $this->executeRequest($sql, array(

      'name' => $this->getProductNameId(),
      'description' => $this->getDescription(),
      'picture_url_1' => $this->getPictureUrl1(),
      'picture_url_2' => $this->getPictureUrl2(),
      'picture_url_3' => $this->getPictureUrl3(),
      'country_id' => $this->getCountryId(),
      'growth' => $this->getGrowth(),
      'location' => $this->getLocation(),
      'maintain' => $this->getMaintain(),
      'price_ht' => $this->getPriceHt(),
      'size_min' => $this->getSizeMin(),
      'size_max' => $this->getSizeMax(),
      'publish' => $this->getPublish(),
      'createdAt' => $this->getCreatedAt(),

        ));
    }
}