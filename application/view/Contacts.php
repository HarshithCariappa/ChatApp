<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/13/2019
 * Time: 12:03 AM
 */

// start the session to get the values stored in the session.
session_start();

// these are the files required in this page.
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/MsBranch.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/MsYear.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/AppUser.php');

// fetch all available branches. To show in the Branches drop-down filter
$objMsbranch = new MsBranch();
$arrMsbranchData = $objMsbranch->fetchAllBranches();

// fetch all available year. To show in the Year drop-down filter
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
            // To fetch the data according to the default selected data.
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
                        // fetch all branches by looping.
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
                        // fetch all year by looping.
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
                // Check if the branchID is set, If not it means this page is opened just now and no filter is selected.
                // So fetch the data according to the default values.
                if(!isset($_POST['branchId']))
                {
                    echo '<script type="text/javascript">myFunc()</script>';
                }

                // Fetch the data from appUser table according to the selected branch and Year.
                $objAppUserClass = new AppUser();
                $arrAppUsers = $objAppUserClass->fetchByBranchIdYearId($_POST['branchId'],$_POST['yearId'], $_SESSION['UID']);

                // creating a table to display the data.
                echo "<br><br>";
                echo "<table style='width:100%'>
                      <tr>
                        <th>FirstName</th>
                        <th>LastName</th> 
                        <th>USN</th>
                        <th>LastSeen</th>
                        <th>Online</th>
                      </tr>";
                if(!$arrAppUsers)
                {
                    return;
                }
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
