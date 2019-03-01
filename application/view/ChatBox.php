<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/13/2019
 * Time: 12:03 AM
 */

// started the session to get the UID stored in it.
session_start();

// these are the files required in this page.
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/controller/ChatBoxController.php');

// get the UID sent by post to this page.
$chatUID = $_REQUEST['UID'];

// fetch the UID of the user who is using the app from the session.
$userUID = $_SESSION['UID'];

// set the UID of the person with whom the user is chatting woih in the session.
$_SESSION['chatUID'] = $chatUID;

// fetch all the messages between the user and the person with whom the user is chatting.
$objChatBoxControllerClass = new ChatBoxController();
$arrCfgMessages = $objChatBoxControllerClass->fetchMessagesByUsers($userUID, $chatUID);

// to refresh the page every 20 seconds, which will reload the chats.
$page = $_SERVER['PHP_SELF'].'?UID='.$chatUID;
$sec = "20";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    <title>Chat Box</title>
    <style>
        table, th{
            border: 1px solid black;
        }
    </style>
</head>
<body>
<div>
    <h1>Messages</h1>
    <div>
        <button onclick="location.href='Chats.php'">Chats</button>
        <button style="float: right" onclick="location.href='../controller/LogoutController.php'">Logout</button>
    </div>

    <form action="../controller/ChatBoxController.php" method="post">
        <?php

        if($arrCfgMessages) {
            echo "<br><br>";
            echo "<table style='width:50%'>";

            // loop all the messages and display if right of left of the table based on the sender.
            while ($chats = $arrCfgMessages->fetch_assoc()) {
                echo "<tr>";
                if ($userUID == $chats['SenderUID']) {
                    echo "<td align='left' bgcolor='#7fffd4'>{$chats['Message']}</td>";
                } else {
                    echo "<td align='right' bgcolor='#f0ffff'>{$chats['Message']}</td>";
                }
                echo "</tr>";
            }
            echo "</table><br>";
        }
        ?>

        <input type='text' name='message' placeholder='Type your message here'>
        <input type='submit' value='Send'>

    </form>
</div>
</body>
</html>

