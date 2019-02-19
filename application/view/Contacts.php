<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/13/2019
 * Time: 12:03 AM
 */

require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/MsBranch.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/MsYear.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/AppUser.php');

// fetch all available branches.
$objMsbranch = new MsBranch();
$arrMsbranchData = $objMsbranch->fetchAllBranches();

// fetch all available year.
$objMsYear = new MsYear();
$arrMsYearData  = $objMsYear->fetchAllYear();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Contacts Page</title>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
        <script>
            function myFunc() {
                document.getElementById("contacts").submit();
            }
        </script>
    </head>
    <body>
        <div>
            <h1>Contacts</h1>
            <div>
                <button onclick="location.href='Chats.php'">Chats</button>
                <button style="float: right" onclick="location.href='../controller/LogoutController.php'">Logout</button>
            </div><br>

            <form action="Contacts.php" method="post" name="contacts" id="contacts">
                Branch :
                <select name='branchId' id='branchId' style='width: 238px'>
                    <?php

                    while ($branch = $arrMsbranchData->fetch_assoc()){
                        if(($_POST['branchId'] == $branch['BranchId']))
                        {
                            echo "<option value=".$branch['BranchId']." selected='selected'>".$branch['BranchAbbrivation']."</option>";
                        }else {
                            echo "<option value=" . $branch['BranchId'] . ">" . $branch['BranchAbbrivation'] . "</option>";
                        }
                    }
                    ?>
                </select>

                Year :
                <select name='yearId' id='yearId' style='width: 238px'>
                    <?php

                    while ($year = $arrMsYearData->fetch_assoc()){
                        if(($_POST['yearId'] == $year['YearId']))
                        {
                            echo "<option value=".$year['YearId']." selected='selected'>".$year['Year']."</option>";
                        }else{
                            echo "<option value=".$year['YearId'].">".$year['Year']."</option>";
                        }
                    }
                    ?>
                </select>
                <input type="submit" value="SUBMIT" ><br><br>
            </form>

            <?php
                session_start();

                if(!isset($_POST['branchId']))
                {
                    echo '<script type="text/javascript">myFunc()</script>';
                }

                $objAppUserClass = new AppUser();
                $arrAppUsers = $objAppUserClass->fetchByBranchIdYearId($_POST['branchId'],$_POST['yearId'], $_SESSION['UID']);

                echo "<br><br>";
                echo "<table style='width:100%'>
                      <tr>
                        <th>FirstName</th>
                        <th>LastName</th> 
                        <th>USN</th>
                        <th>LastSeen</th>
                        <th>Online</th>
                      </tr>";
                while ($appUser = $arrAppUsers->fetch_assoc())
                {
                    echo "<tr>
                            <td><a href='ChatBox.php?UID=" . $appUser['UID'] . "'>{$appUser['FirstName']}</td>
                            <td>{$appUser['LastName']}</td>
                            <td>{$appUser['USN']}</td>
                            <td>{$appUser['LastLogout']}</td>
                            <td>{$appUser['Online']}</td>
                            </tr>";
                }
                echo "</table>"
            ?>

        </div>
    </body>
</html>
