<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/13/2019
 * Time: 12:03 AM
 */
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/controller/ChatBoxController.php');

$chatUID = $_REQUEST['UID'];
$userUID = $_SESSION['UID'];

$_SESSION['chatUID'] = $chatUID;

$objChatBoxControllerClass = new ChatBoxController();
$arrCfgMessages = $objChatBoxControllerClass->fetchMessagesByUsers($userUID, $chatUID);

$page = $_SERVER['PHP_SELF'].'?UID='.$chatUID;
$sec = "10";

?>

<!DOCTYPE html>
<html lang="en">
<head>
<!--    <meta >-->
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

