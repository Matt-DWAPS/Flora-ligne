<?php
namespace App\Model;

//require_once 'Framework/Model.php';
use App\Framework\Model;
use App\Services\Validator;
use Exception;
use PDO;

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
        $sql = 'SELECT id, name FROM product_name';

        $req = $this->executeRequest($sql);
        return $req->fetchAll();
    }

    /**
     * @param $productNameId
     * @return mixed
     * @throws Exception
     */
    public function getNameInBdd($productNameId){
        $sql = 'SELECT id, name FROM product_name WHERE id=:id';

        $req = $this->executeRequest($sql, array(
            'id' => $productNameId,
        ));
        if ($req->rowCount() == 1){
            return $req->fetch();
        } else{
            throw new Exception("Aucun produit ne correspond à l'identifiant '$productNameId'");
        }
    }

    public function hydrate($product){
        $this->setId($product->id);
        $this->setName($product->name);
    }

}

