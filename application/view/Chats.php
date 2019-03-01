<?php

    // started the session to get the UID stored in it.
    session_start();


    // these are the files required in this page.
    require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/controller/ChatsController.php');
    require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/MsBranch.php');
    require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/MsYear.php');

?>
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
            <div>
                <button onclick="location.href='Contacts.php'">Contacts</button>
                <button style="float: right" onclick="location.href='../controller/LogoutController.php'">Logout</button>
            </div>
            <?php

                // fetch all the chats according to the UID
                $objChatsControllerClass = new ChatsController();
                $arrAppUsers = $objChatsControllerClass->fetchAllConversations($_SESSION["UID"]);

                // object of MsBranch class
                $objMsBranchClass = new MsBranch();

                // object of MsYear class
                $objMsYearClass = new MsYear();

                // creating a table to display the data.
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

                // loop the user array and display the required data.
                foreach ($arrAppUsers as $appUser)
                {
                    // fetch the branch of the user by branchID.
                    $objMsBranch = $objMsBranchClass->fetchByBranchId($appUser['BranchId']);

                    // Fetch the Year by yearId.
                    $objMsYear = $objMsYearClass->fetchByYearId($appUser['YearId']);

                    // The FirstName should be clickable and on clicking it should open the chatBox and it should pass the UID.
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