<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/20/2019
 * Time: 1:11 AM
 */

require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/controller/PageRedirector.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/AppUser.php');

$objLogOutClass = new LogoutController();
$objLogOutClass->userLogout();

class LogoutController
{
    public function userLogout()
    {
        session_start();

        $objAppUserClass = new AppUser();
        $objAppUserClass->changeUserOnlineStatus($_SESSION['UID'], AppUser::ACTIVE);

        session_destroy();
        $objPageRedirectorClass = new PageRedirector();
        $objPageRedirectorClass->redirectToLoginPage("Thank You");
    }
}