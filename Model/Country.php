<?php
namespace App\Model;

//require_once 'Framework/Model.php';
use App\Framework\Model;

class Country extends Model
{

    private $id;
    private $country_name;


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
    public function getCountryName()
    {
        return $this->country_name;
    }

    /**
     * @param mixed $country_name
     */
    public function setCountryName($country_name)
    {
        $this->country_name = $country_name;
    }


    /**
     * @return array
     */
    public function getErrorsMsg()
    {
        return $this->errorsMsg;
    }

    public function getAllCountry()
    {
        $sql = 'SELECT id, country_name FROM country ';

        $req = $this->executeRequest($sql);
        return $req->fetchAll();
    }

    public function hydrate($country){
        $this->setId($country->id);
        $this->setCountryName($country->country_name);
    }

}

