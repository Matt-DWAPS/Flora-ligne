<?php
namespace App\Model;

//require_once 'Framework/Model.php';
use App\Framework\Controller;
use App\Framework\Model;
use App\Services\Validator;
use Exception;
use PDO;

class User extends Model
{
    const MAX_LENGTH_FIRSTNAME = 16;
    const MAX_LENGTH_LASTNAME = 16;
    const MAX_LENGHT_PHONE = 10;
    const MAX_LENGHT_ZIPCODE = 5;

    const LENGTH_TOKEN = 78;

    private $id;
    private $lastname;
    private $firstname;
    private $email;
    private $phone;
    private $address;
    private $zipCode;
    private $password;
    private $cPassword;
    private $created_at;
    private $role;
    private $active;
    private $token;

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
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getCPassword()
    {
        return $this->cPassword;
    }

    /**
     * @param mixed $cPassword
     */
    public function setCPassword($cPassword)
    {
        $this->cPassword = $cPassword;
    }

    /**
     * @return mixed
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }


    /**
     * @return array
     */
    public function getErrorsMsg()
    {
        return $this->errorsMsg;
    }

    public function formLoginValidate()
    {
        $this->checkEmail();
        $this->checkPasswordLogin();

        if ($this->errors !== 0) {
            return false;
        } else {
            return true;
        }
    }

    public function hydrate($user)
    {
        $this->setCPassword($user->password);
        $this->setEmail($user->email);
        $this->setFirstname($user->firstname);
        $this->setPhone($this->phone);
        $this->setAddress($this->address);
        $this->setRole($user->role);
        $this->setLastname($user->lastname);
        $this->setActive($user->active);
        $this->setToken($this->token);
        $this->setCreated_at($user->created_at);
        $this->setId($user->id);
    }

