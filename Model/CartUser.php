<?php
namespace App\Model;

//require_once 'Framework/Model.php';
use App\Framework\Model;
use PDO;

class CartUser extends Model
{


    private $id;
    private $quantity;
    private $customer_id;
    private $product_id;
    private $price_ht;

    private $name;
    private $picture;



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
    public function getPrice_ht()
    {
        return $this->price_ht;
    }

    /**
     * @param mixed $price_ht
     */
    public function setPrice_ht($price_ht)
    {
        $this->price_ht = $price_ht;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @param mixed $customer_id
     */
    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
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
     * @return array
     */
    public function getErrorsMsg()
    {
        return $this->errorsMsg;
    }


    public function getProductsCustomer($userId)
    {
        $sql = 'SELECT customer_has_product.product_id as id, product_name.name, product.price_ht as price, customer_has_product.quantity
FROM customer_has_product, product, product_name
WHERE customer_id=:id
AND customer_has_product.product_id = product.id
AND product.product_name_id = product_name.id';

        $req = $this->executeRequest($sql, array(
            'id' => $userId
        ));
        if ($req->rowCount() >= 1) {
            return $req->fetchAll();
        } else{
            return false;
        }
    }

    public function getProductsCustomerForCartView($userId)
    {
        $sql = 'SELECT customer_has_product.product_id as product_id, product_name.name as name, product.price_ht as price_ht, customer_has_product.quantity, customer_id,product.picture_url_1 as picture
FROM customer_has_product, product, product_name
WHERE customer_id=:id
AND customer_has_product.product_id = product.id
AND product.product_name_id = product_name.id';
        $req = $this->executeRequest($sql, array(
            'id' => $userId
        ));
        if ($req->rowCount() >= 1) {
            return $req->fetchAll();
        } else{
            return false;
        }
    }

    public function deleteCartInBdd($customerId){
        $sql = 'DELETE FROM customer_has_product WHERE customer_id=:id';
        $deleteCart = $this->executeRequest($sql, array(
            'id' => $customerId,
        ));
    }

    public function deleteProductInBdd($customerId, $product_id){
        $sql = 'DELETE FROM customer_has_product WHERE customer_id=:id AND product_id=:product_id';
        $deleteCart = $this->executeRequest($sql, array(
            'id' => $customerId,
            'product_id' => $product_id,
        ));
    }


    public function hydrate($cartUser){
        $this->setQuantity($cartUser->quantity);
        $this->setCustomerId($cartUser->customer_id);
        $this->setProductId($cartUser->product_id);
    }

    public function hydrateProduct($cartUser){
        $this->setQuantity($cartUser->quantity);
        $this->setCustomerId($cartUser->customer_id);
        $this->setProductId($cartUser->product_id);
        $this->setName($cartUser->name);
        $this->setPicture($cartUser->picture);
        $this->setPrice_ht($cartUser->price_ht);

    }

    public function saveCart(){
        $sql = "INSERT INTO customer_has_product(customer_id, product_id, quantity) VALUES (:customer_id, :product_id, :quantity)";

        $req = $this->executeRequest($sql, array(
            'customer_id' =>$this->getCustomerId(),
            'product_id' => $this->getProductId(),
            'quantity' => $this->getQuantity(),
        ));
        return true;
    }
}

