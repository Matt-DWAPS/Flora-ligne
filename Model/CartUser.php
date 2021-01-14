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
        $sql = 'SELECT customer_has_product.id, customer_has_product.quantity, customer_has_product.customer_id, customer_has_product.product_id, product_name.name, product.price_ht
FROM customer_has_product, product, product_name
WHERE customer_id=:id
AND customer_has_product.product_id = product.id
AND product.product_name_id = product_name.id';

        $req = $this->executeRequest($sql, array(
            'id' => $userId
        ));
        return $req->fetchAll();
    }

    public function hydrate($country){
        $this->setId($country->id);
        $this->setCountryName($country->country_name);
    }

}

