<?php
namespace App\Model;

//require_once 'Framework/Model.php';
use App\Framework\Model;

class Country extends Model
{

    private $id;
    private $countryName;


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
        return $this->countryName;
    }

    /**
     * @param mixed $countryName
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;
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
        $sql = 'SELECT * FROM country ';

        $req = $this->executeRequest($sql);
        return $req->fetchAll();
    }


}

