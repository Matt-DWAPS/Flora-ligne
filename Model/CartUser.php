<?php
namespace App\Model;

//require_once 'Framework/Model.php';
use App\Framework\Model;

class CartUser extends Model
{

    private $id;
    private $quantity;
    private $customer_id;
    private $product_id;

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
        $sql = 'SELECT customer_has_product.product_id as id, product_name.name, product.price_ht as price, customer_has_product.quantity, product.picture_url_1
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
        $sql = 'DELETE FROM customer_has_product WHERE customer_id =:id';
        $deleteCart = $this->executeRequest($sql, array(
            'id' => $customerId,
        ));
    }


    public function hydrate($country){
        $this->setId($country->id);
        $this->setCountryName($country->country_name);
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

