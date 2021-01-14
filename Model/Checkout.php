<?php
namespace App\Model;

//require_once 'Framework/Model.php';
use App\Framework\Model;

class Checkout extends Model
{

    private $id;
    private $number;
    private $cutomer_id;
    private $created_at;
    private $total_ht;
    private $status;


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
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getCutomerId()
    {
        return $this->cutomer_id;
    }

    /**
     * @param mixed $cutomer_id
     */
    public function setCutomerId($cutomer_id)
    {
        $this->cutomer_id = $cutomer_id;
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
    public function getTotalHt()
    {
        return $this->total_ht;
    }

    /**
     * @param mixed $total_ht
     */
    public function setTotalHt($total_ht)
    {
        $this->total_ht = $total_ht;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getErrorsMsg()
    {
        return $this->errorsMsg;
    }

    public function saveOrder()
    {
        $sql = "INSERT INTO order(created_at, customer_id, status, total_ht) VALUES(:created_at, :customer_id, :status, :total_ht)";

        $req = $this->executeRequest($sql, array(
            'created_at' => $this->getCreatedAt(),
            'customer_id' => $this->getCutomerId(),
            'status' => $this->getStatus(),
            'total_ht' => $this->getTotalHt(),
        ));
        return true;
    }

    public function hydrate($cart){
        $this->setId($cart->id);
        $this->setCreatedAt($cart->created_at);
        $this->setCutomerId($cart->customer_id);
        $this->setNumber($cart->number);
        $this->setStatus($cart->status);
        $this->setTotalHt($cart->total_ht);
    }



}

