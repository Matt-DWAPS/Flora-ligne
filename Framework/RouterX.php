<?php

namespace App\Framework;

use App\Framework\Request;
use App\Framework\View;

//require_once 'Controleur.php';
//require_once 'Request.php';
//use \Config\requete;
//require_once 'View.php';





class Router
{

    public function routeRequest()
    {
        try {
            
            $request = new Request(array_merge($_GET, $_POST));

            $controller = $this->createController($request);
            $action = $this->createAction($request);

            $controller->executeAction($action);
        }
        catch (Exception $e) {
            $this->manageError($e);
        }
    }

    private function createController(Request $request)
    {
        $controller = "Home";  // Contrôleur par défaut
        if ($request->existSetting('controller')) {
            $controller = $request->getSetting('controller');
            // Première lettre en majuscules
            $controller = ucfirst(strtolower($controller));
        }
        // Création du nom du fichier du contrôleur
        // La convention de nommage des fichiers controleurs est : Controleur/Controleur<$controleur>.php
        $classeController = 'App\Controller\\'.$controller;
        $fileController = "../Controller/" . $controller . ".php";
        
        
        
        if (file_exists($fileController)) {
            
            //require($fileController);
            $controller = new $classeController();
            $controller->setRequest($request);
            return $controller;
        }
        else {
            
            throw new \Exception("Fichier '$fileController' introuvable");
        }
    }

    private function createAction(Request $request)
    {
        $action = "index";  // Action par défaut
        if ($request->existSetting('action')) {
            $action = $request->getSetting('action');
        }
        return $action;
    }

    private function manageError(Exception $exception)
    {
        $view = new \App\Framework\View('error');
        $view->generate(array('msgErreur' => $exception->getMessage()));
    }

}