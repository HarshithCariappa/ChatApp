<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/17/2019
 * Time: 10:11 PM
 */

// required classes.
require_once $_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/AppUser.php';
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/controller/PageRedirector.php');

/**
 * If post value is set then.
 * call the method to validate user input.
 */
if(isset($_POST['USN'])){
    $loginController = new LoginController();
    $loginController->fetchUserInput();
}

class LoginController
{
    // variables
    public $USN;
    public $password;

    /**
     * fetches the user input added in the login page.
     * calls method to validate.
     */
    public function fetchUserInput(){
        $this->USN = $_POST['USN'];
        $this->password = $_POST['password'];

        self::validateUserInput($this->USN, $this->password);
    }

    /**
     * Check if the entered username and password is not null.
     * If null show a pop up and redirect back to the login.php page
     * If valid user then add the required details in a session and redirect to chats page.
     */
    public function validateUserInput($USN, $password){

        //pageRedirector object
        $objPageRedirector = new PageRedirector();

        if($USN == null || $password == null){
            $message = "Please enter Username and Password";
            $objPageRedirector->redirectToLoginPage($message);
        }

        // create appUser object, and get the user by usn and password.
        $objAppUserClass = new AppUser();
        $objAppUser = $objAppUserClass->getUser($USN, $password);

        // is user exists then redirect to chats page , else redirect to login page.
        if($objAppUser){
            // Put all the required values into session.
            session_start();
            $_SESSION["UID"] = $objAppUser['UID'];

            $objPageRedirector->redirectToChatsPage();
        }
        else{
            $message = "Incorrect Username or Password";
            $objPageRedirector->redirectToLoginPage($message);
        }
    }
}