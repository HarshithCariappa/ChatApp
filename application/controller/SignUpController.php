<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/17/2019
 * Time: 9:56 PM
 */


require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/AppUser.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/controller/LoginController.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/controller/PageRedirector.php');

$objSignUpController = new SignUpController();
$objSignUpController->validateUserData();

class SignUpController
{
    // variables.
    public $firstName;
    public $lastName;
    public $email;
    public $branchId;
    public $yearId;
    public $USN;
    public $genderId;
    public $password;
    public $confirmPassword;

    public function validateUserData(){
        $this->firstName = $_POST['firstName'];
        $this->lastName = $_POST['lastName'];
        $this->email = $_POST['email'];
        $this->branchId = $_POST['branchId'];
        $this->yearId = $_POST['yearId'];
        $this->USN = $_POST['usn'];
        $this->genderId = $_POST['genderId'];
        $this->password = $_POST['password'];
        $this->confirmPassword = $_POST['confirmPassword'];

        // page redirector object to redirect to registration page.
        $objPageRedirector = new PageRedirector();

        // check if the password matching, If not then redirect to registration page.
        if($this->password !== $this->confirmPassword){
            $message = "Passwords are not matching";
            $objPageRedirector->redirectToRegistration($message);
        }

        // check if the user already exists.
        $objAppUserClass = new AppUser();
        $userExistsResult = $objAppUserClass->checkUserAlreadyExists($this->USN);

        // if the user already exists then redirect to registration page.
        if($userExistsResult){
            $message = "USN already exists in the system";
            $objPageRedirector->redirectToRegistration($message);
        }

        // if the user does not exists then save the user.
        $registerUserResult = $objAppUserClass->registerUser($this->USN, $this->firstName, $this->lastName, $this->email, $this->branchId, $this->password, $this->genderId, $this->yearId);

        // If the user gets registered successfully then, create the session of the registered user and
        if($registerUserResult){
            $objAppuser = new LoginController();
            $objAppuser->validateUserInput($this->USN, $this->password);
        }else{
            $message = "Failed to signUp, please retry";
            $objPageRedirector->redirectToRegistration($message);
        }
    }
}