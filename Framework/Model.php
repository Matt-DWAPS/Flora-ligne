<?php
namespace App\Framework;

use App\Framework\Configuration;
//require_once 'Configuration.php';

use \PDO;

abstract class Model
{
    private static $bdd;

    protected function executeRequest($sql, $params = null)
    {
        if ($params === null) {
            $result = self::getBdd()->query($sql);   // exécution directe
        } else {
            $result = self::getBdd()->prepare($sql); // requête préparée
            $result->execute($params);
        }
        return $result;
    }

    /**
     * @return PDO
     * @throws \Exception
     */
    private static function getBdd()
    {
        if (self::$bdd === null) {
            // Récupération des paramètres de configuration BD
            $dsn = Configuration::get("dsn");
            $login = Configuration::get("login");
            $mdp = Configuration::get("mdp");
            // Création de la connexion
            self::$bdd = new PDO($dsn, $login, $mdp,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ));
        }
        return self::$bdd;
    }

}