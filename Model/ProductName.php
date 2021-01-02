<?php
namespace App\Model;

//require_once 'Framework/Model.php';
use App\Framework\Model;

class ProductName extends Model
{

    private $id;
    private $name;


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

    public function getAllNames()
    {
        $sql = 'SELECT * FROM product_name ';

        $req = $this->executeRequest($sql);
        return $req->fetchAll();
    }


}