    /**
     * @param $user
     */
    public function hydrateUser($user){

        foreach ($user as $key => $value)
        {
            $method = 'set'.$key;
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
  }

    public function login()
    {
        if (password_verify($this->getPassword(), $this->getCPassword())) {
            return true;
        } else {
            return false;
        }
    }

    public function roleBlocked($userRole){
        if ($userRole == Controller::ROLES['BLOCKED']) {
            $this->errors++;
            $this->errorsMsg['blocked'] = "Connexion impossible";
        }
    }

    public function checkRoleRedirect($userRole){
        if ($userRole == Controller::ROLES['SUPERADMIN']){
            $_SESSION['flash']['alert'] = "success";
            $_SESSION['flash']['message'] = "Bienvenue";
            header('Location: /Admin');
            exit();
        }
        if ($userRole == Controller::ROLES['CUSTOMER']){
            $_SESSION['flash']['alert'] = "success";
            $_SESSION['flash']['message'] = "Bienvenue";
            header('Location: /Home');
            exit();
        } elseif ($userRole == Controller::ROLES['VISITOR']){
            $_SESSION['flash']['alert'] = "danger";
            $_SESSION['flash']['message'] = "Veuillez valider votre adresse email afin d'acceder a toutes les fonctionnalités";
            header('Location: login');
            exit();
        }
    }

    public function sessionAuthUser(){
        $_SESSION['auth']['firstname'] = $this->getFirstname();
        $_SESSION['auth']['lastname'] = $this->getLastname();
        $_SESSION['auth']['email'] = $this->getEmail();
        $_SESSION['auth']['role'] = $this->getRole();
        $_SESSION['auth']['active'] = $this->getActive();
        $_SESSION['auth']['created_at'] = $this->getCreated_at();
        $_SESSION['auth']['id'] = $this->getId();
        $_SESSION['auth']['token'] = $this->getToken();
    }

    public function passwordHash()
    {
        $this->setPassword(password_hash($this->getPassword(), PASSWORD_BCRYPT));
        $this->setCPassword(null);
    }

    /**
     * @param $userId
     * @return mixed
     * @throws Exception
     */
    public function getUser($userId)
    {
        $sql = 'SELECT id as id, created_at as created_at, role as role,phone as phone, address as address, zipcode as zipcode, active as active, firstname as firstname, lastname as lastname, email as email, password as password FROM customer WHERE id=:id';
        $user = $this->executeRequest($sql, array(
            'id' => $userId,
        ));
        if ($user->rowCount() == 1)
            return $user->fetch();
        else {
            throw new \Exception("Aucun utilisateur ne correspond à l'identifiant '$userId'");
        }
    }

    private function checkToken()
    {
        if (Validator::isEmpty($this->getToken())) {
            $this->errors++;
            $this->errorsMsg['token'] = "Token non valide";
        }
    }

    public function emailAndTokenValidation()
    {
        $this->checkEmail();
        $this->checkToken();
        if ($this->errors !== 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $userEmail
     * @return mixed
     * @throws Exception
     */
    public function getEmailAndTokenUserInBdd($userEmail)
    {
        $sql = 'SELECT id, email, token FROM customer WHERE email= :email';
        $user = $this->executeRequest($sql, array(
            'email' => $this->getEmail(),
        ));

        if ($user->rowCount() === 1){
            return $user->fetch();
        } else {
            throw new Exception("Aucun utilisateur ne correspond à l'adresse email '$userEmail'");
        }
    }

    public function updateUser()
    {
        $sql = 'UPDATE customer SET role=:role, active=:active, email=:email WHERE id=:id';
        $updateUser = $this->executeRequest($sql, array(
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'role' => $this->getRole(),
            'active' => $this->getActive(),
        ));
    }

    public function updateUserProfile()
    {
        $sql = 'UPDATE customer SET email=:email, firstname=:firstname, lastname=:lastname,phone=:phone, address=:address, zipcode=:zipcode WHERE id=:id';
        $updateUser = $this->executeRequest($sql, array(
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'firstname' => $this->getFirstname(),
            'lastname' => $this->getLastname(),
            'phone' => $this->getPhone(),
            'address' => $this->getAddress(),
            'zipcode' => $this->getZipCode()
        ));
    }

    public function updateToken()
    {
        $sql = 'UPDATE customer SET token=:token WHERE email=:email';
        $updateUser = $this->executeRequest($sql, array(
            'email' => $this->getEmail(),
            'token' => $this->getToken()
        ));
    }

    public function updatePassword()
    {
        $this->passwordHash();
        $sql = 'UPDATE customer SET password=:password, token=:token WHERE email=:email';
        $updateUser = $this->executeRequest($sql, array(
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'token' => $this->getToken()
        ));
    }

    /**
     * @throws Exception
     */
    public function generateToken()
    {
        $this->setToken(bin2hex(random_bytes(self::LENGTH_TOKEN)));
    }

    public function getUserInBdd($active = null)
    {
        $sql = 'SELECT firstname, lastname, email, password, role, active, created_at, id, phone, address, zipcode FROM customer WHERE email= :email';

        if ($active !== null) {
            $sql .= ' AND active = :active';
            $req = $this->executeRequest($sql, array(
                'email' => $this->getEmail(),
                'active' => $active,
            ));
            return $req->fetch();
        }
        $req = $this->executeRequest($sql, array(
            'email' => $this->getEmail(),
        ));
        return $req->fetch();
    }

    private function checkPasswordLogin()
    {
        if (Validator::isEmpty($this->getPassword())) {
            $this->errors++;
            $this->errorsMsg['password'] = "Password vide";
        }
    }


    public function formNewPasswordValidate()
    {
        $this->checkPassword();
        if ($this->errors !== 0) {
            return false;
        } else {
            return true;
        }
    }

    public function formRegisterValidate()
    {
        $this->checkFirstname();
        $this->checkPhone();
        $this->checkLastname();
        $this->checkEmail();
        $this->checkPassword();
        $this->checkZipCode();
        if ($this->errors !== 0) {
            return false;
        } else {
            return true;
        }
    }

    public function userFormValidate()
    {
        $this->checkFirstname();
        $this->checkLastname();
        $this->checkEmail();
        if ($this->errors !== 0) {
            return false;
        } else {
            return true;
        }
    }

    public function formForgotPasswordValidate()
    {
        $this->checkEmail();
        if ($this->errors !== 0) {
            return false;
        } else {
            return true;
        }
    }

    public function registerValidate()
    {
        if ($this->checkEmailInBdd() === 0) {
            return true;
        }

        return false;
    }

    public function setDataPost(){
        $post = isset($_POST) ? $_POST : false;
        $this->setFirstname($post['firstname']);
        $this->setLastname($post['lastname']);
        $this->setEmail($post['email']);
        $this->setPhone($post['phone']);
        $this->setpassword($post['password']);
        $this->setCPassword($post['cPassword']);
    }

    /**
     * @throws \Exception
     */
    public function setDataNewUser(){
        $dateNow = new \DateTime();
        $this->setCreated_at($dateNow->format('Y-m-d H:i:s'));
        $this->setRole(Controller::ROLES ['VISITOR']);
        $this->setActive(Controller::ACTIVE ['NO_ACTIVE']);
        $this->generateToken();
    }

    public function getEmailInBdd()
    {
        $sql = 'SELECT id FROM customer WHERE email=:email AND id!=:id';
        $req = $this->executeRequest($sql, array(
            'email' => $this->getEmail(),
            'id' => $this->getId()
        ));
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getFirstnameInBdd()
    {
        $sql = 'SELECT id FROM customer WHERE firstname=:firstname AND id!=:id';
        $req = $this->executeRequest($sql, array(
            'firstname' => $this->getFirstname(),
            'id' => $this->getId()
        ));
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    private function checkFirstname()
    {
        if (Validator::isEmpty($this->getFirstname())) {
            $this->errors++;
            $this->errorsMsg['firstname'] = "Champ 'prénom' vide";
        }

        if (Validator::isToUpper($this->getFirstname(), self::MAX_LENGTH_FIRSTNAME)) {
            $this->errors++;
            $this->errorsMsg['firstname'] = "Champ 'prénom' trop long";
        }
    }

    private function checkLastname()
    {
        if (Validator::isEmpty($this->getLastname())) {
            $this->errors++;
            $this->errorsMsg['lastname'] = "Champ 'nom' vide";
        }

        if (Validator::isToUpper($this->getLastname(), self::MAX_LENGTH_LASTNAME)) {
            $this->errors++;
            $this->errorsMsg['lastname'] = "Champ 'nom' trop long";
        }
    }

    private function checkEmail()
    {
        if (Validator::isEmpty($this->getEmail())) {
            $this->errors++;
            $this->errorsMsg['email'] = "Email vide";
        }

        if (Validator::isNotAnEmail($this->getEmail())) {
            $this->errors++;
            $this->errorsMsg['email'] = "Email non valide";
        }
    }

    private function checkPassword()
    {
        if (Validator::isEmpty($this->getPassword())) {
            $this->errors++;
            $this->errorsMsg['password'] = "Mot de passe vide";
        } elseif (Validator::isEmpty($this->getCPassword()) || Validator::isNotIdentic($this->getPassword(), $this->getCPassword())) {
            $this->errors++;
            $this->errorsMsg['password'] = "Les deux mots de passe ne sont pas identiques";
        }
    }

    private function checkPhone()
    {
        if (Validator::isEmpty($this->getPhone())) {
            $this->errors++;
            $this->errorsMsg['phone'] = "Champ téléphone vide";
        }

        if (Validator::isToUpper($this->getPhone(), self::MAX_LENGHT_PHONE)) {
            $this->errors++;
            $this->errorsMsg['phone'] = "Champ téléphone trop long";
        }
    }

    private function checkZipCode()
    {
        if (Validator::isEmpty($this->getZipCode())) {
            $this->errors++;
            $this->errorsMsg['zipcode'] = "Champ code postal vide";
        }

        if (Validator::isToUpper($this->getZipCode(), self::MAX_LENGHT_ZIPCODE)) {
            $this->errors++;
            $this->errorsMsg['zipcode'] = "Champ code postal trop long";
        }
    }


    public function checkEmailInBdd()
    {
        $sql = 'SELECT email FROM customer WHERE email=:email';
        $req = $this->executeRequest($sql, array(
            'email' => $this->getEmail()));
        return $req->rowCount();
    }

    public function getLastnameInBdd()
    {
        $sql = 'SELECT lastname FROM customer WHERE lastname=:lastname';
        $req = $this->executeRequest($sql, array('lastname' => $this->getLastname()));
        return $req->rowCount();
    }


    public function checkPasswordInBdd()
    {
        $sql = 'SELECT password FROM customer WHERE password=:password';
        $req = $this->executeRequest($sql, array('password' => $this->getPassword()));
        $passwordCorrect = password_verify($_POST['password'], $req['password']);
        return $passwordCorrect->rowCount();
    }

    public function getAllUserDashboard()
    {
        $sql = 'SELECT id, lastname, firstname, email, password, role, active, created_at, phone, address, zipcode FROM customer';
        $req = $this->executeRequest($sql);
        return $req->fetchAll();
    }

    public function save()
    {
        $this->passwordHash();
        $sql = "INSERT INTO customer(firstname, lastname, email, password, role, active, created_at, phone, token) VALUES(:firstname, :lastname, :email, :password, :role, :active, :created_at, :phone, :token)";

        $req = $this->executeRequest($sql, array(
            'firstname' => $this->getFirstname(),
            'lastname' => $this->getLastname(),
            'phone' => $this->getPhone(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'role' => $this->getRole(),
            'active' => $this->getActive(),
            'created_at' => $this->getCreated_at(),
            'token' => $this->getToken(),
        ));
        return true;
    }

}

