<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/17/2019
 * Time: 10:03 PM
 */

class PageRedirector
{
    public function redirectToLoginPage($message){
        echo "<script> 
                    alert('$message');
                    window.location.href='../view/Login.php';
                  </script>";
        exit();
    }

    public function redirectToRegistration($message){
        echo "<script> 
                    alert('$message');
                    window.location.href='../view/Registration.php';
                  </script>";
        exit();
    }

    public function redirectToChatsPage(){
        echo "<script> 
                    window.location.href='../view/Chats.php';
                  </script>";
        exit();
    }

    public function redirectToChatBox($chatUID){
        echo "<script> 
                    window.location.href='../view/ChatBox.php?UID=$chatUID';
                  </script>";
        exit();
    }
}