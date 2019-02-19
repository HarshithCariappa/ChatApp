<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chats Page</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
    <body>
        <div>
            <h1>Chats</h1>
            <button onclick="location.href='Contacts.php'">Contacts</button>
            <?php

            require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/controller/ChatsController.php');
            require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/MsBranch.php');
            require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/MsYear.php');

            session_start();

            $objChatsControllerClass = new ChatsController();
            $arrAppUsers = $objChatsControllerClass->fetchAllConversations($_SESSION["UID"]);

            // object of MsBranch class
            $objMsBranchClass = new MsBranch();

            // object of MsYear class
            $objMsYearClass = new MsYear();

            echo "<br><br>";
            echo "<table style='width:100%'>
                  <tr>
                    <th>FirstName</th>
                    <th>LastName</th> 
                    <th>USN</th>
                    <th>Branch</th>
                    <th>Year</th>
                    <th>LastSeen</th>
                    <th>Online</th>
                  </tr>";
            foreach ($arrAppUsers as $appUser)
            {
                $objMsBranch = $objMsBranchClass->fetchByBranchId($appUser['BranchId']);
                $objMsYear = $objMsYearClass->fetchByYearId($appUser['YearId']);

                echo "<tr>
                        <td><a href='ChatBox.php?UID=" . $appUser['UID'] . "'>{$appUser['FirstName']}</td>
                        <td>{$appUser['LastName']}</td>
                        <td>{$appUser['USN']}</td>
                        <td>{$objMsBranch['BranchAbbrivation']}</td>
                        <td>{$objMsYear['Year']}</td>
                        <td>{$appUser['LastLogout']}</td>
                        <td>{$appUser['Online']}</td>
                        </tr>";
            }
            echo "</table>"
            ?>
        </div>
    </body>
</html>