<?php

namespace App\Framework;
//require_once 'Configuration.php';
//require_once 'Request.php';
//require_once 'View.php';
require_once '../vendor/autoload.php';

use App\Framework\Configuration;
use App\Framework\Request;
use App\Framework\View;


abstract class Controller
{
    const FROMEMAIL = 'flora-ligne@webagency-matt.com';
    const AUTHOREMAIL = 'Flora Ligne';

    const PATH_UPLOAD = [
        'product' => 'Flora_ligne/public/img/product-img/'
    ];

    const ALLOWED = [
        "jpg" => "image/jpg",
        "jpeg" => "image/jpeg",
        "png" => "image/png"
    ];

    const MAX_SIZE = 5 * 1024 * 1024;

    const PUBLISH = [
        'PUBLIÉ' => 1,
        'BROUILLON' => 0
    ];
    const ROLES = [
        'VISITOR' => '10',
        'CUSTOMER' => '20',
        'SUPERADMIN' => '99',
        'BLOCKED' => '0',
    ];

    const ACTIVE = [
        'NO_ACTIVE' => 0,
        'ACTIVE' => 1
    ];

    // Action à réaliser
    private $action;

    // Requête entrante
    protected $request;

    // Définit la requête entrante
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $action
     * @throws \Exception
     */
    // Exécute l'action à réaliser
    public function executeAction($action)
    {
        if (method_exists($this, $action)) {
            $this->action = $action;

            $this->{$this->action}();
        } else {
            $classController = get_class($this);
            throw new \Exception("Action '$action' non définie dans la classe $classController");
        }
    }

    // Méthode abstraite correspondant à l'action par défaut
    // Oblige les classes dérivées à implémenter cette action par défaut
    public abstract function index();


    /**
     * @param array $dataView
     * @throws \Exception
     */
    // Génère la vue associée au contrôleur courant
    protected function generateView($dataView = array(), $action = null)
    {

        // Détermination du nom du fichier vue à partir du nom du contrôleur actuel
        $actionView = $this->action;
        if ($action != null) {
            $actionView = $action;
        }

        $classController = get_class($this);
        $controllerNamespace = substr($classController, 0, strrpos($classController, '\\'));
        $controllerView = substr(str_replace($controllerNamespace, "", $classController), 1);

        /*$controller = str_replace("Controller", "", $classController);*/
        // Instanciation et génération de la vue
        $vue = new View($actionView, $controllerView);
        $vue->generate($dataView);
    }

    public function sendEmail($action, $subject, $toEmail = self::FROMEMAIL, $data = [], $fromEmail = self::FROMEMAIL, $mailAuthor = self::AUTHOREMAIL)
    {
        $vue = new View($action, 'Mails');
        $body = $vue->generateMail($data);


        $transport = new \Swift_SmtpTransport(
            Configuration::get('mailtransport'), Configuration::get('mailport'));
        $transport->setUsername(Configuration::get('mailusername'));
        $transport->setPassword(Configuration::get('mailpassword'));

        $mailer = new \Swift_Mailer($transport);


        $message = (new \Swift_Message($subject))
            ->setFrom([$fromEmail => $mailAuthor])
            ->setTo([$toEmail])
            ->setBody($body)
            ->setContentType('text/html');
        $mailer->send($message);

    }
}